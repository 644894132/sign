<?php
namespace app\admin\controller;
use think\Controller;
use Util\data\Sysdb;
use think\Db;
use think\Loader;

/**
* 会议管理
*/
class Meeting extends BaseAdmin{
	//创建会议
	public function index(){
      $permission = session("admin")['Roles2Binary'];
      $this->assign("permission", $permission);
	    //分页
       $data['pageSize'] =900;
       //接收分页数据
       $data['page'] =max(1,(int)input('get.page'));
       //搜索
       $data['seek'] =trim(input('get.seek'));
       //设置分页空数组
       $where =array();
       //如果$seek输入有值,就不能让where条件空着  linke在实际开发中最好别用,会增加数据的负载,应用搜索引擎
       $data['seek'] && $where ='id like "%'.$data['seek'].'%" or title like "%'.$data['seek'].'%" or attn like "%'.$data['seek'].'%" or unit like "%'.$data['seek'].'%"';
       //输出分页信息
       $data['data'] =$this->db->table('meeting')->where($where)->order('id asc')->pages($data['pageSize']);

       //查询数据库获取开始和结束时间
       $meeting_info =Db::name("meeting")->field('id,start,over')->select();
       //($meeting_info['start']);
      // var_dump($meeting_info['over']);
       //获取当前时间
       $curve_time =time();
       //遍历
       foreach ($meeting_info as $key => $value) {
   	   //获取开始和结束时间
   	   $start =$value['start'];
   	   //($start);
       $over =$value['over'];
       //var_dump($over);exit();
       //判断
       if($curve_time<$start){
       	//未开始
       	$res =Db::name("meeting")->where('id',$value['id'])->update(['condition'=>0]);          	
       }else if($curve_time >$over){
       	//已结束
       	$res =Db::name("meeting")->where('id',$value['id'])->update(['condition'=>2]);
       }else{
       	//进行中
       	$res =Db::name("meeting")->where('id',$value['id'])->update(['condition'=>1]);
       }
       }
		//加载数据库
		//$data['lists'] =Db::name("meeting")->->select();
    $data['lists'] = Db::name("users")->alias("a")->join("meeting b", "a.Name = b.attn", "left")->join("departments c", "a.ClassNum = c.Num", "left")->field("a.Name,b.*,c.Name as xname")->select();
    //dump($data['lists']);exit();
		$this->assign('data',$data);
		//$this->assign('id',$id);
		return view();
	}

	//添加/编辑/展示会议信息
	public function add(){
		$id =(int)input('get.id');
		$type = (int)input("get.type");
		$this->assign("type", $type);
		//加载数据库
		$data['item'] =$this->db->table('meeting')->where(array('id'=>$id))->item();
    $res =$this->db->table('departments')->field('Num, Name')->order('Num asc')->lists();
    $result =$this->db->table('users')->field('Account,Name,ClassNum')->lists();
    //dump($result);exit();
		$this->assign('data',$data);
    $this->assign('result',$result);
    $this->assign('res',$res);
		return view();
	}
  //院系联动
  public function loadUser(){
    $num = input("num");
    $where = ["ClassNum" => $num];
    //$user_list = Db::name("users")->field("Account, Name, ClassNum")->where($where)->select();

    $user_list = Db::name("users")->alias("a")->join("departments b", "a.ClassNum = b.Num", "left")->field("a.Account, a.Name as dname, a.ClassNum,b.Name")->order('a.ClassNum asc')->where($where)->select();
    //dump($where);
   // dump($user_list);
    return json_encode($user_list, JSON_UNESCAPED_UNICODE);
  }

