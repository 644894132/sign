<?php
namespace app\admin\controller;
use think\Controller;
use Util\data\Sysdb;
use think\Db;
use think\Loader;
/**
* 邀请参会人数
*/
class Gather extends BaseAdmin{	
	//主界面
    public function main_interface(){
		return view();
	}	
	//参会人数统计
	public function conferee_statistics(){   
		//加载数据库
		$data['lists'] =$this->db->table('meeting')->field('id,title,meeting_count')->lists(); 
		$meeting_id_list = Db::name("meeting")->field("id, title")->select();
		$status_list =Db::name("invite_teacher_info")->field('id, number, sign_status')->select();
		$nums_arr = [];
		foreach($meeting_id_list as $key => $value){
			$sign_nums = 0;
			$leave_nums = 0;
			$late_nums =0;
			$absent_nums =0;
			$temp['number'] = $value['id'];
			foreach ($status_list as $k => $v){
				if ($value['id'] == $v['number']){
					if($v['sign_status'] == 1){
						$sign_nums++;
					}elseif($v['sign_status'] == 2){
						$leave_nums++;
					}/*elseif($v['sign_status'] == 3){
						$late_nums++;
					}*/elseif($v['sign_status'] == 0) {
						$absent_nums++;
					}
				}
			}
			$temp['sign_nums'] = $sign_nums;
			$temp['leave_nums'] = $leave_nums;
			//$temp['late_nums'] = $late_nums;
			$temp['absent_nums'] = $absent_nums;
			$nums_arr[] = $temp;
		}
		foreach ($data['lists'] as $key => $value) {
			foreach ($nums_arr as $k => $v) {
				if ($value['id'] === $v['number']) {
					$data['lists'][$key]['sign_nums'] = $v['sign_nums'];
					$data['lists'][$key]['leave_nums'] = $v['leave_nums'];
					//$data['lists'][$key]['late_nums'] = $v['late_nums'];
					$data['lists'][$key]['absent_nums'] = $v['absent_nums'];
				}
			}
		}
			$this->assign('data',$data);
			return view();
		}

        //签到人员名单
	public function sign_info(){
		$id =input('get.meeting_id');
		//var_dump($id);exit();
		$data['lists'] = Db::name("invite_teacher_info")->alias("a")->join("users b", "a.Account = b.Account", "left")->field("a.*, b.Name,b.Sex")->where('number',$id)->where(['sign_status'=>1])->select();
		//var_dump($data['lists']);exit();				
		$this->assign('data',$data);
	  	return view();
	  }
	  //请假人员名单
	public function leave_info(){
		$id =input('get.meeting_id');
		$data['lists'] = Db::name("invite_teacher_info")->alias("a")->join("users b", "a.Account = b.Account", "left")->field("a.*, b.Name,b.Sex")->where('number',$id)->where(['sign_status'=>2])->select();
		$this->assign('data',$data);
	  	return view();
	  }	 
	  //缺席人员名单
	public function absent_info(){
       $id =input('get.meeting_id');
		$data['lists'] = Db::name("invite_teacher_info")->alias("a")->join("users b", "a.Account = b.Account", "left")->field("a.*, b.Name,b.Sex")->where('number',$id)->where(['sign_status'=>0])->select();
		//var_dump($data['lists']);exit();
		$this->assign('data',$data);
	  	return view();
	}
	  //删除
    public function delete(){
		$id =(input('post.id'));
		$res =Db::name('meeting_parson_data')->where(array('id'=>$id))->delete();
		//判断
		$res =true;
		if(!$res){
			die(json_encode(array('code'=>1,'msg'=>'删除失败')));
		}
		    die(json_encode(array('code'=>0,'msg'=>'删除成功')));
	} 
	//参会人员统计图
	public function conferee(){
        return view();
	}
	//年度参会人员统计图
	public function year_conferee(){
		$data =Db::name('meeting')->field('date,sum(meeting_count) as ject')->group('date')->select();
           return json_encode($data ,JSON_UNESCAPED_UNICODE);
	}
	//月度参会人员统计图
	public function month_conferee(){
		$data =Db::name('meeting')->field('month,sum(meeting_count) as sum')->group('month')->select();
           return json_encode($data ,JSON_UNESCAPED_UNICODE);
	}
	//会议次数统计图
	public function meeting_statistics(){
        return view();
	}
	//年度会议次数统计图
	public function year_meeting(){
		$data =Db::name('meeting')->field('date,count(*) as sum')->group('date')->order('date asc')->select();		
        return json_encode($data ,JSON_UNESCAPED_UNICODE);
	}
	//月度会议次数统计图
	public function month_meeting(){
		$data =Db::name('meeting')->field('month,count(*) as sum')->group('month')->order('month asc')->select();
           return json_encode($data ,JSON_UNESCAPED_UNICODE);
	}
	//学院统计统计图
	public function classify(){	
       /*$data =Db::name("invite_teacher_info")->alias("a")->join("departments b", "a.ClassNum = b.Num", "left")->join("meeting c","c.id=a.number")->field("b.Name,c.date")->field('date,Name,count(*) as sum')->group('Name')->order('Name asc')->select();
	   return json_encode($data ,JSON_UNESCAPED_UNICODE);*/
	   return view();
	}

/*	//学院统计图
	public function college(){
	   $data =Db::name("invite_teacher_info")->alias("a")->join("departments b", "a.ClassNum = b.Num", "left")->field("b.Name")->field('Name,count(*) as sum')->group('Name')->order('Name asc')->select(); 
		 return json_encode($data ,JSON_UNESCAPED_UNICODE);
	}*/
	//2018年
	public function year(){
	   $toyear =input('toyear');
	   $data =Db::name("invite_teacher_info")->alias("a")->join("departments b", "a.ClassNum = b.Num", "left")->join("meeting c","c.id=a.number")->field("b.Name,c.date")->field('date,Name,count(*) as sum')->where('c.date',$toyear)->group('Name')->order('Name asc')->select();
	   //dump($data);exit();
	   return json_encode($data ,JSON_UNESCAPED_UNICODE);
	}	
}