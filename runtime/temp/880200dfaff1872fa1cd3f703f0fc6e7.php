<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:91:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\meeting\public_pages.html";i:1567393707;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1566614346;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1567147564;}*/ ?>
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
          

  &nbsp;&nbsp;&nbsp;&nbsp;<span class="layui-btn layui-btn-radius layui-btn-primary"><b style="color:#000000">标签指定老师列表</b>
  </span><hr><br>
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
        //签到添加
         function sign_add(id){
            //iframe层
            layer.open({
              //弹框样式
              type: 2,
              title:id>0?'编辑':'添加', //
              //shadeClose: true,
              //弹框阴影色度
              shade: 0.5,
              //弹框宽高
              area: ['500px', '500px'],
              //URL地址
              content: '/admin.php/admin/Gather/personnel_add?id='+id //iframe的url  
           });     
       }
       //签到删除
      function sign_remove(id){
        //询问框
        layer.confirm('确认要删除吗?', {
          icon :8,
          btn: ['确定','取消'] //按钮
        }, function(){
          //提交数据，跳转页面
          $.post('/admin.php/admin/Gather/delete',{'id':id},function(res){
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
<script type="text/javascript">  
</script>