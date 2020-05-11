<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\admin\add.html";i:1566443903;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1568183374;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1568690580;}*/ ?>
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
          

  <form class="layui-form">
    <input type="hidden" name="id" value="<?php echo $data['item']['id']; ?>">
   <div style="width:500px;">
      <div class="layui-form-item">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
          <input type="text" name="username"  class="layui-input" placeholder="请输入用户名" value="<?php echo $data['item']['username']; ?>" <?php echo $data['item']['id']>0?'readonly':''; ?>>
        </div>
      </div>
      <div class="layui-form-item">
         <label class="layui-form-label">角&nbsp;&nbsp;&nbsp;&nbsp;色</label>
         <div class="layui-input-inline">
           <select name="gid">          
               <option value=0></option>
               <?php if(is_array($data['groups']) || $data['groups'] instanceof \think\Collection || $data['groups'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['groups'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
               <option value="<?php echo $vo['gid']; ?>" <?php echo $vo['gid']==$data['item']['gid']?'selected': ''; ?>><?php echo $vo['title']; ?></option>
               <?php endforeach; endif; else: echo "" ;endif; ?> 
           </select>
         </div>
      </div>
      <div class="layui-form-item">
         <label class="layui-form-label">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
         <div class="layui-input-inline">
            <input type="text" name="password"  class="layui-input"  placeholder="请输入密码" >
         </div>
      </div>
     <div class="layui-form-item">
         <label class="layui-form-label">姓&nbsp;&nbsp;&nbsp;&nbsp;名</label>
         <div class="layui-input-inline">
            <input type="text" name="truename"  class="layui-input" placeholder="请输入真实姓名" value="<?php echo $data['item']['truename']; ?>">
         </div>
      </div>
     <div class="layui-form-item">
         <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
         <div class="layui-input-inline">
            <input type="checkbox" name="status" lay-skin="primary" title="禁用" value="1" <?php echo !empty($data['item']['status'])?'checked' :''; ?>>
         </div>
      </div>
    </form>      
      <div class="layui-form-item">
        <div class="layui-input-block">
         <button type="button" class="layui-btn" onclick="save()" >保存</button>
        </div> 
      </div>
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
      //获取数据
      var id =parseInt($('input[name="id"]').val());
      var username =$.trim($('input[name="username"]').val());
      var password =$.trim($('input[name="password"]').val());
      var gid =$('select[name="gid"]').val();
      var truename =$.trim($('input[name="truename"]').val());

     //判断用户名是否为空
      if(username ==''){
        layer.alert('请输入用户名',{icon:2});
        return;
      }
      //判断密码是否为空
      if(isNaN(id) && password== ''){
        layer.alert('请输入密码',{icon:2});
        return;
      }
      //判断角色是否为空
      if(gid ==0){
        layer.alert('请输入角色',{icon:2});
        return;
      }
      //判断真实姓名是否为空
      if(truename ==''){
        layer.alert('请输入真实姓名',{icon:2});
        return;
      }
     
      //将数据提交至后台
      $.post('/admin.php/admin/Admin/save',$('form').serialize(),function(res){
         if(res.code >0){
            layer.alert(res.msg,{icon:2});
         }else{
            layer.msg(res.msg);
            //页面跳转
            setTimeout(function(){parent.window.location.reload();},1000);
         }
      },'json');
   }
</script>