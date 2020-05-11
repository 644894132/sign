<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:87:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\gather\late_info.html";i:1568948447;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1568183374;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1568882600;}*/ ?>
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
          

  <div class="header">
    <span>迟到人员列表</span>
      <button class="layui-btn"  style="float:right;" onclick="back()"><i class="layui-icon">&#xe608;</i>返回</button>
    <div></div>
   </div><br>
   <div>
    <table class="layui-table" style="margin-left:20px;margin-right:20px;">
     <thead>
       <tr>
         <td>个人编号</td>              
         <td>姓名</td>
         <td>性别</td>
         <td>状态</td>
         <td>签到时间</td>
       </tr>
     </thead>
     <thead>
       <?php if(is_array($data['lists']) || $data['lists'] instanceof \think\Collection || $data['lists'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>           
        <tr>
         <td><?php echo $vo['Account']; ?></td> 
         <td><?php echo $vo['Name']; ?></td>
         <td><?php echo $vo['Sex']==1?'<span>男</span>':'<span>女</span>'; ?></td> 
         <?php if($vo['sign_status'] == 0): ?> 
         <td style="color:grey">缺席</td>
         <?php elseif($vo['sign_status'] == 1): ?>
         <td style="color:green">已签到</td>
         <?php elseif($vo['sign_status'] == 2): ?>
         <td style="color: red;">已请假</td>
         <?php elseif($vo['sign_status'] == 3): ?>
         <td style="color:#FF00FF">迟到</td>
         <?php endif; ?>        
         <!-- <td>
          <button class="layui-btn" onclick="sign_remove()"  title="删除"><i class="layui-icon">&#xe640;</i></button>
         </td> -->
        </tr>
       <?php endforeach; endif; else: echo "" ;endif; ?> 
     </thead>
    </table>
   </div>
<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/static/plugins/echarts4/echarts.min.js" ></script>
<script type="text/javascript" src="/static/plugins/layui/jquery-1.7.2.min.js" ></script>
<script type="text/javascript">
layui.use(['layer','tree','laydate','form','upload','laypage','element','laydate','util'],function(){
     $ =layui.jquery;
     layer =layui.layer;
     form =layui.form;
     element = layui.element; 
     laydate =layui.laydate;         
     util =layui.util; 
     tree = layui.tree;  
     laypage =layui.laypage;
     upload =layui.upload; 

      //照片上传
      var uploadInst = upload.render({
      elem: '#upload_img', //绑定元素
      url: '/admin.php/admin/Users/upload_img' ,//上传接口
      accept :'images' ,//允许指定上传
      done: function(res){
        //上传完毕回调
        $('#preview_img').attr('src',res.msg);
        $('input[name="image"]').val(res.msg);
      }
      ,error: function(){
        //请求异常回调
      }
    });
    
     //用户名获取焦点
    $('#username').focus();
    //回车键登录
    $('input').keydown(function(e){
         //判断回车键按键码
      if(e.keyCode ==13){
        dologin();
      }
    });
    //出生日期
     laydate.render({
       elem : '#DateOfBirth'
       ,type:'date'
       ,trigger : 'click'
       ,format: 'yyyy-MM-dd '  
      });          
    //时间插件
     laydate.render({
       elem : '#input-start'
       ,min:0
       ,max:7
       ,type:'datetime'
       ,trigger : 'click'
       ,format: 'yyyy-MM-dd HH:mm'  
       //开始时间
       ,done:function(value, date, endDate){
        var startDate = new Date(value).getTime();
        var endTime = new Date($('#input-over').val()).getTime();
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
      
</script>