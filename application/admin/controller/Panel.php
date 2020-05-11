<?php
namespace app\admin\controller;
use think\Controller;
use Util\data\Sysdb;
use think\Db;

/**
* 系统设置
*/
class Panel extends BaseAdmin{	
    //主界面
    public function main_interface(){
      $id =(int)input('get.id');
      // echo "id is : ".$id;
      $data['lists'] =$this->db->table('label')->lists();
      $this->assign('data',$data);
      $this->assign('labelid',$id);
      return view();
    }
    //标签管理
    public function index(){
       //分页
         $data['pageSize'] =900;
         //接收分页数据
         $data['page'] =max(1,(int)input('get.page'));
         //搜索
         $data['seek'] =trim(input('get.seek'));
         //设置分页空数组
         $where =array();
         //如果$seek输入有值,就不能让where条件空着  linke在实际开发中最好别用,会增加数据的负载,应用搜索引擎
         $data['seek'] && $where ='id like "%'.$data['seek'].'%" or labels like "%'.$data['seek'].'%" or count like "%'.$data['seek'].'%"';
         $data['data'] = $this->db->table("label")->where($where)->order('id asc')->pages($data['pageSize']);
       $data['lists'] =$this->db->table('label')->order('id asc')->lists();     
       $this->assign('data',$data);
       return view();   
    }
        //添加标签
    public function label_add(){
      $id =(int)input('get.id');
      $type = (int)input("get.type");
        $this->assign("type", $type);
      $data['item'] =$this->db->table('label')->where(array('id'=>$id))->item();
      //$res =$this->db->table('role')->field('Role')->order('id desc')->lists();
       $res =$this->db->table('role')->field('title')->order('id asc')->lists();
      $this->assign('res',$res);
          $this->assign('data',$data);
          return view();
    }
    //保存标签
    public function save_label(){
      $data['id'] =(int)input('post.id');
      $data['labels'] =trim(input('post.labels'));
      $data['Role'] =trim(input('post.Role'));
      $data['count'] =trim(input('post.count'));

      //判断
      if(!$data['labels']){
        exit(json_encode(array('code'=>1,'msg'=>'请输入标签名称')));
      }
      if(!$data['Role']){
        exit(json_encode(array('code'=>1,'msg'=>'请选择所属角色')));
      }
      //保存数据
      $res =true;   
      if($data['id']==0){
          //查询数据库,编号是否被占用
        $item =$this->db->table('Label')->where(array('labels'=>$data['labels']))->item();
        //判断
        if($item){
          exit(json_encode(array('code'=>1,'msg'=>'标签已存在')));
      } 
        $res =Db::name('label')->insert($data);                  
      }else{          
        $res =Db::name('label')->where('id',$data['id'])->update($data);
      } 
      if(!$res){
        exit(json_encode(array('code'=>1,'msg'=>'保存失败')));
      }
          exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
      }
      //删除标签
    public function delete_label(){
      $id =(input('post.id'));
      $res =Db::name('label')->where('id',$id)->delete();
      //$res =Db::name('invite_teacher_info')->delete();
      //$res = Db::name("label")->alias("a")->join("invite_teacher_info b", "a.id = b.labelid", 'left')->field('a.*,b.Account,b.ClassNum,b.number')->where('labelid',$id)->select();
      //dump($res);exit();
      //判断是否选择
      //判断
      if(!$res){
        die(json_encode(array('code'=>1,'msg'=>'删除失败')));
      }
          die(json_encode(array('code'=>0,'msg'=>'删除成功')));
    }   
    //指定标签后,所有老师列表
    public function label_maintain(){
      $labelid = input('get.labelid');
      //var_dump($labelid);exit();
            //获取teacherlist的数据
      $res = Db::name("label_assign_teacher")->where("labelid", $labelid)->field('Account')->select();
      //加载数据库
      $data['result'] =$this->db->table('users')->field('Account,ClassNum')->lists();
      //var_dump($data['result']);exit();
      $existsUser = array();
      foreach ($res as $key => $value) {
        $existsUser[] =$value['Account'];
      }
      $allUserID = array();
      $otherUser = array();
      foreach ($data['result'] as $key => $value) {
        $allUserID[] = $value['Account'];
        $allUserID[] = $value['ClassNum'];
      }
               
           //比较两个数组的键值，过滤掉已经指定的老师
         $otherUser = array_diff($allUserID, $existsUser);           
            //分页
         $data['pageSize'] =900;
         //接收分页数据
         $data['page'] =max(1,(int)input('get.page'));
         //搜索
         $data['seek'] =trim(input('get.seek'));
         //设置分页空数组
         $where =array();
         //如果$seek输入有值,就不能让where条件空着 
         $data['seek'] && $where ='Account like "%'.$data['seek'].'%" or Name like "%'.$data['seek'].'%"';

         $data['data'] = $this->db->table("users")->where($where)->where(["Account" => ['in', $otherUser]])->pages($data['pageSize']);
          //查询指定之后的数据
       $data['lists'] = Db::name("users")->where("Account",'in', $otherUser)->where('Name like "%'.$data['seek'].'%" or Account like "%'.$data['seek'].'%"')->select();
       //var_dump($data['lists']);exit();
           //分配数据(指定之后)     
      $this->assign("labelid", $labelid); 
      $this->assign('data',$data);    
      return view();
      }
    //添加标签指定老师
    public function confirm(){
      $Account =input('post.checkAll/a');
      $res =true;
      $labelid =(int)input('post.id');
      $nums = Db::name("label_assign_teacher")->where("labelid", $labelid)->count();
      if($Account){
        $data = [];
        $temp = [];
        foreach ($Account as $key => $value) {
          $temp['Account'] = $value;
          $temp['labelid'] = $labelid;
          $data[] = $temp;
        }
        $res = Db::name("label_assign_teacher")->insertAll($data);
        //var_dump($res);exit();
        $new_nums = $nums + count($Account);
        $res111 = Db::name("label")->where("id", $labelid)->update(["count" => $new_nums]);
      }else{
        die(json_encode(array('code'=>1,'msg'=>'至少选择一个')));
      }
      if(!$res){
        die(json_encode(array('code'=>1,'msg'=>'添加失败')));
      }
          die(json_encode(array('code'=>0,'msg'=>'添加成功')));
       }        
    //标签指定老师列表
    public function assign_personnel(){
       $labelid = input('labelid');
        //加载数据库
       $data['lists'] = Db::name("label_assign_teacher")->alias("a")->join("users b", "a.account = b.account", 'left')->field('a.*,b.Sex,b.Name,b.ClassNum')->where('labelid', $labelid)->select();
        //分页
         $data['pageSize'] =900;
         //接收分页数据
         $data['page'] =max(1,(int)input('get.page'));
         //搜索
         $data['seek'] =trim(input('get.seek'));
         //设置分页空数组
         $where = ["labelid" => $labelid];
         //如果$seek输入有值,就不能让where条件空着 
         $data['seek'] && $where ='labelid = '.$labelid.' and (a.Account like "%'.$data['seek'].'%" or b.Name like "%'.$data['seek'].'%")';

         $data['data'] =$this->db->table('label_assign_teacher a left join web_users b on a.account = b.account')->field('a.*,b.Name,b.Sex,b.ClassNum')->where($where)->pages($data['pageSize']);
         dump(Db::getLastSql());
           // dump($data);
       $this->assign("labelid", $labelid);
       $this->assign('data',$data);
       return view();
    } 
    //删除标签指定老师
    public function remove(){
      $id =(int)input('post.id');
      // var_dump($id);exit();
      $Account = input("post.checkAll/a");
      // var_dump($Account);exit();
      $where = [
        "labelid" => $id,
        "Account" => ['in' => $Account]
      ];
      // echo "<pre>";
      // print_r($where);
      // echo "</pre>";
      // exit();
      // print_r($where); exit();
      $res = Db::name("label_assign_teacher")->where('labelid', $id)->where('Account', 'in', $Account)->delete();
      // print Db::getLastSql();
      // var_dump($res);exit();
      
      //判断是否选择
      if(empty($Account)){
        die(json_encode(array('code'=>1,'msg'=>'至少选择一个')));
      }
      //判断
      if(!$res){
        die(json_encode(array('code'=>1,'msg'=>'删除失败')));
      }
      $new_nums = Db::name("label_assign_teacher")->where("labelid", $id)->count();

      $res1 = Db::name("label")->where("id", $id)->update(['count' => $new_nums]);
         die(json_encode(array('code'=>0,'msg'=>'删除成功')) );
    } 
    //网站名称设置
    public function site(){       
        $data['item'] =$this ->db->table('site')->item();
        $this->assign('data',$data);
        return view();
    }
    //保存网站名称
    public function save_site(){
      $data['id'] =input('names');
      $data['names'] =input('names');
      $data['copy'] =input('copy');
      $data['abbreviation'] =input('abbreviation');
      $data['describe'] =input('describe');
      $data['keyword'] =input('keyword');
      $data['contact_way'] =input('contact_way');
      $data['support'] =input('support');

       //判断
      if(!$data['names']){
        die(json_encode(array('code'=>1,'msg'=>'请输入网站名称')));
      }
      if(!$data['copy']){
        die(json_encode(array('code'=>1,'msg'=>'请输入版权所有')));
      }
      if(!$data['abbreviation']){
        die(json_encode(array('code'=>1,'msg'=>'请输入系统简称')));
      }
      if(!$data['describe']){
        die(json_encode(array('code'=>1,'msg'=>'请输入系统描述')));
      }
      if(!$data['keyword']){
        die(json_encode(array('code'=>1,'msg'=>'请输入系统关键字')));
      }
      if(!$data['contact_way']){
        die(json_encode(array('code'=>1,'msg'=>'请输入联系方式')));
      }
      if(!$data['support']){
        die(json_encode(array('code'=>1,'msg'=>'请输入技术支持')));
      }
      $res =Db::name('site')->where('id',$data['id'])->update($data);
      $res =true;
      if(!$res){
        die(json_encode(array('code'=>1,'msg'=>'保存失败')));
      }
        die(json_encode(array('code'=>0,'msg'=>'保存成功')));
    }

