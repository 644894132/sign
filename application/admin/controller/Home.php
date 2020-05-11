<?php
namespace app\admin\controller;
use think\Controller;
use Util\data\Sysdb;
use think\Db;
/**
* 后台登录首页
*/
class Home extends BaseAdmin{	
	//欢迎首页
	public function index(){
        $account = session("admin")['Account'];
        $this->assign("account", session("admin")['Account']);
		/*$id =trim(input('post.id'));
        //var_dump($MeetingID);exit();
		$data['lists'] =$this->db->table('users')->lists();
		$this->assign('data',$data);
		return $this->fetch();*/
        $menus =false;
            $role =$this->db->table('role')->where(array('id'=>$this->_admin['id']))->item();
            //var_dump($role);exit();
            //菜单
           if($role){
                //将'rights' 解析为数组
                $role['rights'] =(isset($role['rights']) && $role['rights']) ? json_decode($role['rights'],true) :[];
            }
            if($role['rights']){
                //拼接字符串
                $where ='mid in('.implode(',',$role['rights']).') and status=0';
                $menus =$this->db->table('menus')->where($where)->order('mid asc')->cates('mid');
                $menus && $menus =$this->gettreeitems($menus);
            }
            $data =$this->db->table('site')->field('names')->item();

            $this->assign('data',$data);
            //echo '<pre>';
            //var_dump($menus);exit();
            $this->assign('role',$role);
            $this->assign('menus',$menus);
            //返回结果集
            return view();
	}
         //菜单层级
          private function gettreeitems($items){
           $tree =array();
           foreach ($items as $item) {
            //PHP指针
            if(isset($items[$item['pid']])){
                $items[$item['pid']]['children'][] =&$items[$item['mid']];
            }else{
                $tree[] =&$items[$item['mid']];
            }
          }
          return $tree;
       }
	public function welcome(){
		//加载
		$account = session("admin")['Account'];
		$data['lists']=$this->db->table('users')->where(['Account'=>$account])->lists();
		$this->assign('data',$data);
		return view();
	}
	//用户信息
	public function userinfo(){
		//加载
		$account = session("admin")['Account'];
		$data['lists']=$this->db->table('users')->where(['Account'=>$account])->lists();
		$this->assign('data',$data);
		return view();
	}
	//修改密码
	public function update_pwd(){
		return view();
	}
    //保存修改
    public function save_update(){
    	//当前账户
    	$account = session("admin")['Account'];

    	$data['former_pwd'] =input('post.former_pwd');   	
    	$data['new_pwd'] =input('post.new_pwd');
    	$data['verify_new_pwd'] =input('post.verify_new_pwd');
    	
    	//判断
    	if($data['former_pwd']==''){
    		die(json_encode(array('code'=>1,'msg'=>'请输入原始密码')));
    	}
    	if($data['new_pwd']==''){
    		die(json_encode(array('code'=>1,'msg'=>'请输入新密码')));
    	}
    	if($data['verify_new_pwd']==''){
    		die(json_encode(array('code'=>1,'msg'=>'请确认新密码')));
    	}
    	if($data['new_pwd']!=$data['verify_new_pwd']){
        	die(json_encode(array('code'=>1,'msg'=>'两次密码输入不一致')));
        }
        //验证
        if(!$data['former_pwd']){
        	die(json_encode(array('code'=>1,'msg'=>'请输入正确的原始密码')));
        }
        //如果都正确,设置用户session     
        $res =$this->db->table('users')->where(array('Account'=>$account))->update(['PassWord'=>md5($data['new_pwd'])]);
        //var_dump($res);exit();
        exit(json_encode(array('code'=>0,'msg'=>'修改成功')));	
      
    }
}