<?php
namespace app\admin\controller;
use think\Controller;
use Util\data\Sysdb;
use think\Db;
/**
* 用户登录以及验证
*/
class Account extends Controller{
	 //后台登录首页
	public function index(){
		return $this->view();
	}
	 
	 //管理员登录验证方法
	public function dologin(){
       //接收前台提交的数据
       $Account =trim(input('post.Account'));
       //var_dump($Account);exit();
       $PassWord =input('post.PassWord');
       //var_dump($PassWord);exit();
       $verifcode =trim(input('post.verifcode'));
       $background_img =trim(input('post.background_img'));

       //判断用户名\密码\验证码
       if($Account ==''){
       	    //json_encode 将数组解析未字符串
       	    exit(json_encode(array('code'=>1,'msg'=>'用户名不能为空!')));
       }
       if($PassWord ==''){
       	    exit(json_encode(array('code'=>1,'msg'=>'密码不能为空!')));
       }
       if($verifcode ==''){
       	    exit(json_encode(array('code'=>1,'msg'=>'请输入验证码!')));
       }
       //判断验证码输入是否正确
       if(!captcha_check($verifcode)){
       	    exit(json_encode(array('code'=>1,'msg'=>'验证码错误')));
       }
        
        //验证用户
       //实例化对象
       $this->db =new Sysdb;
       //查询数据库
       // $admin =$this->db->table('users')->where(array('Account'=>$Account))->item();
       $admin = Db::name("users")->alias("a")->join("role b", "a.Roles2Binary = b.id", "left")->where("a.Account", $Account)->find();
       //判断用户名是否存在
       if(!$admin){
           exit(json_encode(array('code'=>1,'msg'=>'用户名不存在')));
       }

       //判断密码是否正确
        if(md5($PassWord) != $admin['PassWord']){
         	    exit(json_encode(array('code'=>1,'msg'=>'密码错误')));
         }
       //判断用户名是否被禁用
       if($admin['Status'] ==0){
       	    exit(json_encode(array('code'=>1,'msg'=>'用户名被禁用')));
       }
       //如果都正确,设置用户session
        session('admin',$admin);
          $LoginTime=time();
          $res =Db::name('users')->where('Account',$Account)->update(['LoginTime'=>$LoginTime]);
          exit(json_encode(array('code'=>0,'msg'=>'登录成功')));
    } 
    //退出,不经过权限
    public function quit(){
      $Account = session("admin")['Account'];
      $LoginoutTime=time();     
      $res =Db::name('users')->where('Account',$Account)->update(['LoginoutTime'=>$LoginoutTime]);
      session('admin',null);
      exit(json_encode(array('code'=>0,'msg'=>'退出成功')));
    }
}   