	//保存会议
	public function save(){
		//接收数据
		$id =(int)input('post.id');
		//$data['meeting_number'] =mt_rand(0,99999);
		//var_dump($data['meeting_number']);exit();
		//$data['meeting_title'] =trim(input('post.meeting_title'));
		$data['title'] =trim(input('post.title'));		
		$data['attn'] =trim(input('post.attn'));
		$data['telephone'] =trim(input('post.telephone'));
		$data['unit'] =trim(input('post.unit'));
		$data['start'] =strtotime(input('post.start'));
		$data['duration'] =(int)(input('post.duration'));
		$data['over'] = $data['start'] + $data['duration'] * 60;

        //判断
		if(!$data['title']){
			die(json_encode(array('code'=>1,'msg'=>'请输入会议名称')));
		}
		if(!$data['start']){
			die(json_encode(array('code'=>1,'msg'=>'请选择会议开始时间')));
		}
		if(!$data['duration']){
			die(json_encode(array('code'=>1,'msg'=>'请输入会议时长')));
		}
		/*if(!$data['attn']){
			die(json_encode(array('code'=>1,'msg'=>'请输入联系人电话')));
		}*/
		if(!$data['unit']){
			die(json_encode(array('code'=>1,'msg'=>'请选择会议主办单位')));
		}
        $res =true;
        if($id==0){
          //创建会议时间
        	$data['found'] =time();
          //会议结束时间
          $data['month'] =date('Y-m',$data['start'] + $data['duration'] * 60);
          //当前年份
          $data['date'] =date('Y',$data['start'] + $data['duration'] * 60);
          //var_dump($data['month']);exit();
		    $res =$this->db->table('meeting')->insert($data);      	
		}else{
        $data['found'] =time();
        //会议结束时间
          $data['month'] =date('Y-m',$data['start'] + $data['duration'] * 60);
          //当前年份
          $data['date'] =date('Y',$data['start'] + $data['duration'] * 60);
		    $res =$this->db->table('meeting')->where(array('id'=>$id))->update($data);
		}   
		if(!$res){
			die(json_encode(array('code'=>1,'msg'=>'保存失败')));
		}
		    die(json_encode(array('code'=>0,'msg'=>'保存成功')));
	}
    //删除会议
	public function delete(){
		$id =(int)(input('post.id'));
    $res =$this->db->table('invite_teacher_info')->where(array('number'=>$id))->delete();
		$res =$this->db->table('meeting')->where(array('id'=>$id))->delete();
		//判断是否选择
		if($id==''){
			die(json_encode(array('code'=>1,'msg'=>'至少选择一个')));
		}
		//判断
		if(!$res){
			die(json_encode(array('code'=>1,'msg'=>'删除失败')));
		}
		    die(json_encode(array('code'=>0,'msg'=>'删除成功')));
	} 
	//邀请跳转主页
	public function homepage(){
		$MeetingID = input("get.MeetingID");
		$op = input("get.op");
		$this->assign("op", $op);
		$this->assign("MeetingID", $MeetingID);
		return view();
	}
	//老师标签
	public function teacher_label(){
		$MeetingID = input("MeetingID");
		$this->assign("MeetingID", $MeetingID);
		$data['lists'] =$this->db->table('label')->lists();
		$this->assign('data',$data);
		return view();
	}
	//保存邀请
	public function save_invite(){
    $labelid = input("post.labelid");
		$number =(int)input('post.id');
		$all =input('post.checkAll/a');	
		$res =true;
		if($all){
			//遍历,获取添加的个数
			$data = [];
			$temp = [];
			foreach($all as $value){
        $single = explode(",", $value);
				//会议ID
				$temp['number'] = $number;
				//标签ID
				$temp['labelid'] = $labelid;
				$temp['Account'] = $single[0];
        $temp['ClassNum'] = $single[1];
				$data[] = $temp;
			}			
			$res =Db::name('invite_teacher_info')->insertAll($data);


			//重新计算添加的人数
			$new_nums = Db::name("invite_teacher_info")->where("number", $number)->count("id");
			 //添加的人数
			$new_res = Db::name("meeting")->where(["id" => $number])->update(["meeting_count" => $new_nums]);
		}else{
			die(json_encode(array('code'=>1,'msg'=>'请至少选择一个')));
		}
		if($res){
       die(json_encode(array('code'=>0,'msg'=>'邀请成功')));
		 }	   
	}  
	   //标签指定老师列表
	public function label_assign(){
     $MeetingID = (int)input('get.MeetingID');
     $labelid = (int)input('get.labelid');
     //分页
     $data['pageSize'] =900;
     //接收分页数据
     $data['page'] =max(1,(int)input('get.page'));
     //搜索
     $data['seek'] =trim(input('get.seek'));
     //设置分页空数组
     $where =array();
     //如果$seek输入有值,就不能让where条件空着  linke在实际开发中最好别用,会增加数据的负载,应用搜索引擎
     $data['seek'] && $where ='b.Name like "%'.$data['seek'].'%" or b.Account like "%'.$data['seek'].'%"';
     //勾选
     $exists =Db::name("invite_teacher_info")->alias("a")->join("users b", "a.Account = b.Account", "left")->field("a.*, b.Name")->where($where)->where(['number' => $MeetingID])->select(); 

     //搜索结果
     $data['data'] =$this->db->table('label_assign_teacher a left join web_users b on a.account = b.account')->field('a.*,b.Name,b.Sex,b.ClassNum')->where($where)->where(['labelid' => $labelid])->pages($data['pageSize']);		
  
		 //加载数据库
		 $data['lists'] = Db::name("label_assign_teacher")->alias("a")->join("users b", "a.Account = b.Account", "left")->field("a.*, b.Name,b.Sex,b.ClassNum")->where($where)->where(['labelid' => $labelid])->select(); 
         
     //勾选已经添加
     foreach ($data['lists'] as $key => $value) {
      foreach ($exists as $k => $v) {
        $data['lists'][$key]['exists'] = 0;
        if ($value['Account'] == $v['Account']) {
          $data['lists'][$key]['exists'] = 1;
             break;
        }
      }
    }
    //搜索勾选
    foreach ($data['data']['lists'] as $key => $value) {
      foreach ($exists as $k => $v) {
        $data['data']['lists'][$key]['exists'] = 0;
        if ($value['Account'] == $v['Account']) {
          $data['data']['lists'][$key]['exists'] = 1;
          break;
        }
      }
    }
       //var_dump($data['data']);exit();
		  //加载数据库		
	    $this->assign("labelid", $labelid);
	    $this->assign("MeetingID", $MeetingID);
		  $this->assign('data',$data);
		  return view();
	}
	//邀请参会人员列表信息
	public function invite_teacher_info(){
    $permission = session("admin")['Roles2Binary'];
    $this->assign("permission", $permission);
    $MeetingID =input('get.MeetingID');
    $op = input('op');
    $this->assign("op", $op);
     //分页
    $data['pageSize'] =900;
    $data['page'] =max(1,(int)input('get.page'));
    //搜索
    $data['seek'] =trim(input('get.seek'));
    $where =array();
    $data['seek'] && $where ='b.Name like "%'.$data['seek'].'%" or b.Account like "%'.$data['seek'].'%"';

    //分页排序和显示页数
    $data['data'] =$this->db->table('invite_teacher_info a left join web_users b on a.account = b.account')->field('a.*,b.Name,b.Sex,b.ClassNum')->where($where)->where(array('number'=>$MeetingID))->pages($data['pageSize']);
    //dump($data['data']);
   
    //dump($data['data']);exit();
    //加载数据库
    $data['lists'] = Db::name("invite_teacher_info")->alias("a")->join("users b", "a.account = b.account", "left")->field("a.*, b.Name,b.Sex,b.ClassNum")->where($where)->where('number',$MeetingID)->select();
    //dump($data['lists']);
    //判断是否签到
    $this->assign('MeetingID',$MeetingID);
    $this->assign('data',$data);
                            
    return view();
	}
  //邀请名单
  public function invite_info(){
    $permission = session("admin")['Roles2Binary'];
    $this->assign("permission", $permission);
    $MeetingID =input('get.MeetingID');
    //加载数据库
    $data['lists'] = Db::name("invite_teacher_info")->alias("a")->join("users b", "a.Account = b.Account", "left")->field("a.*, b.Name,b.Sex")->where(array('number'=>$MeetingID))->select();
    //判断是否签到
    $this->assign('MeetingID',$MeetingID);
    $this->assign('data',$data);                     
    return view();
  }
	//下载邀请老师名单
	public function download(){
		$MeetingID =input('param.MeetingID');
		$list = Db::name("invite_teacher_info")->alias("a")->join("users b", "a.Account = b.Account", "left")->field("a.*, b.Name,b.Sex,b.PoliticalOutlook,b.FamilyName,b.NativePlace,b.DateOfBirth,b.Email,b.Aphone")->where(array('a.number'=>$MeetingID))->select();
		$list2 =Db::name('meeting')->where('id',$MeetingID)->field('title')->select();
		//var_dump($data);exit();
		$filename = "邀请参会老师名单信息".sprintf("%u", crc32(date("Y-m-d H:i:s"))).".xls";
        $file_path = ROOT_PATH."public".DS."temp".DS.$filename;
		    Loader::import('PHPExcel.PHPExcel');
        Loader::import('PHPExcel.PHPExcel.IOFactory.PHPExcel_IOFactory');

        $PHPExcel = new \PHPExcel();
        $PHPSheet = $PHPExcel->getActiveSheet();
        $PHPSheet->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $PHPSheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        // 设置单元格宽度
        $sheet = $PHPExcel -> getActiveSheet();
        $sheet -> getColumnDimension('A')->setWidth(15);        
        $sheet -> getColumnDimension('B')->setWidth(10);
        $sheet -> getColumnDimension('C')->setWidth(22);
        $sheet -> getColumnDimension('D')->setWidth(15);
        $sheet -> getColumnDimension('E')->setWidth(10);
        $sheet -> getColumnDimension('F')->setWidth(10);
        $sheet -> getColumnDimension('G')->setWidth(10);
        $sheet -> getColumnDimension('H')->setWidth(22);
        $sheet -> getColumnDimension('I')->setWidth(22);
        $sheet -> getColumnDimension('J')->setWidth(15);
        $sheet -> getColumnDimension('K')->setWidth(15);
        $sheet -> getColumnDimension('L')->setWidth(10);
        $sheet -> getColumnDimension('M')->setWidth(22);
         
         // 设置单元格字体
         // 设置单元格字体大小
         // 字体加粗 
        $sheet->getStyle( 'A1')->getFont()->setName('Candara' );    
        $sheet->getStyle( 'A1')->getFont()->setSize(15);            
        $sheet->getStyle( 'A1')->getFont()->setBold(true);          
        $sheet->getStyle( 'B1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'B1')->getFont()->setSize(15);
        $sheet->getStyle( 'B1')->getFont()->setBold(true);
        $sheet->getStyle( 'B1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'B1')->getFont()->setSize(15);
        $sheet->getStyle( 'B1')->getFont()->setBold(true);
        $sheet->getStyle( 'C1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'C1')->getFont()->setSize(15);
        $sheet->getStyle( 'C1')->getFont()->setBold(true);
        $sheet->getStyle( 'D1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'D1')->getFont()->setSize(15);
        $sheet->getStyle( 'D1')->getFont()->setBold(true);
        $sheet->getStyle( 'E1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'E1')->getFont()->setSize(15);
        $sheet->getStyle( 'E1')->getFont()->setBold(true);
        $sheet->getStyle( 'F1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'F1')->getFont()->setSize(15);
        $sheet->getStyle( 'F1')->getFont()->setBold(true);
        $sheet->getStyle( 'G1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'G1')->getFont()->setSize(15);
        $sheet->getStyle( 'G1')->getFont()->setBold(true);
        $sheet->getStyle( 'H1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'H1')->getFont()->setSize(15);
        $sheet->getStyle( 'H1')->getFont()->setBold(true);
        $sheet->getStyle( 'I1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'I1')->getFont()->setSize(15);
        $sheet->getStyle( 'I1')->getFont()->setBold(true);
        $sheet->getStyle( 'J1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'J1')->getFont()->setSize(15);
        $sheet->getStyle( 'J1')->getFont()->setBold(true);
        $sheet->getStyle( 'K1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'K1')->getFont()->setSize(15);
        $sheet->getStyle( 'K1')->getFont()->setBold(true);
        $sheet->getStyle( 'L1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'L1')->getFont()->setSize(15);
        $sheet->getStyle( 'L1')->getFont()->setBold(true);
        $sheet->getStyle( 'M1')->getFont()->setName('Candara' );
        $sheet->getStyle( 'M1')->getFont()->setSize(15);
        $sheet->getStyle( 'M1')->getFont()->setBold(true);


        $PHPSheet->setTitle("邀请参会老师名单");
        $PHPSheet->setCellValue("A1","个人编号");
        $PHPSheet->setCellValue("B1","会议编号");
        $PHPSheet->setCellValue("C1","标题");
        $PHPSheet->setCellValue("D1","姓名");
        $PHPSheet->setCellValue("E1","性别");
        $PHPSheet->setCellValue("F1","民族");
        $PHPSheet->setCellValue("G1","籍贯");
        $PHPSheet->setCellValue("H1","政治面貌");
        $PHPSheet->setCellValue("I1","出生日期");
        $PHPSheet->setCellValue("J1","Email");
        $PHPSheet->setCellValue("K1","电话");
        $PHPSheet->setCellValue("L1","状态");
        $PHPSheet->setCellValue("M1","请假/签到时间");

        $i = 2;
		foreach($list as $key => $value){
        	$PHPSheet->setCellValue('A'.$i,''.$value['Account']);
        	$PHPSheet->setCellValue('B'.$i,''.$value['number']);
        	$PHPSheet->setCellValue('C'.$i,''.$list2[0]['title']);
        	$PHPSheet->setCellValue('D'.$i,''.$value['Name']);       	
        	$PHPSheet->setCellValue('E'.$i,''.$value['Sex']==1?'男':'女');       	
        	$PHPSheet->setCellValue('F'.$i,''.$value['FamilyName']);
        	$PHPSheet->setCellValue('G'.$i,''.$value['NativePlace']);
        	$PHPSheet->setCellValue('H'.$i,''.$value['PoliticalOutlook']);
        	$PHPSheet->setCellValue('I'.$i,''.$value['DateOfBirth']);
        	$PHPSheet->setCellValue('J'.$i,''.$value['Email']);
        	$PHPSheet->setCellValue('K'.$i,''.$value['Aphone']);
        	if($value['sign_status']==0){
        		$status = '缺席';
        	} else if($value['sign_status']==1){
                $status = '签到';
        	}else if($value['sign_status']==2){
                $status = '请假';
        	}
        	$PHPSheet->setCellValue('L'.$i,''.$status);
        	if($value['sign_status']==1 || $value['sign_status']==2){
        		$PHPSheet->setCellValue('M'.$i,''.date('Y-m-d H:i',$value['sign_time']));
        	}       	
        	$i++;
    	}
    	$PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel,"Excel2007");
        $PHPWriter->save($file_path);
         
         //将服务器文件下载到本地
         header("Content-type:text/html;charset=utf-8");
            //$file_name = "filename.xls";     
            $file_name = iconv("utf-8","gb2312",$filename);
           // $file_sub_path = APP_PATH.'portal/data/templatefile/';    
            //确保文件在这个路径下面，换成你文件所在的路径
            //$file_path=$file_sub_path.$file_name;
            $file_path = ROOT_PATH."public".DS."temp".DS.$filename;
            if(!file_exists($file_path)){
                echo "下载文件不存在！";exit;         //如果提示这个错误，很可能你的路径不对，可以打印$file_sub_path查看
            }

            $fp=fopen($file_path,"r");

            $file_size=filesize($file_path);

            //下载文件需要用到的头
            Header("Content-type: application/octet-stream");
            Header("Accept-Ranges: bytes");
            Header("Accept-Length:".$file_size);
            Header("Content-Disposition: attachment; filename=".$file_name);
            $buffer=1024;
            $file_count=0;

            while(!feof($fp) && $file_count<$file_size){
                $file_con=fread($fp,$buffer);
                $file_count+=$buffer;
                echo $file_con;
            }
            fclose($fp);    //关闭这个打开的文件
            $info = [
            "code" => 1,
            "msg" => '下载成功!~',
            "filename" => $filename
        ];
        return json_encode($info, JSON_UNESCAPED_UNICODE);
     }    
	//删除邀请
	public function remove(){
		$Account =input('post.checkAll/a');
		$id =(int)input('post.id');
		// echo $id;
		// exit();
		$where = [
			"number" => $id,
			"Account" => ['in', $Account]
		];
		$res =Db::name('invite_teacher_info')->where($where)->delete();

		$res1 =Db::name('invite_teacher_info')->where('number', $id)->column("Account");
		$count = count($res1);
		 //exit(print_r($res1));
		$res2 =Db::name("meeting")->where("id", $id)->update(["meeting_count" => $count]);
		//var_dump($res1);exit();
		//$arr =implode(',',$res);
		// $new_arr =[];
		//比较两个数组的键值，并返回差集
		// $new_arr = array_diff($res1, $Account);
        //打散数组
		// $data = [
		// 	"name" => implode(",", $new_arr)
		// ];
		//var_dump($data);exit();
		//判断是否选择
		if($Account==''){
			die(json_encode(array('code'=>1,'msg'=>'至少选择一个')));
		}
		//判断
		if(!$res){
			die(json_encode(array('code'=>1,'msg'=>'删除失败')));
		}
		    die(json_encode(array('code'=>0,'msg'=>'删除成功')));
	} 
   //会议签到
	public function meeting_sign(){
		 //分页
     $data['pageSize'] =900;
     //接收分页数据
     $data['page'] =max(1,(int)input('get.page'));
     //搜索
     $data['seek'] =trim(input('get.seek'));
     //设置分页空数组
     $where =array();
     //如果$seek输入有值,就不能让where条件空着  linke在实际开发中最好别用,会增加数据的负载,应用搜索引擎
     $data['seek'] && $where ='id like "%'.$data['seek'].'%" or title like "%'.$data['seek'].'%" or attn like "%'.$data['seek'].'%" or unit like "%'.$data['seek'].'%"';
     //输出分页信息
     $data['data'] =$this->db->table('meeting')->where($where)->order('id asc')->pages($data['pageSize']);
     //$data['data'] =$this->db->table('meeting a left join web_invite_teacher_info b on a.id=b.number')->where($where)->field('a.*,b.Account')->order('id asc')->pages($data['pageSize']);	
	  //加载数据库
    $data['lists'] =$this->db->table('meeting')->lists();
		$this->assign('data',$data);
		return view();
	} 
	//老师列表
	public function person_sign_list(){
    $permission = session("admin")['Roles2Binary'];
    $this->assign("permission", $permission);
    $this->assign("account", session("admin")['Account']);
		$id =input('get.id');
		//加载数据库
		$data['lists'] = Db::name("invite_teacher_info")->alias("a")->join("users b", "a.Account = b.Account", "left")->field("a.*, b.Name,b.Sex")->where(array('a.number'=>$id))->select();
		//var_dump($data['lists']);exit();
		//$sql = Db::getLastSql();
		//exit($sql);
		//var_dump($data['lists']);exit();
		$this->assign('data',$data);
		return view();
	} 
	//保存签到信息
	public function save_sign(){	
		$meeting_id =input('post.meeting_id');
		$teacher_account =input('post.teacher_account');
		//$data =$this->db->table('sign');
        
        // $data = Db::name("invite_teacher_info")->alias("a")->join("sign b", "a.Account = b.Account", "left")->field("a.*,b.number as n,b.name as u,b.sex as s,b.sign_time,b.Account as A")->where(array('a.Account'=>$teacher_account,'a.number'=>$meeting_id))->select();
        //var_dump($data);exit();
        $arr =[
        	"sign_status" => 1,
        	"sign_time" => time(),
        ];
        //保存签到/时间
        $res = Db::name("invite_teacher_info")->where('number',$meeting_id)->where('Account', $teacher_account)->update($arr);
        return  date('Y-m-d H:i', $arr['sign_time']);
	}
	//保存请假信息
	public function save_leave(){	
		$id =input();
		$meeting_id =input('post.meeting_id');
		$teacher_account =input('post.teacher_account');
		//$data =$this->db->table('sign');
        
        // $data = Db::name("invite_teacher_info")->alias("a")->join("sign b", "a.Account = b.Account", "left")->field("a.*,b.number as n,b.name as u,b.sex as s,b.sign_time,b.Account as A")->where(array('a.Account'=>$teacher_account,'a.number'=>$meeting_id))->select();
        //var_dump($data);exit();
        $arr =[
        	"sign_status" => 2,
        	"sign_time" => time(),
        ];
        //保存签到/时间
        $res = Db::name("invite_teacher_info")->where('number',$meeting_id)->where('Account', $teacher_account)->update($arr);
        return  date('Y-m-d H:i', $arr['sign_time']);
	}
   //审核
  public function audit(){
    $permission = session("admin")['Roles2Binary'];
    $this->assign("permission", $permission);
    $data['lists'] =Db::name("invite_teacher_info")->alias("a")->join("users b", "a.Account = b.Account", "left")->field('a.*,b.Name')->order('number desc')->select(); 
    $this->assign('data',$data);
    //dump($data['lists']);exit();
    return view();
  }
  //同意
  public function consent(){
    $id=input('id');
    $account = session("admin")['Account'];
    $this->assign("account", session("admin")['Account']);
    $res =true;
    if($res){
      $res =Db::name('invite_teacher_info')->where('id',$id)->update(['audit_status'=>1,'approve'=>$account]);
    }
      die(json_encode(array('code'=>0,'msg'=>'审批成功')));
  }
  //不同意
  public function disagree(){
    $id=input('id');
    $account = session("admin")['Account'];
    $this->assign("account", session("admin")['Account']);
    $res =true;
    if($res){
      $res =Db::name('invite_teacher_info')->where('id',$id)->update(['audit_status'=>2,'sign_status'=>0]);
    }
      die(json_encode(array('code'=>0,'msg'=>'审批成功')));
  }
}	
