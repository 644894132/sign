<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\personal\sign_page.html";i:1572832355;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1570699778;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1572849076;}*/ ?>
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
    <div class="layui-layout layui-layout-admin">  
     <div><br>   
       <table>
         <thead>
           <tr>          
             <td>
              <div class="layui-form-item">
               <label class="layui-form-label">会议的编号</label>
              <div class="layui-input-inline">
               <input type="text" name="id" class="layui-input" value="<?php echo $result['id']; ?>" disabled> 
              </div> 
              </div>
             </td> 
             <td>
              <div class="layui-form-item">
               <label class="layui-form-label">会议的标题</label>
              <div class="layui-input-inline">
               <input type="text" name="title" class="layui-input" value="<?php echo $result['title']; ?>" disabled> 
              </div> 
              </div>
             </td>        
           </tr>
         </thead>

          <thead>
           <tr>          
             <td>
              <div class="layui-form-item">
               <label class="layui-form-label">邀请人数</label>
              <div class="layui-input-inline">               
               <input type="text" name="meeting_count" class="layui-input" value="<?php echo $result['meeting_count']; ?>" disabled>                            
              </div> 
              </div>
              </div> 
              </div>
             </td> 
             <td>
              <div class="layui-form-item">
               <label class="layui-form-label">会议开始时间</label>
              <div class="layui-input-inline">
               <input type="text" name="start" id="input-start" class="layui-input"  value="<?php echo date('Y-m-d H:i',$result['start']); ?>" disabled>
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
               <input type="text" name="duration" class="layui-input" value="<?php echo $result['duration']; ?>" disabled>
              </div> 
              </div>
             </td>
             <td>
              <div class="layui-form-item">
               <label class="layui-form-label">会议主办单位(学院)</label>
              <div class="layui-input-inline">
              <select name="unit" disabled>
               <?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                  <option value="<?php echo $vo['Name']; ?>"><?php echo $vo['Name']; ?></option>
               <?php endforeach; endif; else: echo "" ;endif; ?> 
              </select>
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
               <input type="text" maxlength="11" name="telephone" class="layui-input"  value="<?php echo $result['telephone']; ?>" disabled> 
              </div> 
              </div>
             </td>
             <td>
              <div class="layui-form-item">
               <label class="layui-form-label">会议负责人</label>
              <div class="layui-input-inline">
                 <input type="text" name="attn" class="layui-input" value="<?php echo $result['attn']; ?>"  readonly>
              </div> 
              </div>
             </td>          
            </tr>
          </thead>
  
          <thead>
           <tr>                        
            <td>
              <div class="layui-form-item">
               <label class="layui-form-label">会议状态</label>
              <div class="layui-input-inline"> 
              <?php if($result['condition'] == 0): ?>              
               <input type="text"  name="condition" class="layui-input" style="color:#4169E1" value="未开始" disabled>
              <?php elseif($result['condition'] == 1): ?>  
              <input type="text"  name="condition" class="layui-input" style="color:#006400" value="进行中" disabled>
              <?php elseif($result['condition'] == 2): ?>  
              <input type="text"  name="condition" class="layui-input" style="color:red" value="已结束" disabled>
              <?php endif; ?>
              </div> 
              </div>
            </td> 
            <td>
              <div class="layui-form-item">
               <label class="layui-form-label">签到时间</label>
              <div class="layui-input-inline">
               <input type="text" name="sign_time" class="layui-input" value="<?php echo date('Y-m-d H:i',$result['sign_time']); ?>" disabled> 
              </div> 
              </div>
            </td>         
           </tr>
          </thead>
          
          <thead>          
           <tr> 
             <?php if($result['condition'] == 2): ?>                      
              <td>             
                <div class="layui-form-item">
                 <label class="layui-form-label">状态</label>
                <div class="layui-input-inline">
                 <?php if($result['sign_status'] == 0): ?>
                 <input type="text" name="sign_status" class="layui-input"  value="缺席" disabled> 
                 <?php elseif($result['sign_status'] == 1): ?>
                 <input type="text" name="sign_status" class="layui-input"  value="已签到" disabled>
                 <?php elseif($result['sign_status'] == 2): ?>
                 <input type="text" name="sign_status" class="layui-input"  value="请假" disabled>
                 <?php endif; ?>
                </div> 
                </div>             
              </td>
              <?php endif; if($result['sign_status'] == 2): ?>                  
                <td>     
                 <div class="layui-form-item">
                   <label class="layui-form-label">审核</label>
                  <div class="layui-input-inline">
                    <select name="audit" id="audits">
                       <option value="1"><?php echo $result['audit']; ?></option>
                     </select>
                  </div> 
                 </div>                              
                </td>
              <?php elseif($result['condition'] == 2): elseif($result['condition'] == 1): else: ?>  
                <td>     
                 <div class="layui-form-item">
                   <label class="layui-form-label">审核</label>
                  <div class="layui-input-inline">
                    <select name="audit" id="audits" >
                      <?php if(is_array($parson) || $parson instanceof \think\Collection || $parson instanceof \think\Paginator): $i = 0; $__LIST__ = $parson;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                       <option value="<?php echo $vo['name']; ?>"><?php echo $vo['name']; ?></option>
                      <?php endforeach; endif; else: echo "" ;endif; ?> 
                     </select>
                  </div> 
                 </div>                              
                </td>
              <?php endif; ?>          
           </tr>           
          </thead> 

          <thead>
           <tr>                       
            <td>
            <?php if($result['condition'] == 2): ?>
              <div class="layui-form-item">
                <label class="layui-form-label">审核状态</label>
              <div class="layui-input-inline"> 
               <?php if($result['audit_status'] == 0): ?>                            
                <input type="text" name="audit_status" class="layui-input" style="color:red" value="审核中" disabled>
               <?php elseif($result['audit_status'] == 1): ?>                            
                <input type="text" name="audit_status" class="layui-input"  style="color:green" value="同意" disabled>
               <?php elseif($result['audit_status'] == 2): ?>                            
                <input type="text" name="audit_status" class="layui-input"  style="color:#A9A9A9" value="不同意" disabled>
               <?php endif; ?>                             
               </div> 
              </div> 
            <?php elseif($result['sign_status'] == 2): ?>            
              <div class="layui-form-item">
                <label class="layui-form-label">审核状态</label>
              <div class="layui-input-inline"> 
               <?php if($result['audit_status'] == 0): ?>                            
                <input type="text" name="audit_status" class="layui-input" style="color:red" value="审核中" disabled>
               <?php elseif($result['audit_status'] == 1): ?>                            
                <input type="text" name="audit_status" class="layui-input"  style="color:green" value="同意" disabled>
               <?php elseif($result['audit_status'] == 2): ?>                            
                <input type="text" name="audit_status" class="layui-input"  style="color:#A9A9A9" value="不同意" disabled>
               <?php endif; ?>                             
               </div> 
              </div>
            <?php endif; ?>            
            </td>

            <?php if($result['audit_status'] == 1): ?>
              <td>   
               <div class="layui-form-item">
                 <label class="layui-form-label">审批</label>
                <div class="layui-input-inline">
                  <select>                    
                    <?php if(is_array($onlody) || $onlody instanceof \think\Collection || $onlody instanceof \think\Paginator): $i = 0; $__LIST__ = $onlody;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cvo): $mod = ($i % 2 );++$i;?> 
                      <option value="1" selected><?php echo $cvo['Name']; ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
                </div> 
               </div>                              
              </td>
            <?php endif; ?>         
           </tr>
          </thead>

          <thead>          
            <?php if($result['sign_status'] == 2): ?>
             <tr>                                            
              <td>            
                <div class="layui-form-item">
                  <label class="layui-form-label">请假原因</label>
                <div class="layui-input-inline">                             
                  <textarea placeholder="填写请假原因" id="reason" disabled><?php echo $result['leave_cause']; ?></textarea>           
                </div> 
                </div>             
              </td>                   
             </tr>
            <?php elseif($result['condition'] == 0): ?> 
              <tr>                                            
              <td>            
                <div class="layui-form-item">
                  <label class="layui-form-label">请假原因</label>
                <div class="layui-input-inline">                             
                  <textarea placeholder="填写请假原因" id="reason"><?php echo $result['leave_cause']; ?></textarea>           
                </div> 
                </div>             
              </td>                   
             </tr>
            <?php endif; ?> 
          </thead>     
       </table> 
        <div class="layui-form-item" style="text-align:center">
          <?php if($result['condition'] == 2): ?>
           <button type="button" class="layui-btn" style="background-color:grey;cursor:not-allowed;">签到结束</button>
          <?php endif; if($result['condition'] == 1): if(empty($result['sign_status'])): ?>
              <button type="button" class="layui-btn" onclick="sign('<?php echo $result['number']; ?>','<?php echo $result['Account']; ?>',this)">签到</button>
              <?php elseif($result['sign_status'] == 1): ?>
              <button type="button" class='layui-btn' style="background-color:grey;cursor:not-allowed;">已签到</button>      
              <?php endif; endif; if($result['condition'] == 0): if($result['sign_status'] == 2): ?>
                <button type="button" class='layui-btn' style="background-color:#FF4500;cursor:not-allowed;">已请假</button>
              <?php elseif($result['audit_status'] == 2): ?>
                <button type="button" class='layui-btn' style="background-color:grey;cursor:not-allowed;">请假</button> 
              <?php else: ?>
                <button type="button" class='layui-btn' onclick="leave('<?php echo $result['number']; ?>','<?php echo $result['Account']; ?>',this)">请假</button>            
              <?php endif; endif; if($result['audit_status'] == 1): ?> 
              <button type="button" class='layui-btn' style="background-color:#FF4500;cursor:not-allowed;">已请假</button>
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
    //个人签到
  function sign(meeting_id, teacher_account,obj){
    var id =parseInt($('input[name="id"]').val());

    //询问框
      layer.confirm('确定要签到吗?',{
        icon :8,
        btn: ['确定','取消'] //按钮
      },function(){
    $.post("<?php echo url('Personal/save_sign'); ?>",{'meeting_id':meeting_id,'teacher_account':teacher_account},function(res){
         if(res.code >0){
            layer.msg(res.msg,{icon:2});
         }else{
            layer.msg(res.msg);
            setTimeout(function(){parent.window.location.reload();},500); 
         }            
      },'json');
    });
  }  
   //个人请假
  function leave(meeting_id, teacher_account, obj){
    var audit = $("#audits").val();
    console.log('Value:' + audit);
    //var audit_status =$.trim($('input[name="audit_status"]').val());
    //询问框
      layer.confirm('确定要请假吗?',{
        icon :8,
        btn: ['确定','取消'] //按钮
      },function(){
    $.post("<?php echo url('Personal/save_leave'); ?>",{audit:$("#audits").val(),'meeting_id':meeting_id,'teacher_account':teacher_account, leave_cause:$("#reason").val().trim()},function(res){
        //判断
        if(res.code>0){
          layer.alert(res.msg,{icon:2});
        }else{
          layer.msg(res.msg);
           setTimeout(function(){parent.window.location.reload()},1000);  
        }               
      },'json');
    });
  }
</script>
