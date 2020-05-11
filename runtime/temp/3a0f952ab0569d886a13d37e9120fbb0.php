<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\panel\authority.html";i:1569753171;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>角色添加</title>
	<link rel ="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
  <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
</head>
<body style="padding:10px;">
	<form class="layui-form">
       <div class="layui-form-item">
          <label class="layui-form-label">角色名称</label>
          <div class="layui-input-block">

          </div>
       </div>

       <div class="layui-form-time">
          <label class="layui-form-label">权限菜单</label>
       </div>
   </form>
     <div class="layui-form-item" style="margin-top:10px;">
       <div class="layui-input-block">
          <button class="layui-btn" onclick="save()">保存</button>
       </div>
     </div>
  </body>
</html>
<script type="text/javascript">
    layui.use(['layer','form'],function(){
      var form =layui.form;
      layer =layui.layer;
      $ =layui.jquery;
    });

    //保存
    function save(){
      var title =$.trim($('input[name ="title"]').val());
      if(title ==''){
         layer.msg('壮士,请填写用户名称',{'icon':2});
         return;
      }
      $.post('/admins.php/admins/roles/save',$('form').serialize(),function(res){
          if(res.code >0){
            layer.msg(res.msg,{'icon':2});
          }else{
            layer.msg(res.msg,{'icon':1});
            setTimeout(function(){parent.window.location.reload();
            },1000);
          }
      },'json');
    }
</script>