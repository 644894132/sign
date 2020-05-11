<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:90:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\meeting\invite_info.html";i:1571302125;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1570699778;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1572518353;}*/ ?>
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
          

<style type="text/css">
  .top{width: 100%;height: 60px;background: white;z-index: 9999;position: fixed;top: 0;}
</style>
<div class="layui-form-item top">
<br>
&nbsp;&nbsp;&nbsp;&nbsp;<span class="layui-btn layui-btn-radius layui-btn-disabled"><b style="color:#000000">邀请名单</b></span>
<!-- 传递一个参数,不为空就显示'删除按钮' -->
<?php if($permission == 1): ?>
<a class="layui-btn layui-btn-lg" style="float:right;margin-right:20px" href="<?php echo url('Meeting/download',['MeetingID'=>$MeetingID]); ?>"><i class="layui-icon">&#xe601;</i>生成Excel文件</a> 
<?php elseif($permission == 2): ?>
<a class="layui-btn layui-btn-lg" style="float:right;margin-right:20px" href="<?php echo url('Meeting/download',['MeetingID'=>$MeetingID]); ?>"><i class="layui-icon">&#xe601;</i>生成Excel文件</a>
<?php endif; ?>
</div><br><br><br><br><hr>
<table class="layui-table">
  <thead>
   <tr>
    <td>个人编号</td>
    <td>会议编号</td>
    <td>姓名</td>
    <td>性别</td>
    <?php if($permission == 1): ?>
    <td>状态</td>
    <?php else: endif; ?>
   </tr>
  </thead> 
  <thead>
   <?php if(is_array($data['lists']) || $data['lists'] instanceof \think\Collection || $data['lists'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
   <tr>
    <td><?php echo $vo['Account']; ?></td>
    <td><?php echo $vo['number']; ?></td>
    <!-- <td><?php echo $vo['ClassNum']; ?></td> -->
    <td><?php echo $vo['Name']; ?></td>
    <td><?php echo $vo['Sex']==1?'男':'女'; ?></td>
    <?php if($permission == 1): if($vo['sign_status'] == 0): ?>
    <td style="color:#C0C0C0">缺席</td>
    <?php elseif($vo['sign_status'] == 1): ?>
    <td style="color:green">已签到</td>
    <?php elseif($vo['sign_status'] == 2): ?>
    <td style="color: red;">已请假</td>
    <?php endif; else: endif; ?>
   </tr>
   <?php endforeach; endif; else: echo "" ;endif; ?>
  </thead>
</table>
<div id="pages" style="text-align:center"></div>  
<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
<script type="text/javascript" src="/static/plugins/echarts4/echarts.min.js" ></script>
<script type="text/javascript" src="/static/plugins/layui/jquery-1.7.2.min.js" ></script>
<script type="text/javascript">

layui.use(['layer','tree','laydate','form','upload','laypage','element','laydate','util','transfer'],function(){
     $ =layui.jquery;
     layer =layui.layer;
     form =layui.form;
     element = layui.element; 
     laydate =layui.laydate;         
     util =layui.util; 
     tree = layui.tree;  
     laypage =layui.laypage;
     upload =layui.upload; 
     transfer = layui.transfer;

       //状态监听提交
        form.on('switch(switchTest)', function (data) {
            // console.log(data.elem); //得到checkbox原始DOM对象
            console.log(data.elem.checked); //开关是否开启，true或者false
            console.log(data.value); //开关value值，也可以通过data.elem.value得到
            // console.log(data.othis); //得到美化后的DOM对象
            var x=data.elem.checked;
            layer.open({
                content: '确定修改状态吗?'
                ,btn: ['确定', '取消']
                ,yes: function(index, layero){
                    data.elem.checked=x;
                    form.render();
                    layer.close(index);
                    //按钮【按钮一】的回调
                    $.post("<?php echo url('Panel/change'); ?>", {Account:data.value, status:data.elem.checked ? 1 : 0}, function (res) {
                      setTimeout(function(){window.location.reload();},200);
                      console.log(res);
                    })
                }
                ,btn2: function(index, layero){
                    //按钮【按钮二】的回调
                    data.elem.checked=!x;
                    form.render();
                    layer.close(index);
                    //return false 开启该代码可禁止点击该按钮关闭
                }
            });
            return false;
        });


      //照片上传
      var uploadInst = upload.render({
      elem: '#upload_img', //绑定元素
      url: "<?php echo url('Users/upload_img'); ?>" ,//上传接口
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
       ,min:-360
       ,max:1800
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
      setTimeout(function(){window.location.href="<?php echo url('Gather/conferee_statistics'); ?>"},500);
    }
    //添加菜单点击事件
  function menuFire(obj){
    //获取src
    var src =$(obj).attr('src');
    //设置iframe的src
    $('iframe').attr('src',src);
    /*$(".layui-nav-item").removeClass("layui-nav-item");
    $(this).addClass("layui-nav-item");*/
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
          area: ['600px', '700px'],
          //URL地址
          content: '/admin.php/admin/Meeting/add?id='+id+'&type='+type //iframe的url  
       });
   }
   //下载
   function download(id){
        var arr = [];
          $("input.checkAll").each(function(index){
            if ($(this).attr("checked")) {
              $val = $(this).parent().next().text();
              arr[index] = $val;
            }
          });
        //询问框
        layer.confirm('确认要下载吗?', {
          icon :8,
          btn: ['确定','取消'] //按钮
        }, function(){
          //提交数据，跳转页面
          $.post("<?php echo url('Gather/download'); ?>",{'checkAll':arr},function(res){
            if(res.code>0){
                layer.alert(res.msg,{icon:2});
            }else{
                layer.msg(res.msg);
                setTimeout(function(){window.location.reload();},1000);
            }
          },'json');
        });
      }
</script>           
<script type="text/javascript"> 
      //删除
    function del(id,status){
      var arr = [];
      $("input.checkAll").each(function(index){
        if ($(this).attr("checked")) {
          $val = $(this).parent().next().text();
          arr[index] = $val;
       }
    });
    //询问框
    layer.confirm('确认要删除吗?', {
      icon :8,
      btn: ['确定','取消'] //按钮
    }, function(){
      //提交数据，跳转页面
      $.post('/admin.php/admin/Meeting/remove',{'checkAll':arr, 'id':id},function(res){
        if(res.code>0){
            layer.alert(res.msg,{icon:2});
        }else{
            layer.msg(res.msg);
            setTimeout(function(){window.location.reload();},1000);
        }
      },'json');
    });
  }     
</script>

