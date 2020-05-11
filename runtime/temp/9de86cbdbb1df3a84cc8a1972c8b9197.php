<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\personal\index.html";i:1572573821;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1570699778;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1572849076;}*/ ?>
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
  .active { background-background-color:green; }
</style>
	<div class="header">
	 <span>会议列表</span>
	 <div></div>
	</div> 
	<br>
  <div style="width:100%;height:100%;">
    <div style="margin-left:15px;">
     <div class="layui-btn layui-btn-radius layui-btn-primary" >会议列表</div>
    </div><br>
  <?php if(is_array($data['lists']) || $data['lists'] instanceof \think\Collection || $data['lists'] instanceof \think\Paginator): $key = 0; $__LIST__ = $data['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($vo['condition'] == 2): else: if($vo['sign_status'] == 2): else: if($vo['sign_status'] == 1): else: ?>
          <div style="margin-left:20px;margin-top:20px;float:left;box-shadow:10px 10px  5px #00FA9A;">
            <div class="layui-row layui-col-space10">
             <button type="button" onclick="sign_page(<?php echo $vo['id']; ?>)">
              <div class="layui-col-md4">
                <thead>
                   <tr>          
                     <td>
                      <div class="layui-form-item">
                       <label class="layui-form-label">会议名称</label>
                      <div class="layui-input-inline">
                       <input type="text" name="title" class="layui-input" value="<?php echo $vo['title']; ?>" disabled> 
                      </div> 
                      </div>
                     </td>         
                   </tr>
                </thead>
                <thead>
                 <tr>                       
                   <td>
                    <div class="layui-form-item">
                     <label class="layui-form-label">会议开始时间</label>
                    <div class="layui-input-inline">
                     <input type="text" name="start" class="layui-input" value="<?php echo date('Y-m-d H:i',$vo['start']); ?>" disabled> 
                    </div> 
                    </div>
                   </td>         
                 </tr>
                </thead>
               </div>
             </button>
            </div>
          </div>
        <?php endif; endif; endif; endforeach; endif; else: echo "" ;endif; ?>
  </div><hr><br><hr>
    
  <div style="width:100%;height:100%;">
    <div style="margin-left:15px;">
     <div class="layui-btn layui-btn-radius layui-btn-primary">待审核</div>
    </div><br>
    <?php if(is_array($data['lists']) || $data['lists'] instanceof \think\Collection || $data['lists'] instanceof \think\Paginator): $key = 0; $__LIST__ = $data['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($vo['audit_status'] == 1): else: if($vo['sign_status'] == 2): ?>       
          <div style="margin-left:20px;margin-top:20px;float:left;box-shadow:10px 10px  5px yellow;">
            <div class="layui-row layui-col-space10">
             <button type="button" onclick="sign_page(<?php echo $vo['id']; ?>)">
              <div class="layui-col-md4">
                <thead>
                   <tr>          
                     <td>
                      <div class="layui-form-item">
                       <label class="layui-form-label">会议名称</label>
                      <div class="layui-input-inline">
                       <input type="text" name="title" class="layui-input" value="<?php echo $vo['title']; ?>" disabled> 
                      </div> 
                      </div>
                     </td>         
                   </tr>
                </thead>
                <thead>
                 <tr>                       
                   <td>
                    <div class="layui-form-item">
                     <label class="layui-form-label">会议开始时间</label>
                    <div class="layui-input-inline">
                     <input type="text" name="start" class="layui-input" value="<?php echo date('Y-m-d H:i',$vo['start']); ?>" disabled> 
                    </div> 
                    </div>
                   </td>         
                 </tr>
                </thead>
              </div>
             </button>
            </div>
          </div>
        <?php endif; endif; endforeach; endif; else: echo "" ;endif; ?> 
  </div><hr><br><hr> 

  <div style="width:100%;height:100%;">
    <div style="margin-left:15px;">
     <div class="layui-btn layui-btn-radius layui-btn-primary">已完成</div>
    </div><br>
    <?php if(is_array($data['lists']) || $data['lists'] instanceof \think\Collection || $data['lists'] instanceof \think\Paginator): $key = 0; $__LIST__ = $data['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;if($vo['sign_status'] == 1): ?>
        <div style="margin-left:20px;margin-top:20px;float:left;box-shadow:10px 10px  5px gray;">
         <div class="layui-row layui-col-space10">
         <button type="button" onclick="sign_page(<?php echo $vo['id']; ?>)">
          <div class="layui-col-md4">
            <thead>
               <tr>          
                 <td>
                  <div class="layui-form-item">
                   <label class="layui-form-label">会议名称</label>
                  <div class="layui-input-inline">
                   <input type="text" name="title" class="layui-input" value="<?php echo $vo['title']; ?>" disabled> 
                  </div> 
                  </div>
                 </td>         
               </tr>
            </thead>
            <thead>
             <tr>                       
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">会议开始时间</label>
                <div class="layui-input-inline">
                 <input type="text" name="start" class="layui-input" value="<?php echo date('Y-m-d H:i',$vo['start']); ?>" disabled> 
                </div> 
                </div>
               </td>         
             </tr>
            </thead>
           </div>
           </button>
         </div>
        </div>
      <?php elseif($vo['condition'] == 2): ?>
        <div style="margin-left:20px;margin-top:20px;float:left;box-shadow:10px 10px  5px red;">
         <div class="layui-row layui-col-space10">
         <button type="button" onclick="sign_page(<?php echo $vo['id']; ?>)">
          <div class="layui-col-md4">
            <thead>
               <tr>          
                 <td>
                  <div class="layui-form-item">
                   <label class="layui-form-label">会议名称</label>
                  <div class="layui-input-inline">
                   <input type="text" name="title" class="layui-input" value="<?php echo $vo['title']; ?>" disabled> 
                  </div> 
                  </div>
                 </td>         
               </tr>
            </thead>
            <thead>
             <tr>                       
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">会议开始时间</label>
                <div class="layui-input-inline">
                 <input type="text" name="start" class="layui-input" value="<?php echo date('Y-m-d H:i',$vo['start']); ?>" disabled> 
                </div> 
                </div>
               </td>         
             </tr>
            </thead>
           </div>
           </button>
         </div>
        </div>
      <?php elseif($vo['audit_status'] == 1): ?>       
        <div style="margin-left:20px;margin-top:20px;float:left;box-shadow:10px 10px  5px gray;">
         <div class="layui-row layui-col-space10">
         <button type="button" onclick="sign_page(<?php echo $vo['id']; ?>)">
          <div class="layui-col-md4">
            <thead>
               <tr>          
                 <td>
                  <div class="layui-form-item">
                   <label class="layui-form-label">会议名称</label>
                  <div class="layui-input-inline">
                   <input type="text" name="title" class="layui-input" value="<?php echo $vo['title']; ?>" disabled> 
                  </div> 
                  </div>
                 </td>         
               </tr>
            </thead>
            <thead>
             <tr>                       
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">会议开始时间</label>
                <div class="layui-input-inline">
                 <input type="text" name="start" class="layui-input" value="<?php echo date('Y-m-d H:i',$vo['start']); ?>" disabled> 
                </div> 
                </div>
               </td>         
             </tr>
            </thead>
           </div>
           </button>
         </div>
        </div> 
      <?php endif; endforeach; endif; else: echo "" ;endif; ?> 
  </div><hr><br><hr>
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
          shade: 0.9,
          //弹框宽高
          area: ['600px', '700px'],
          //URL地址
          content: '<?php echo url("Meeting/add"); ?>?id='+id+'&type='+type //iframe的url  
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
  //签到界面
  function sign_page(id){
    //iframe层
    layer.open({
      //弹框样式
      type: 2,
      title:'<button class="layui-btn layui-btn-radius layui-btn-primary">会议信息</button>', //
      //shadeClose: true,
      //弹框阴影色度
      shade: 0.8,
      //弹框宽高
      area: ['800px', '700px'],
      //URL地址
      content: '<?php echo url("Personal/sign_page"); ?>?id='+id //iframe的url  
   });
}
</script>