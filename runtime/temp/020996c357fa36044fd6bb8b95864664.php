<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:101:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\gather\conferee_statistics_add.html";i:1568188157;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1568183374;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1567993633;}*/ ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>后台首页</title>
       <link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css" media="all">
       <link rel="stylesheet" type="text/css" href="/static/plugins/css/meeting.css">
       <link alink="red">
       <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
       <script type="text/javascript" src="/static/plugins/layui/particle.min.js" ></script> 
       <script type="text/javascript" src="/static/plugins/layui/jquery-1.7.2.min.js"></script>     
  </head>
  <body  class="layui-layout-body">
  </body>
</html>
          

<br>
  <form class="layui-form">
   <input type="hidden" name="id" value="<?php echo $data['item']['id']; ?>">
    <div class="layui-layout layui-layout-admin">  
     <div>   
       <table>
        <thead>  
           <tr>         
           <td>
            <div class="layui-form-item">
             <label class="layui-form-label">会议邀请人数</label>
            <div class="layui-input-inline">
             <input type="text" name="invite_number" class="layui-input" placeholder="请输入会议邀请人数" value="<?php echo $data['item']['invite_number']; ?>">
            </div> 
            </div>
           </td>         
         </tr>
        </thead> 
        <thead>
          <tr>
           <td>
            <div class="layui-form-item">
             <label class="layui-form-label">签到人数</label>
            <div class="layui-input-inline">
             <input type="text" name="normal_number" class="layui-input" placeholder="请输入正常签到人数" value="<?php echo $data['item']['normal_number']; ?>">
            </div> 
            </div>
           </td>
          </tr>
        </thead>
        <thead> 
          <tr>          
           <td>
            <div class="layui-form-item">
             <label class="layui-form-label">迟到人数</label>
            <div class="layui-input-inline">
             <input type="text" name="belated_number" class="layui-input" placeholder="请输入迟到人数" value="<?php echo $data['item']['belated_number']; ?>">
            </div> 
            </div>
           </td>         
          </tr>
        </thead> 
        <thead> 
          <tr>          
           <td>
            <div class="layui-form-item">
             <label class="layui-form-label">请假人数</label>
            <div class="layui-input-inline">
             <input type="text" name="leave_number" class="layui-input" placeholder="请输入请假人数" value="<?php echo $data['item']['leave_number']; ?>">
            </div> 
            </div>
           </td>         
          </tr>
        </thead>   
       </table> 
        <div class="layui-form-item">
         <button type="button" class="layui-btn layui-btn-radius layui-btn-normal" style="margin-left:120px" onclick="save()">保存</button>
        </div>              
     </div>
    </div>
  </form>  
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
                 ,min:-1
                 ,max:7
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
          area: ['700px', '700px'],
          //URL地址
          content: '/admin.php/admin/Meeting/add?id='+id+'&type='+type //iframe的url  
       });
   } 
</script>
<script type="text/javascript">
       //保存
        function save(){
        $.post('/admin.php/admin/Gather/save',$('form').serialize(),function(res){
       if(res.code>0){
        layer.alert(res.msg,{icon:2});
      }else{
        layer.msg(res.msg);
        setTimeout(function(){parent.window.location.reload()},1000);
      }      
    },'json');
  }
</script>
