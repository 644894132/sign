<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"D:\phpstudy\PHPTutorial\WWW\sign\public/../application/admin\view\cartogram\conferee.html";i:1570960853;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\head.html";i:1570699778;s:72:"D:\phpstudy\PHPTutorial\WWW\sign\application\admin\view\common\foot.html";i:1570788077;}*/ ?>
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
  .active { background-color:green; }
</style>
<div class="header">
  <span>参会人次统计</span>
   <div></div>
</div><br>
  <div style="margin-left:20px;">
   <div class="layui-btn" id="month" onclick="month(this)">月度</div>
   <div class="layui-btn" id="year" onclick="year(this)">年度</div>
   <br><br><br>
  </div> 
 <div class="layui-col-md6">
    <div class="layui-card">
      <div class="layui-card-header"></div>
      <div class="layui-card-body">
        <div id="chart" style="width: 1600px;height:700px;"></div>
      </div>
    </div>
  </div>
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
                    $.post("<?php echo url('Users/change'); ?>", {Account:data.value, status:data.elem.checked ? 1 : 0}, function (res) {
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
       ,min:-720
       ,max:720
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
   $("#year").trigger("click");
      //月度参会人次
    function month(obj){
      $(obj).addClass("active");
      $("#year").removeClass("active");
      var myChart = echarts.init(document.getElementById('chart'));   
     // 指定图表的配置项和数据
      myChart.setOption({
         title: {
             text: '月度参会人次'
         },
         tooltip : {
              trigger: 'axis'
          },
         legend: {
             data:['参会人次']
         },
         toolbox: {
              show : true,
              feature : {
                  dataView : {show: true, readOnly: false},
                  magicType : {show: true, type: ['line', 'bar']},
                  restore : {show: true},
                  saveAsImage : {show: true}
              }
          },
          calculable : true,
         xAxis: {
          type : 'category',
             data: []
         },
         yAxis:  [
              {
                  type : 'value'
              }
          ],
         series: [
         ,{
             name: '参会人次',
             type: 'bar',
             data: [],
             markPoint : {
                      data : [
                          {type : 'max', name: '最大值'},
                          {type : 'min', name: '最小值'}
                      ]
                  },
         }
       ]
     });
       myChart.showLoading();    
      
        var xresult =[];
        var yresult =[];       
     $.ajax({
        type: 'post',
        async :true,
        url :"<?php echo url('Cartogram/month_conferee'); ?>",
        data :[],
        dataType :'json',
        success :function(data){
            //json数据转为数组
          var jsonarray = eval('('+data+')');
            console.log(jsonarray);
          if(jsonarray){
            for(var i=0;i<jsonarray.length;i++){
                xresult.push(jsonarray[i].month);
            }
            for(var i=0;i<jsonarray.length;i++){
                yresult.push(jsonarray[i].sum);
            }
            myChart.hideLoading();
            myChart.setOption({
                xAxis :{
                    name :'月份',
                    data:xresult
                },
                yAxis :{
                    name :'人次',
                    data:yresult
                },
               series:[{
                    data : yresult
                },
              ]  
            });
          }
        },
        error :function(errorMsg){
            alert('请求图标失败');
            myChart.hideLoading();
        }
     });
 }

   //年度参会人次
   function year(obj){
    $(obj).addClass("active");
    $("#month").removeClass("active");
     var myChart = echarts.init(document.getElementById('chart'));   
     // 指定图表的配置项和数据
      myChart.setOption({
         title: {
             text: '年度参会人次'
         },
         tooltip : {
              trigger: 'axis'
          },
         legend: {
             data:['参会人次']
         },
         toolbox: {
              show : true,
              feature : {
                  dataView : {show: true, readOnly: false},
                  magicType : {show: true, type: ['line', 'bar']},
                  restore : {show: true},
                  saveAsImage : {show: true}
              }
          },
          calculable : true,
         xAxis: {
          type : 'category',
             data: []
         },
         yAxis:  [
              {
                  type : 'value'
              }
          ],
         series: [
         {
             name: '参会人次',
             type: 'bar',
             data: [],
             markPoint : {
                      data : [
                          {type : 'max', name: '最大值'},
                          {type : 'min', name: '最小值'}
                      ]
                  },
         }
       ]
     });
       myChart.showLoading();
        var xData =[];
        var yData =[];       
     $.ajax({
        type: 'post',
        async :true,
        url :"<?php echo url('Cartogram/year_conferee'); ?>",
        data :[],
        dataType :'json',
        success :function(data){
            //json数据转为数组
          var jsonarray = eval('('+data+')');
            console.log(jsonarray);
          if(jsonarray){
            for(var i=0;i<jsonarray.length;i++){
                xData.push(jsonarray[i].date);
            }
            for(var i=0;i<jsonarray.length;i++){
                yData.push(jsonarray[i].ject);
            }
            myChart.hideLoading();
            myChart.setOption({
                xAxis :{
                    name :'年份',
                    data:xData
                },
                yAxis :{
                    name :'人次',
                    data:yData
                },
                series:[{
                    data : yData
                },
            ]
            });
          }
        },
        error :function(errorMsg){
            alert('请求图标失败');
            myChart.hideLoading();
        }
     });
 }
</script>