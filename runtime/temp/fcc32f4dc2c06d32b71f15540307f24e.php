<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:91:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\meeting\meeting_sign.html";i:1572849051;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1570699778;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1572849076;}*/ ?>
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
          

<div class="layui-form-item top">
<div class="header">
 <span>会议签到</span>
 <div></div>
</div> 
<br> 
<div class="layui-form-item">
<div class="layui-form layui-form-pane" style="float:left;">
<div class="layui-form-item">
<label class="layui-form-label" style="margin-left:30px;">快捷查询</label>
<div class="layui-input-inline">
 <input type="text" class="layui-input" value="<?php echo $data['seek']; ?>" id="seek" style="width:320px;" placeholder="请输入会议编号/标题/会议负责人/主办单位">
</div>
<button class="layui-btn" style="margin-left:150px;" onclick="searchs()"><i class="layui-icon">&#xe615;</i>搜索</button>
</div>  
</div>
</div>
</div>
</div><br><br><br><br><br><hr>
<table class="layui-table">
  <thead>
   <tr>
     <td>会议编号</td>
     <td>会议标题</td>
     <td>邀请人数</td>
     <td>会议开始时间</td>
     <td>会议结束时间</td>         
     <td>会议负责人</td>
     <td>负责人电话</td>
     <td>会议主办单位</td>
     <td>会议状态</td>
     <td>操作</td>
   </tr>
  </thead>
  <thead>
   <?php if(is_array($data['data']['lists']) || $data['data']['lists'] instanceof \think\Collection || $data['data']['lists'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['data']['lists'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
   <tr>
     <td><?php echo $vo['id']; ?></td>
     <td><a href="javascript:;" onclick="meeting_add(<?php echo $vo['id']; ?>, 3)"><?php echo $vo['title']; ?></a></td>
     <td><a href="<?php echo url('Meeting/invite_info'); ?>?MeetingID=<?php echo $vo['id']; ?>"><?php echo $vo['meeting_count']; ?></a></td>
     <td><?php echo date('Y-m-d H:i',$vo['start']); ?></td>
     <td><?php echo date('Y-m-d H:i',$vo['over']); ?></td> 
     <td><?php echo $vo['attn']; ?></td>
     <td><?php echo $vo['telephone']; ?></td>
     <td><?php echo $vo['unit']; ?></td> 
     <?php if($vo['condition'] == 0): ?>
     <td style="color:blue">未开始</td> 
     <?php elseif($vo['condition'] == 1): ?>
     <td style="color:green">进行中</td>
     <?php else: ?>
     <td style="color:red">已结束</td>
     <?php endif; ?>
     <td>
     <?php if($vo['condition'] == 2): ?>
      <button class="layui-btn" style="cursor:not-allowed;background-color:grey;">签到结束</button>
     <?php elseif($vo['condition'] == 0): ?>
     <button class="layui-btn layui-btn-disabled">签到</button>
     <?php else: ?>

      <button class="layui-btn" onclick="sign('<?php echo $vo['id']; ?>', '<?php echo $vo['condition']; ?>', this)">签到</button>
     <?php endif; ?>
      </td>    
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
      //引用layui主键
    layui.use(['layer','laypage'],function(){
      layer =layui.layer;
      //引用jquery
       $ =layui.jquery;
       laypage =layui.laypage;

       laypage.render({
          elem: 'pages' //注意，这里的 test1 是 ID，不用加 # 号
          ,count:<?php echo $data['data']['total']; ?>
          ,limit:<?php echo $data['pageSize']; ?>
          ,curr:<?php echo $data['page']; ?>
          ,jump: function(obj, first){               
                //首次不执行
                if(!first){
                  //实现搜索跳转和分页的统一
                  searchs(obj.curr);
                }
            }
        });
    });
       //搜索
       function searchs(curpage){
        //消除第一行空格
        var seek =$.trim($('#seek').val());
        //有wd就加载至分页后面
        var url ="<?php echo url('Meeting/meeting_sign'); ?>?page="+curpage;
        //var_dump(url);
        if(seek){
          //将搜索到的内容拼接至分页后面
          url+='&seek='+seek;
        }
        //页面跳转，搜索和分页跳转的统一
        window.location.href =url;
    }
   //签到
   function sign(id, condition, obj){
       setTimeout(function(){window.location.href="<?php echo url('Meeting/person_sign_list'); ?>?id="+id},500);
   }
</script>