<?php
namespace app\admin\controller;
use think\Controller;
use Util\data\Sysdb;
use think\Db;
use think\phpcode;
use Endroid\QrCode\QrCode;
/**
* 个人中心
*/
class Personal extends BaseAdmin{
	//首页
	public function index(){
     $permission = session("admin")['Roles2Binary'];
     $this->assign("permission", $permission);
     $account = session("admin")['Account'];
     $this->assign("account", session("admin")['Account']);   

     $data['lists'] =$this->db->table('meeting a left join web_invite_teacher_info b on a.id = b.number')->field('a.*,b.leave_cause,b.sign_time,b.Account,b.sign_status,b.audit_status,b.audit')->where(['Account'=>$account])->order('b.sign_status asc')->lists();
    //dump($data['lists']);exit();
    //加载数据库
    $res =$this->db->table('departments')->field('Name')->order('Num asc')->lists();

    $this->assign('res',$res);
    $this->assign('data',$data);  
		return view();
	}
  //签到/请假界面
  public function sign_page(){
    $permission = session("admin")['Roles2Binary'];
    $this->assign("permission", $permission);
    $account = session("admin")['Account'];
    $this->assign("account", session("admin")['Account']);

    $id =(int)input('get.id');
    //dump($id);exit();
    //加载数据库
    $result = Db::name("meeting")->alias("a")->join("invite_teacher_info b", "a.id = b.number", "left")->field('a.*,b.Account,b.number,b.sign_status,b.leave_cause,b.sign_time,b.audit_status,b.audit,b.approve')->where(array('number'=>$id))->where(array('b.Account'=>$account))->find();
    //dump($result);exit();
    $res =$this->db->table('departments')->field('Num,Name')->order('Num asc')->lists();
    $parson = Db::name("users")->where(['Roles2Binary'=>['in', [1,2]]])->field('name,Roles2Binary')->select();
    $onlody = Db::name("invite_teacher_info")->alias("a")->join("users b", "a.approve = b.account", "left")->field("a.approve, b.Name")->where('number',$id)->select();
    //dump($onlody);exit();
    $this->assign('onlody',$onlody);
    $this->assign('result',$result);
    $this->assign('res',$res);    
    $this->assign('parson',$parson);
    return view();
  }

  //保存签到信息
  public function save_sign(){
    $permission = session("admin")['Roles2Binary'];
    $this->assign("permission", $permission);  
    $meeting_id =input('post.meeting_id');
    $teacher_account =input('post.teacher_account');
        $arr =[
          "sign_status" => 1,
          "sign_time" => time()
        ];        
        $result =$this->db->table('meeting')->where(array('id'=>$meeting_id))->field('start')->item(); 
        //dump($arr['sign_time']);
        //dump($result);exit();      
        if($arr['sign_time'] >= ($result['start'] + 30 * 60)){
          exit(json_encode(array('code'=>1,'msg'=>'已经过了签到时间')));
        }else{
          //保存签到/时间
          $res = Db::name("invite_teacher_info")->where('number',$meeting_id)->where('Account', $teacher_account)->update($arr);
          return  date('Y-m-d H:i', $arr['sign_time']);
        }      
  }
  //保存请假信息
  public function save_leave(){ 
    $meeting_id =input('post.meeting_id');
    $teacher_account =input('post.teacher_account');
    $audit_status =input('audit_status');
    $audit =input('audit');
    $leave_cause =input('leave_cause');
    $arr =[
      "sign_status" => 2,
      "sign_time" => time(),
      "leave_cause" => $leave_cause,
      "audit" =>$audit
    ];
    //dump($arr);exit();
    if($leave_cause=='') {
      exit(json_encode(array('code'=>1,'msg'=>'请填写请假原因!')));
    }else{
      //保存请假/时间
        $res = Db::name("invite_teacher_info")->where('number',$meeting_id)->where('Account', $teacher_account)->update($arr);
       // dump($res);exit();
        return  date('Y-m-d H:i', $arr['sign_time']);
    } 
  }
}   