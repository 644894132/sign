<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\meeting\add.html";i:1572861812;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1570699778;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1572849076;}*/ ?>
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
    <div class="layui-layout layui-layout-admin">  
     <div><br>   
       <table>
         <thead>
          <tr>          
           <td>
           <?php if($type == 3): ?>
            <div class="layui-form-item">
             <label class="layui-form-label">会议编号</label>
            <div class="layui-input-inline">               
             <input type="text" name="id" class="layui-input" value="<?php echo $data['item']['id']; ?>" disabled>                            
            </div> 
            </div>
            <?php else: ?>

            </div> 
            </div>
            <?php endif; ?>
           </td>         
          </tr>
         </thead>
          <thead>
             <tr>          
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">会议的标题</label>
                <div class="layui-input-inline">
                <?php if($type == 3): ?>
                 <input type="text" name="title" class="layui-input" placeholder="请输入会议的标题" value="<?php echo $data['item']['title']; ?>" disabled> 
                 <?php else: ?>
                 <input type="text" name="title" class="layui-input" placeholder="请输入会议的标题" value="<?php echo $data['item']['title']; ?>">
                <?php endif; ?>
                </div> 
                </div>
               </td>         
             </tr>
          </thead>
          <thead>
             <tr>          
               <td>
               <?php if($type == 3): ?>
                <div class="layui-form-item">
                 <label class="layui-form-label">邀请人数</label>
                <div class="layui-input-inline">               
                 <input type="text" name="meeting_count" class="layui-input" value="<?php echo $data['item']['meeting_count']; ?>" disabled>                            
                </div> 
                </div>
                <?php else: ?>

                </div> 
                </div>
                <?php endif; ?>
               </td>         
             </tr>
          </thead>
           <thead>
             <tr>                      
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">会议开始时间</label>
                <div class="layui-input-inline">
                <?php if($type == 3): ?>
                 <input type="text" name="start" id="input-start" class="layui-input" placeholder="请选择会议开始时间" value="<?php echo date('Y-m-d H:i',$data['item']['start']); ?>" disabled>
                <?php else: ?>
                 <input type="text" name="start" id="input-start" class="layui-input" placeholder="请选择会议开始时间" value="<?php echo date('Y-m-d H:i',$data['item']['start']); ?>">
                 <?php endif; ?>
                </div> 
                </div>
               </td>            
             </tr>
          </thead>
          <thead>
             <tr>                     
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">会议时长(分钟)</label>
                <div class="layui-input-inline">
                <?php if($type == 3): ?>
                 <input type="text" name="duration" class="layui-input" placeholder="请选择会议时长" value="<?php echo $data['item']['duration']; ?>" disabled>
                <?php else: ?> 
                 <input type="text" name="duration" class="layui-input" placeholder="请选择会议时长" value="<?php echo $data['item']['duration']; ?>">
                <?php endif; ?> 
                </div> 
                </div>
               </td>         
             </tr>
          </thead>
          <thead>
           <tr>                        
             <td>
              <div class="layui-form-item">
               <label class="layui-form-label">会议主办单位(学院)</label>
              <div class="layui-input-inline">
              <?php if($type == 3): ?>
               <select name="unit" id="units" lay-filter="loadUser" disabled>
               <?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vo['Num']; ?>"><?php echo $vo['Name']; ?></option>
               <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <?php else: ?> 
              <select name="unit" id="units" lay-filter="loadUser">
               <?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vo['Num']; ?>"><?php echo $vo['Name']; ?></option>
               <?php endforeach; endif; else: echo "" ;endif; ?>
              </select>
              <?php endif; ?>
              </div> 
              </div>
             </td>         
           </tr>
          </thead>

          <thead>
             <tr>          
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">会议负责人</label>
                <div class="layui-input-inline">
                <?php if($type == 3): ?>
                 <select name="attn" id="attns">
                 <?php if(is_array($result) || $result instanceof \think\Collection || $result instanceof \think\Paginator): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                   <option value="<?php echo $vo['Name']; ?>"><?php echo $vo['Name']; ?></option>
                 <?php endforeach; endif; else: echo "" ;endif; ?>
                 </select>
                <?php else: ?> 
                 <select name="attn" id="attns">
                 <?php if(is_array($result) || $result instanceof \think\Collection || $result instanceof \think\Paginator): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                   <option value="<?php echo $vo['Name']; ?>"><?php echo $vo['Name']; ?></option>
                 <?php endforeach; endif; else: echo "" ;endif; ?>
                 </select> 
                <?php endif; ?>
                </div> 
                </div>
               </td>         
             </tr>
          </thead>         
          <thead>
             <tr>                       
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">负责人电话</label>
                <div class="layui-input-inline">
                <?php if($type == 3): ?>
                 <input type="text" maxlength="11" name="telephone" class="layui-input" placeholder="请输入联系人电话" value="<?php echo $data['item']['telephone']; ?>" disabled>
                <?php else: ?> 
                 <input type="text" maxlength="11" name="telephone" class="layui-input" placeholder="请输入联系人电话" value="<?php echo $data['item']['telephone']; ?>"> 
                <?php endif; ?>
                </div> 
                </div>
               </td>         
             </tr>
          </thead>  
          <thead>
             <tr>                        
               <td>
               <?php if($type == 3): ?>
                <div class="layui-form-item">
                 <label class="layui-form-label">会议状态</label>
                <div class="layui-input-inline"> 
                <?php if($data['item']['condition'] == 0): ?>              
                 <input type="text"  name="condition" class="layui-input" style="color:#4169E1" value="未开始" disabled>
                <?php elseif($data['item']['condition'] == 1): ?>  
                <input type="text"  name="condition" class="layui-input" style="color:#006400" value="进行中" disabled>
                <?php elseif($data['item']['condition'] == 2): ?>  
                <input type="text"  name="condition" class="layui-input" style="color:red" value="已结束" disabled>
                <?php endif; else: endif; ?>
                </div> 
                </div>
               </td>         
             </tr>
          </thead>        
       </table> 
        <div class="layui-form-item">
        <?php if($type == 3): else: ?>  
         <button type="button" class="layui-btn layui-btn-radius layui-btn-normal" style="margin-left:120px" onclick="save()">保存</button>
        <?php endif; ?>
        </div>              
     </div>
    </div>
  </form>  
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
layui.use(['layer','form'],function(){
      $ =layui.jquery;
  layer =layui.layer;
   form =layui.form;

  form.on('select(loadUser)',function(data){
    var num = data.value;
    console.log(data.elem);
    $.post("<?php echo url('Meeting/loadUser'); ?>",{num:num},function(res){
      res = JSON.parse(res);    
      $("#attns").empty();
      $(res).each(function(index) {
        $("#attns").append('<option value="'+res.Account+'">'+res.dname+'</option>');
        console.log(res);
        form.render('select');       
      });
    });
  }); 
}); 
  //保存
  function save(){
    $.post("<?php echo url('Meeting/save'); ?>",$('form').serialize(),function(res){
     if(res.code>0){
      layer.alert(res.msg,{icon:2});
    }else{
      layer.msg(res.msg);
      setTimeout(function(){parent.window.location.reload()},1000);
    }      
  },'json');
  }
</script>
