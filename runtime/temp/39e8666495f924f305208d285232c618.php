<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:83:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\meeting\sign.html";i:1567594753;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1566614346;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1567592886;}*/ ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>后台首页</title>
       <link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css" media="all">
       <link rel="stylesheet" type="text/css" href="/static/plugins/css/meeting.css">
       <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
       <script type="text/javascript" src="/static/plugins/layui/particle.min.js" ></script> 
       <script type="text/javascript" src="/static/plugins/layui/jquery-1.7.2.min.js"></script>     
  </head>
  <body  class="layui-layout-body">
  </body>
</html>
          

   <div class="header">
     <span>签到列表</span>
     <div></div>
   </div> 
   <br>
   <table class="layui-table">
      <thead>
       <tr>
         <td>会议编号</td>
         <td>会议标题</td>
         <td>邀请人数</td>
         <td>会议状态</td>
         <td>操作</td>
       </tr>
      </thead>
      <thead>
       <?php if(is_array($data['data']['lists']) || $data['data']['lists'] instanceof \think\Collection || $data['data']['lists'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['data']['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
       <tr>
         <td><?php echo $vo['id']; ?></td>
         <td><a href="javascript:;" onclick="meeting_add(<?php echo $vo['id']; ?>, 3)"><?php echo $vo['title']; ?></a></td>
         <td><a href="/admin.php/admin/Meeting/invite_teacher_info?MeetingID=<?php echo $vo['id']; ?>"><?php echo $vo['meeting_count']; ?></a></td>
         <td><?php echo $vo['condition']==0?'<span style="color:#A9A9A9">未开始</span>':'<span style="color:#006400">进行中</span>'; ?></td>
         <td>
          <button class="layui-btn" onclick="sign()">签到</button>
          </td>
       </tr>
       <?php endforeach; endif; else: echo "" ;endif; ?> 
      </thead>
   </table> 
<div id="pages" style="text-align:center"></div> 
<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/static/plugins/echarts4/echarts.min.js" ></script>
<script type="text/javascript" src="/static/plugins/layui/jquery-1.7.2.min.js" ></script>
<script type="text/javascript">
    layui.use(['layer','tree','laydate','form','laypage','element','laydate','util'],function(){
    	     $ =layui.jquery;
           layer =layui.layer;
           form =layui.form;
           element = layui.element; 
           laydate =layui.laydate;         
           util =layui.util; 
           tree = layui.tree;  
           laypage =layui.laypage; 

            
           //用户名获取焦点
          $('#username').focus();
          //回车键登录
          $('input').keydown(function(e){
               //判断回车键按键码
            if(e.keyCode ==13){
              dologin();
            }
          });
          //时间插件
            lay('#input').each(function(){
               laydate.render({
                 elem : this
                 ,min:0
                 ,type:'datetime'
                 ,trigger : 'click'
                 ,format: 'yyyy-MM-dd HH:mm'            
             });           
         });   
         
    //顶部右侧菜单监控
  element.on('nav(rightmenu)',function(elem){
    var url = $(this).attr("lay-href");
    if(url!=undefined){
      layer.open({
        title:elem[0].innerText,
        type: 2,
        content:url,
        area: ['600px', '500px']
      });
    }
    if(elem[0].innerText=="锁屏"){
      layer.open({
        title:"已锁屏"
        ,content: '<input name="pass" class="layui-input" type="text" placeholder="请输入密码,默认admin" autocomplete="off"/>'
        ,btnAlign: 'c'
        ,anim: 1
        ,btn: ['解锁']
        ,yes: function(index, layero){
          var pass = layero.find('.layui-layer-content input').val();
          if(pass=="admin"){
              layer.close(index);
          }else{
            layer.title("密码不正确！", index);
          }
        }
        ,cancel: function(){ 
            return false //开启该代码可禁止点击该按钮关闭
        }
      });
    }
  }); 
});
      //返回上一级
    function back(){
      setTimeout(function(){window.location.href="/admin.php/admin/Gather/conferee_statistics"},500);
    }
    //添加菜单点击事件
  function menuFire(obj){
    //获取src
    var src =$(obj).attr('src');
    //设置iframe的src
    $('iframe').attr('src',src);
  }
  
  //菜单退出事件
  function quit(){
      layer.confirm('确认要退出吗?', {
          icon:3,
          btn: ['确定','取消'] //按钮
        }, function(){
          $.post('/admin.php/admin/account/quit',function(res){
      if(res.code >0){
        layer.msg(res.msg,{'icon':2});
      }else{
        layer.msg(res.msg,{'icon':1});
        setTimeout(function(){
          window.location.href ="/admin.php/admin/account/index";},1000);
      }
    },'json');
  });
} 
      //基本资料
      function userinfo(id){
        //iframe层
        layer.open({
          //弹框样式
          type: 2,
          title:'基本资料', //
          //shadeClose: true,
          //弹框阴影色度
          shade: 0.5,
          //弹框宽高
          area: ['600px', '500px'],
          //URL地址
          content: '/admin.php/admin/Home/userinfo' //iframe的url  
       });
   }  

       //单选框全选/全不选  
     function selectAll(obj){        
           var claimCase=document.getElementsByClassName("checkAll");//获取到复选框的名称         
      //全选
      //JS的if判断中Undefined类型视为false，其他类型视为true；
      //obj.id是定义过的值，类型为非Undefined，所以视为true。
        if(obj.id){
        for(var i=0;i<claimCase.length;i++) {     
        //若全选框的结果为选中，则进行全选操作,否则进入下一步
        //obj.checked表示复选框当前状态，已选为true，未选为false。
            if(obj.checked == true){ 
            var claimCases = claimCase[i];
            claimCases.checked = true;
          }           
        }         
        //全不选
        for(var i=0;i<claimCase.length;i++){  
        //若全选框的结果为没选中，则进行全不选操作,否则进入下一步  
        if(obj.checked == false){
            var claimCases = claimCase[i];
            claimCases.checked = false;
          }         
        }     
      }
    }
     //会议信息添加/编辑/展示
      function meeting_add(id,type){
        //iframe层
        layer.open({
          //弹框样式
          type: 2,
          title:type==1?'<button class="layui-btn layui-btn-radius layui-btn-primary">编辑会议信息</button>':type==2?'<button class="layui-btn layui-btn-radius layui-btn-primary">添加会议信息</button>':'<button class="layui-btn layui-btn-radius layui-btn-primary">会议信息</button>', //
          //shadeClose: true,
          //弹框阴影色度
          shade: 0.8,
          //弹框宽高
          area: ['600px', '600px'],
          //URL地址
          content: '/admin.php/admin/Meeting/add?id='+id+'&type='+type //iframe的url  
       });
   } 
</script>
 <script type="text/javascript">
	   layui.use(['layer','laypage'],function(){
	     $ =layui.jquery;
	     layer =layui.layer;
	     laypage =layui.laypage;
	      //执行一个分页实例
	      laypage.render({
	        elem: 'pages' ,//注意，这里的 test1 是 ID，不用加 # 号
	        count: <?php echo $data['data']['total']; ?>,//数据总数，从服务端得到
	        curr : <?php echo $data['page']; ?>, //起始页,一般用于刷新类型的跳页以及HASH跳页
	        limit: <?php echo $data['pageSize']; ?>,   //显示页数
	        jump:function(obj,first){
	          //判断
	          if(!first){
	             window.location.href ="?page="+obj.curr;
	             //searchs(obj.curr);
	          }
	        }
	      });   
	   });
       //搜索和分页统一
       function searchs(curpage){
        //消除第一行空格,获取搜获关键字
        var seek =$.trim($('#seek').val());
        //有wd就加载至分页后面
        var url ="/admin.php/admin/meeting/index?page="+curpage;
        //var_dump(url);
        if(seek){
          //将搜索到的内容拼接至分页后面
          url+='&seek='+seek;
        }
        //页面跳转，搜索和分页跳转的统一
        window.location.href =url;
     }
</script>