<?php
namespace app\admin\controller;
use think\Controller;
use Util\data\Sysdb;
use think\Db;
/**
* 防止用户非法登录
*/
class BaseAdmin extends Controller{
	        //定义构造函数
	   public function __construct(){
	   	    //访问
            parent::__construct();
            //将session赋值给 $thin->_admin,
            $this->_admin =session('admin');
            //判断是否是 admin登录
            if(!$this->_admin){
            	//未登录直接跳转到登录页
              header('Location:/admin.php/admin/Account/index');
              exit;
            }
            //判断用户是否有权限,实例化对象
            $this->db =new Sysdb;
	   }	
}