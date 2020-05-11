<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\admin\index.html";i:1567825637;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1568183374;}*/ ?>
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
    <span>管理员列表</span>
    <button class="layui-btn" style="float:right;" onclick="add()"><i class="layui-icon">&#xe608;</i>添加</button>
    <div></div>
  </div>  
    <table class="layui-table">
      <thead>
       <tr>
         <td>ID</td>
         <td>用户名</td>
         <td>真实姓名</td>
         <td>角色</td>
         <td>状态</td>
         <td>添加时间</td>
         <td>操作</td>
       </tr>
      </thead>
      <thead>
      <?php if(is_array($data['data']['lists']) || $data['data']['lists'] instanceof \think\Collection || $data['data']['lists'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['data']['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
         <td><?php echo $vo['id']; ?></td>
         <td><?php echo $vo['username']; ?></td>
         <td><?php echo $vo['truename']; ?></td>
         <td><?php echo isset($data['groups'][$vo['gid']]) ?$data['groups'][$vo['gid']]['title'] :''; ?></td>
         <td><?php echo $vo['status']==0?'<span style="color:green">正常</span>' : '<span style="color:#FF0000"><b>禁用</b></span>'; ?></td>
         <td><?php echo date('Y-m-d H:i:s',$vo['add_time']); ?></td>
         <td>
           <button class="layui-btn" onclick="add(<?php echo $vo['id']; ?>)">编辑</button>
           <button class="layui-btn layui-btn-danger " onclick="del(<?php echo $vo['id']; ?>)">删除</button>
         </td>
        </tr>
       <?php endforeach; endif; else: echo "" ;endif; ?>
      </thead>  
    </table>
   <div id="pages" style="text-align:center"></div>   
</body>
</html>
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
   
        //添加管理员
      function add(id){
            //iframe层
            layer.open({
              //弹框样式
              type: 2,
              title:id >0 ?'编辑管理员':'添加管理员', //
              //shadeClose: true,
              //弹框阴影色度
              shade: 0.5,
              //弹框宽高
              area: ['500px', '450px'],
              //URL地址
              content: '/admin.php/admin/Admin/add?id='+id //iframe的url  
       });
   }
      //删除
      function del(id){
        //询问框
        layer.confirm('确认要删除吗?', {
          icon :8,
          btn: ['确定','取消'] //按钮
        }, function(){
          //提交数据，跳转页面
          $.post('/admin.php/admin/Admin/delete',{'id':id},function(res){
            if(res.code>0){
                layer.alert(res.msg,{icon:6});
            }else{
                layer.msg(res.msg);
                setTimeout(function(){window.location.reload();},1000);
            }
          },'json');
        });
      }
</script>