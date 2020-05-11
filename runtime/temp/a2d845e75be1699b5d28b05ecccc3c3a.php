<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:80:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\users\add.html";i:1568883923;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1568183374;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1569037091;}*/ ?>
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
          

<form class="layui-form" action="<?php echo url('Users/save_add'); ?>" method="post">
    <div class="layui-layout layui-layout-admin">  
     <div><br>   
       <table>
          <thead>
             <tr>          
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">账号</label>
                <div class="layui-input-inline">
                 <input type="text" id="Account" name="Account" class="layui-input" placeholder="请输入个人账号">        
                </div> 
                </div>
               </td> 
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">密码</label>
                <div class="layui-input-inline">
                 <input type="text" id="PassWord" name="PassWord" class="layui-input" placeholder="请输入密码" >        
                </div> 
                </div>
               </td>          
             </tr>
          </thead>
          <thead>
             <tr>          
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">部门</label>
                <div class="layui-input-inline">
                 <input type="text" id="ClassNum" name="ClassNum" class="layui-input" placeholder="请输入部门">        
                </div> 
                </div>
               </td> 
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">姓名</label>
                <div class="layui-input-inline">               
                 <input type="text" id="Name" name="Name" class="layui-input" placeholder="请输入姓名">
                </div> 
                </div>
               </td>           
             </tr>
          </thead>
           <thead>
             <tr>                      
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">性别</label>
                <div class="layui-input-inline">               
                 <input type="text" id="Sex" name="Sex" class="layui-input" placeholder="请选择性别">
                </div> 
                </div>
               </td> 
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">民族</label>
                <div class="layui-input-inline">               
                 <input type="text" id="FamilyName" name="FamilyName" class="layui-input" placeholder="请输入民族">
                </div> 
                </div>
               </td>            
             </tr>
          </thead>
           <thead>
             <tr>                      
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">籍贯</label>
                <div class="layui-input-inline">               
                 <input type="text" id="NativePlace" name="NativePlace" class="layui-input" placeholder="请输入籍贯">
                </div> 
                </div>
               </td>
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">出生日期</label>
                <div class="layui-input-inline">               
                 <input type="text" id="DateOfBirth" name="DateOfBirth" class="layui-input" placeholder="请输入出生日期">
                </div> 
                </div>
               </td>                 
             </tr>
          </thead>
           <thead>
             <tr>                      
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">政治面貌</label>
                <div class="layui-input-inline">               
                 <input type="text" id="PoliticalOutlook" name="PoliticalOutlook" class="layui-input" placeholder="请输入政治面貌" >
                </div> 
                </div>
               </td> 
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">               
                 <input type="text" id="Email" name="Email" class="layui-input" placeholder="请输入邮箱">
                </div> 
                </div>
               </td>              
             </tr>
          </thead>
          <thead>
             <tr>                     
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">电话</label>
                <div class="layui-input-inline">
                 <input type="text" id="Aphone" name="Aphone" maxlength="11"  class="layui-input" placeholder="请输入电话">
                </div> 
                </div>
               </td>
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">照片</label>
                <div class="layui-input-inline"> 
                  <button class="layui-btn layui-btn-sm"  id="upload_img" onclick="return false;"><i class="layui-icon">&#xe67c;</i>上传</button>  
                  <img id="preview_img" src="" name="Pic" style="height:30px;"> 
                  <input type="hidden" name="Pic">         
                </div>
               </td>         
             </tr>
          </thead>
          <thead>
             <tr>                      
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">身份证</label>
                <div class="layui-input-inline">
                 <input type="text" id="ID2" name="ID2" maxlength="18" class="layui-input" placeholder="请输入身份证">
                </div> 
                </div>
               </td>
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">用户类型</label>
                <div class="layui-input-inline">               
                 <input type="text" id="Type" name="Type"  class="layui-input" placeholder="请选择用户类型">
                </div> 
                </div>
               </td>          
             </tr>
          </thead>       
          <thead>
             <tr>                       
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">角色</label>
                   <div class="layui-input-inline">
                     <select name="id">          
                         <option value=0></option>
                         <?php if(is_array($data['groups']) || $data['groups'] instanceof \think\Collection || $data['groups'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['groups'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                         <option value="<?php echo $vo['id']; ?>" <?php echo $vo['id']==$data['item']['role_id']?'selected': ''; ?>><?php echo $vo['name']; ?></option>
                         <?php endforeach; endif; else: echo "" ;endif; ?> 
                     </select>
                   </div>
                 </div> 
               </td> 
               <td>
                <div class="layui-form-item">
                 <label class="layui-form-label">状态</label>
                <div class="layui-input-inline">
                  <input type="checkbox" id="Status" name="Status" lay-skin="primary" title="禁用" value="1" <?php echo !empty($data['Status'])?'checked' : ''; ?>>
                </div> 
                </div>
               </td>          
             </tr>
          </thead> 
          <thead>
           <tr>                      
             <td>
              <div class="layui-form-item">
               <label class="layui-form-label">简介</label>
              <div class="layui-input-inline">  
              <textarea type="text" id="Acontent" name="Acontent" placeholder="请输入简介"></textarea>             
              </div> 
              </div>
             </td>            
           </tr>
        </thead>            
       </table> 
         <button type="submit" class="layui-btn layui-btn-radius layui-btn-normal" style="margin-left:120px" >保存</button>
    </div> 
  </div> 
</form>               
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
          $.post('/admin.php/admin/Gather/download',{'checkAll':arr},function(res){
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
      
</script>
