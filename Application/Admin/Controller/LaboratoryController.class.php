<?php
namespace Admin\Controller;
use Think\Controller;
class LaboratoryController extends Controller {
    private $R_TYPE;
    private $FIRSTINFOR = 0;
    private $sql = "select * from tp_regulations where r_type = ";
    private $arr = array();
    
    public function _initialize(){
      if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
        $this -> redirect("/Admin/Login");

      }
    }
    /**
     * 方法功能：进行sql语句的组装，并且返回中心简介和管理模式的查询结果
     */
    private function getData($type, $order) {
        $n = M("Regulations");
        $doQuery = $this->sql. "".$type."";
        $this->arr = $n->query($doQuery);
    }
	public function laboratory_show1(){
        $this->R_TYPE = 10;
        self::getData($this->R_TYPE, "id");
        $this->assign("data", $this->arr[$this->FIRSTINFOR]);
		$this -> display();
	}
	public function laboratory_show2(){
        $this->R_TYPE = 11;
        self::getData($this->R_TYPE, "id");
        $this->assign("data", $this->arr);
		$this -> display();
	}
	public function laboratory_show3(){
        $this->R_TYPE = 12;
        self::getData($this->R_TYPE, "id");
        $this->assign("data", $this->arr);
		$this -> display();
	}
	public function laboratory_show4(){
        $this->R_TYPE = 13;
        self::getData($this->R_TYPE, "id");
        $this->assign("data", $this->arr);
		$this -> display();
	}

	public function laboratory_show3_read() {
        $where = $_GET['id'];
        $n = M("Regulations");
        $QUERY = "SELECT * FROM tp_regulations WHERE id =".$where."";
        $allResults = $n -> query($QUERY);
        $this->assign("data", $allResults[$this->FIRSTINFOR]);
        $this->display();
    }
    /**
     * 方法功能：修改二级页面：教改项目
     */
    public function laboratory_show2_update(){
        $where = $_GET['id'];
        $tp = $_GET['by'];
        switch ($tp) {
            case 2: $this->dest = "运行项目"; break;
            case 3: $this->dest = "项目申请"; break;
            case 4: $this->dest = "项目成果"; break;
            default: $this->dest = "运行项目"; break;
        }
        $n = M("Regulations");
        $QUERY = "SELECT * FROM tp_regulations WHERE id =".$where."";
        $allResults = $n -> query($QUERY);
        if ($allResults) {
            $this->assign("dest", $this->dest);
            $this->assign("data", $allResults[$this->FIRSTINFOR]);
        } else {
            $this->error("有错误！");
        }
        $this -> display();
    }

    public function aboutDoUpdate()
    {
        $where = $_POST['id'];
        $n = M('Regulations');
//		$n -> r_content = strip_tags($_POST['content']);
        $n->r_content = htmlspecialchars_decode($_POST['content']);
        $result = $n->where("id = $where")->save();
        if ($result) {
            $data = array(
                'code' => '1',
                'where' => $where,
            );
            echo json_encode($data);
        }
    }
    /**
     * 方法功能：删除二级页面：教改项目
     */
    public function laboratory_show1_delete() {
        $where = $_GET['id'];
        $ty = $_GET['ta'];
        $n = M("Regulations");
        $QUERY = "DELETE FROM tp_regulations WHERE id =".$where."";
        $n -> execute($QUERY);
        $this->redirect("laboratory_show".$ty."");
//        $this -> redirect('creation_show1');
//        echo "<script>window.location.href=document.referrer; </script>";
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