      //用户信息
    public function user_info(){
       //当前用户
      $permission = session("admin")['Roles2Binary'];
      $this->assign("permission", $permission);
      //分页
      $data['pageSize'] =900;
      $data['page'] =max(1,(int)input('get.page'));
      //搜索
      $data['seek'] =trim(input('get.seek'));
      //var_dump($data['seek']);exit();
      $where =array();
      //如果$wd有值,就不能让where条件空着
      $data['seek'] && $where ='Account like "%'.$data['seek'].'%" or Name like "%'.$data['seek'].'%"  or ID2 like "%'.$data['seek'].'%"';
      //分页排序和显示页数
      $data['data'] =$this->db->table('users')->where($where)->order(['Roles2Binary asc','Status desc'])->pages($data['pageSize']);
     
      $data['lists'] = Db::name("users")->alias("a")->join("role b", "a.Roles2Binary = b.id", 'left')->order(['Roles2Binary Asc','Status asc'])->select();

    $this->assign('data',$data);
    return view();
    } 
    //用户状态按钮
    public function change(){
      $account = input("Account");
      $status = input("status");
      $data = [
          "Status" => $status
      ];
      $res = Db::name("users")->where("Account", $account)->update($data);
      //var_dump($res);exit();
      $info = [
          "code" => $res,
          "msg" => 'ok!'
      ];
      return json_encode($info, JSON_UNESCAPED_UNICODE);
    }
    //角色管理
    public function role_manage(){
    $data['lists'] =$this->db->table('role')->lists();
   //var_dump($data['lists']);exit();
   $this->assign('data',$data);
        return view();
    }
  //角色设置
    public function role_set(){
     $Account =input('get.Account');

     $user_role_info = Db::name("users")->alias("a")->join("role b", "a.Roles2Binary = b.id", 'left')->where("a.Account", $Account)->find();
     $this->assign('data', $user_role_info);
     // dump($user_role_info);
     //加载角色
     // $groups =$this->db->table('role')->cates('id');
     $groups = Db::name("role")->select();
     // dump($groups);
     $this->assign("groups", $groups);
     return view();
    }
    //部门管理
    public function department(){
      //分页
       $data['pageSize'] =20;
       //接收分页数据
       $data['page'] =max(1,(int)input('get.page'));
       //搜索
       $data['seek'] =trim(input('get.seek'));
       //设置分页空数组
       $where =array();
       //如果$seek输入有值,就不能让where条件空着  linke在实际开发中最好别用,会增加数据的负载,应用搜索引擎
       $data['seek'] && $where ='Name like "%'.$data['seek'].'%"';
       //输出分页信息
       $data['data'] =$this->db->table('departments')->where($where)->order('Num asc')->pages($data['pageSize']);

      $data['lists'] =$this->db->table('departments')->lists();
      //$data['lists'] =Db::name("users")->alias("a")->join("departments b", "a.ClassNum = b.Num", "left")->field("a.*, b.Name as dname")->order('Roles2Binary asc')->select(); 
      $this->assign('data',$data);
      return view();
    }
    //保存角色设置
    public function role_set_save(){
        $account =input('post.Account');
        $data['Roles2Binary']=input('post.id');
        $data['Status'] = input("post.Status");
        //$res =true;
        if(isset($account)){
          $res =$this->db->table('users')->where(array('Account'=>$account))->update($data);
        }
        //var_dump($res);exit();
        if(!isset($res)){
            die(json_encode(array('code'=>1,'msg'=>'更新失败')));
        }
            die(json_encode(array('code'=>0,'msg'=>'更新成功')));   
    }
    
