<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:81:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\panel\menu.html";i:1569753441;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1569669079;}*/ ?>
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
   <span>菜单管理</span>
   <button class="layui-btn layui-btn-primary layui-btn-sm" style="float:right;margin:5px;top:0px;" onclick="back(); return false;">返回上一级</button>
   <div></div>
 </div>  
    <form class="layui-form">     
	     <table class="layui-table">
	        <thead>
	          <tr>
	            <th>ID</th>
	            <th>排序</th>
	            <th>菜单名称</th>
	            <th>controller</th>
	            <th>method</th>
	            <th>是否隐藏</th>
	            <th>是否禁用</th>
	            <th></th>
	          </tr>
	        </thead>
	        <tbody>
	            <tr>
	             
	            </tr>
	            <tr>
                  <td></td>
                  <td><input type="text" class="layui-input" name="ords[0]"></td>
	              <td><input type="text" class="layui-input" name="titles[0]" ></td>
	              <td><input type="text" class="layui-input" name="controllers[0]" ></td>
	              <td><input type="text" class="layui-input" name="methods[0]" ></td>
	              <td><input type="checkbox" lay-skin="primary" name="ishiddens[0]" title="隐藏" value=1></td>
	              <td><input type="checkbox" lay-skin="primary" name="status[0]" title="禁用" value=1></td>
                  <td></td>
	            </tr>
	        </tbody>
	     </table>
    </form> 
    <button class="layui-btn" onclick="save()">保存</button>
     <!-- 设置样式 -->
     <script type="text/javascript">
     </script>
</body>
</html>