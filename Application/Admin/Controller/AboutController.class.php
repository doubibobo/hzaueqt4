<?php
namespace Admin\Controller;
use Think\Controller;
class AboutController extends Controller {
    private $R_TYPE;
    private $FIRSTINFOR = 0;
    private $SECONDINFOR = 1;
    private $result = array();
    private function getData($type, $order) {
        $n = M("Regulations");
        $query = "select * from tp_regulations where r_type = ".$type." ORDER BY ".$order." DESC";
        $this->result = $n -> query($query);
    }

    public function _initialize(){
      if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
        $this -> redirect("/Admin/Login");
      }
    }

    /**
     * 方法功能：查询得到所有的机构类型
     */
    private function getAllAdministratorType() {
        $arr = D("Admistratortype");
        $result = $arr -> relation(true) -> select();
        return $result;
    }


	public function about_show1(){
        $this->R_TYPE = 1;
        self::getData($this->R_TYPE, 'id');
        $this->assign("data", $this->result[$this->SECONDINFOR]);
		$this -> display();
	}
	public function about_show2(){
	    $this -> assign("administratorType", self::getAllAdministratorType());
        $model = M("Admistratortype");
        $this -> assign("admistratortype", $model -> select());
		$this -> display();
	}

    /**
     * 方法功能：删除一个相应的机构
     */
	public function deleteAdministrator() {
	    $where = $_GET['id'];
	    $arr = M("Administrator");
	    $result = $arr -> where("id = $where") -> delete();
	    if ($result) {
            $this -> redirect("about_show2");
        } else {
	        $this -> error("删除失败");
        }
    }

    public function addAdministrator() {
        if (empty($_POST['name']) || empty($_POST['contact'])) {
            alertMessage("机构名称或者机构信息不能为空！");
        }
        // if (!isUrl($_POST['address'])) {
            if ($_POST['address'] == "") {
                $data['alink'] = "#";
            }  else {
                $data['alink'] = $_POST['address'];
            }
        // } else {
        //     alertMessage("网址填写不正确！");
        // } 
	    $data['a_name'] = $_POST['name'];
	    $data['a_contact'] = $_POST['contact'];
	    $data['type'] = $_POST['type'];
        $data['theway'] = $_POST['people'];
        $m = M("Administrator");
        $result = $m -> add($data);
        if ($result) {
            $this -> redirect("about_show2");
        } else {
            $this -> error("添加失败");
        }
    }

	public function about_show3(){
	    $m = D("Team");
	    $result = $m -> relation(true) -> select();
	    $this -> assign("data", $result);
		$this -> display();
	}

    // 添加一个机构的大类
    public function addOneJc() {
        if ($_POST['courseName'] == "") {
            alertMessage("机构名称不能为空！");
        }
        $model = M("Admistratortype");
        $model -> type_name = $_POST['courseName'];
        $model -> type_content = "联络人";
        $model -> tyway = "联络方式";
        if($model -> add()) {
            alertMessage("添加成功！");
        } else {
            alertMessage("添加失败！");
        }
    }

    // 删除一个机构
    public function deleteOneType() {
        $where = $_GET['id'];
        $model = M("Admistratortype");
        if ($model -> where("id = $where") -> delete()) {
            alertMessage("删除成功！");
        } else {
            alertMessage("删除失败！");
        }
    }
    /**
     * 添加一个大类
     */
    public function addType() {
        $m = M("Team");
        if ($_POST['name'] == "") {
            alertMessage("大类名称不能为空！");
        }

        $data['team_name'] = $_POST['name'];
        $result = $m -> add($data);
        if($result) {
            $this -> redirect("about_show3");
        } else {
            $this -> error("添加大类失败");
        }
    }
    // 删除一个大类
    public function deleteType() {
        $where = $_GET['id'];
        $model = M("Team");
        if ($model -> where("id = $where") -> delete()) {
            alertMessage("删除成功！");
        } else {
            alertMessage("删除失败！");
        }
    }
    /**
     * 添加一个教师
     */
	public function doAddItems() {
	    $m = M("Teamitems");

        if ($_POST['gallery_title'] == "") {
            // alertMessage("");
            $data = "请填写教师的姓名";
        }

	    $data['name'] = $_POST['gallery_title'];
	    $data['idt'] = $_POST['theadd'];
	    $data['cnnt'] = htmlspecialchars_decode($_POST['content']);
	    $result = $m -> add($data);
        if($result){
            $data = array(
                'code'=>'0',
                'id'=>$result
            );
        }
        echo json_encode($data);
    }

    /**
     * 删除一个教师
     */
    public function deleteTeamItems() {
        $where = $_GET['id'];
        $m = M("Teamitems");
        $result = $m -> where("id = $where") -> delete();
        if ($result) {
            $this -> redirect("about_show3");
        } else {
            $this -> error("删除错误");
        }
    }

    /**
     * 显示更新的一个界面
     */
	public function about_show3_update(){
        $where = $_GET['id'];
        $m = M("Teamitems");
        $result = $m -> where("id = $where") -> select();  

        $allteams = M("Team");
        $this->assign("allteams", $allteams->select());

        $this -> assign("data", $result[0]);
		$this -> display();
	}

    /**
     * 执行页面的修改
     */
	public function show3Do() {
        $id = $_POST['id'];
        if ($_POST['gallery_title'] == "") {
            alertMessage("请填写教师的姓名");
        }

        $m = M("Teamitems");
        $m -> cnnt = htmlspecialchars_decode($_POST['content']);
        $m -> name = $_POST['gallery_title'];
        $m -> idt = $_POST['theadd'];
        $result = $m -> where("id=$id") -> save();
        if($result){
            $data = array(
                'code'=>'0',
                'id'=>$id
            );
            echo json_encode($data);
        }
    }
	public function about_show4(){
        $this->R_TYPE = 1;
        self::getData($this->R_TYPE, 'id');
        $this->assign("data", $this->result[$this->FIRSTINFOR]);
		$this -> display();
	}
	public function about_show5(){
        $this->R_TYPE = 19;
        self::getData($this->R_TYPE, 'id');
        $this->assign("data", $this->result);
		$this -> display();
	}
	public function about_show5_update(){
        $where = $_GET['id'];
        $n = M("Regulations");
        $QUERY = "SELECT * FROM tp_regulations WHERE id =".$where."";
        $allResults = $n -> query($QUERY);
        if ($allResults) {
            $this->assign("data", $allResults[$this->FIRSTINFOR]);
        } else {
            $this->error("有错误！");
        }
        $this -> display();
	}

	public function aboutDoAdd() {
		$n = M('About');
		$n -> Create();  //创建数据对象
		if($_POST['aboutname'] == "" || $_POST['aboutcnt'] == ""){
			$id = 0;
		}else{
			$id  = $n -> add(); //写入数据库，并且返回result的值进行判断
		}
		if($id){
	        $data = array(
	            'code'=>'0',
	            'id'=>$id
	        );
	        echo json_encode($data);
		}
	}
	public function aboutDoUpdate() {
		$where = $_POST['id'];
		$n = M('Regulations');
//		$n -> r_content = strip_tags($_POST['content']);
		$n -> r_content = htmlspecialchars_decode($_POST['content']);
		$result = $n -> where("id = $where") -> save();
		if($result){
            $data = array(
                'code'=>'1',
                'where'=> $where,
            );
            echo json_encode($data);
    	}
	}

    /**
     * 方法功能：更改动态方法2
     */
    public function aboutDoUpdate1() {
        $where = $_POST['id'];
        $n = M('Regulations');
        $n -> r_content = htmlspecialchars_decode($_POST['content']);
        $n -> r_name = $_POST['gallery_title'];
        $n -> r_time = date("Y-m-d");
        $result = $n -> where("id = $where") -> save();
        if($result){
            $data = array(
                'code'=>'1',
                'where'=> $where,
            );
            echo json_encode($data);
        }
    }

    /**
     * 方法功能：删除二级页面：教改项目
     */
    public function about_show1_delete() {
        $where = $_GET['id'];
        $n = M("Regulations");
        $QUERY = "DELETE FROM tp_regulations WHERE id =".$where."";
        $n -> execute($QUERY);
        $this -> redirect('about_show5');
//        echo "<script>window.location.href=document.referrer; </script>";
    }

    /**
     * 方法功能：添加一条动态
     */
    public function subInfor(){
        $type = $_GET['at'];
        $n = M('Regulations');
        $n -> r_type = $type;
        $n -> r_time = date("Y-m-d");
        $n -> r_name = $_POST['gallery_title'];
        $n -> r_content = htmlspecialchars_decode($_POST['content']);
        $id  = $n -> add(); //写入数据库，并且返回result的值进行判断
        if($id){
            $data = array(
                'code'=>'0',
                'id'=>$id
            );
            echo json_encode($data);
        }
    }
}
?>