    //栏目展示
    public  function menus(){
      $permission = session("admin")['Roles2Binary'];
      $this->assign("permission", $permission);
        //接收Pid
      $pid =(int)input('get.pid');
      //加载数据库信息
      //$data['lists'] =$this ->db->table('menus')->where(array('pid'=>$pid))->lists();

      $result =Db::name("menus")->alias("a")->join("menus b", "a.mid = b.mid", 'left')->where('b.level',1)->order('a.mid asc')->select();
      //dump($data['lists']);exit();
      $result2 =Db::name("menus")->alias("a")->join("menus b", "a.mid = b.mid", 'left')->where('b.level',2)->order('b.pid asc')->select();
      
      foreach ($result as $k1 => $v1) {
          $res =[];
          foreach ($result2 as $k2 => $v2) {
              if ($v1['mid'] == $v2['pid']) {                  
                  $res[] =$v2;                 
              }
          }
          $result[$k1]['children'] = $res;
      }
      //dump($result);exit();
    $this->assign('pid',$pid);
    $this->assign('result',$result);
    return view();
    }
    //栏目管理
    public  function menus_manage(){
      $permission = session("admin")['Roles2Binary'];
      $this->assign("permission", $permission);
        //接收Pid
      $pid =(int)input('get.pid');
      //加载数据库信息
      //$data['lists'] =$this ->db->table('menus')->where(array('pid'=>$pid))->lists();
      $data['lists'] =$this->db->table('menus a left join web_users b on a.role=b.roles2binary')->field('a.*,b.Roles2Binary')->where(array('pid'=>$pid))->lists();
      //dump($data['lists']);exit();
      //返回上一级菜单
        $backid =0;
      if($backid >0){
         $parent =$this->db->table('menus')->where(array('mid'=>$pid))->order('mid asc')->item();
         $backid =$parent['pid'];
    }
    $this->assign('pid',$pid);
    $this->assign('backid',$backid); 
    $this ->assign('data',$data);
    return view();
    }
    //保存栏目管理
      public function save_menus(){
      //接收pid数据
      $pid =(int)input('post.pid');
      $ords =input('post.ords/a');
      //dump($ords);exit();
      $titles =input('post.titles/a');
      //dump($titles);exit();
      $controllers =input('post.controllers/a');
      $methods =input('post.methods/a');
      $status =input('post.status/a');
      if($titles==''){
         exit(json_encode(array('code'=>1,'msg'=>'请输入标题')));
      }
       if($controllers==''){
         exit(json_encode(array('code'=>1,'msg'=>'请输入控制器')));
      }
       if($methods==''){
         exit(json_encode(array('code'=>1,'msg'=>'请输入方法')));
      }
      //遍历
      foreach ($ords as $key => $value) {
          //新增数据
          $data['pid'] =$pid;
          $data['ord'] =$value;
          $data['title'] =$titles[$key];
          $data['controller'] =$controllers[$key];
          $data['method'] =$methods[$key];
          $data['status'] =isset($status[$key])?1:0;
          //var_dump($data);
          //插入菜单数据
          if($key ==0 && $data['title']){
              $this ->db->table('menus')->insert($data);
          }
          if($key >0){
            //删除菜单数据
          if($key>0 && $data['title'] =='' && $data['controller'] =='' && $data['method'] ==''){
            //删除
            $this->db->table('menus')->where(array('mid'=>$key))->delete();
          }else{
            //修改
            $this->db->table('menus')->where(array('mid'=>$key))->update($data);
          }
       }                 
     }
          exit(json_encode(array('code'=>0,'msg'=>'保存成功')));
  }
  //栏目层级
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
     //无限级分类
       private function formatMenus($items,&$res =array()){
          foreach ($items as $item){
            if(!isset($item['children'])){
                   $res[] =$item;
            }else{
               $tem =$item['children'];
               unset($item['children']);
               $res[] =$item;
               $this ->formatMenus($tem,$res);
            }
          }
             return $res;
     }

    //编辑/添加角色
    public function add_role(){
      $id =(int)input('get.id');
      $role =$this->db->table('role')->where(array('id'=>$id))->item();
      $role && $role['rights'] && $role['rights'] =json_decode($role['rights']);
      $this->assign('role',$role);
      
      $menu_list =$this ->db->table('menus')->where(array('status'=>0))->cates('mid');
      $menus =$this ->gettreeitems($menu_list);
      $results =array();
             
       foreach ($menus as $value) {
        $_data =isset($value['children'])?$value['children']:$value;
        $value['children'] =isset($value['children'])?$this ->formatMenus($value['children']):false;
        $value['children'] =$this ->formatMenus($_data);
        $results[] =$value;
       }
      $this->assign('menus',$results);
      return view();
    }
    /* //菜单层级
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
     //无限级分类
         private function formatMenus($items,&$res =array()){
            foreach ($items as $item){
              if(!isset($item['children'])){
                     $res[] =$item;
              }else{
                 $tem =$item['children'];
                 unset($item['children']);
                 $res[] =$item;
                 $this ->formatMenus($tem,$res);
              }
            }
               return $res;
       }*/
        //保存角色
       public function save_role(){
        $id =(int)input('post.id');
        $data['title'] =trim(input('post.title'));
        $menus =input('post.menu/a');
        if(!$data['title']){
           exit(json_encode(array('code'=>1,'msg'=>'角色名称不能为空')));
        }
        $menus && $data['rights'] =json_encode(array_keys($menus));
        if($id){
          $this->db->table('role')->where(array('id'=>$id))->update($data);
        }else{
          $this->db->table('role')->insert($data);
        }

        //插入数据库
        //$this->db->table('admin_groups')->insert($data);
        exit(json_encode(array('code'=>0,'msg'=>'保存成功了')));
     }
    //删除
    public function delete(){
      $id =(int)input('id');
      $this->db->table('role')->where(array('id'=>$id))->delete();
      exit(json_encode(array('code'=>0,'msg'=>'删除成功')));
    }
}