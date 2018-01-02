<?php
namespace Admin\Controller;
use Think\Controller;
class CreationController extends Controller {
    private $R_TYPE;
    private $result = array();
    private $dest;

    public function _initialize(){
      if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
        $this -> redirect("/Admin/Login");
      }
    }

    /**
     * @param $type
     * @param $order
     * 方法功能：根据参数给定的条件查询表中的数据
     */
    private function getData($type, $order) {
        $n = M("Regulations");
        $query = "select * from tp_regulations where r_type = ".$type." ORDER BY ".$order." desc";
        $this->result = $n -> query($query);
    }
	public function creation_show1(){
        $this->R_TYPE = 5;
        self::getData($this->R_TYPE, "id");
        $this->assign("data", $this->result);
		$this -> display();
	}
	public function creation_show2(){
        $this->R_TYPE = 6;
        self::getData($this->R_TYPE, "r_time");
        $this->assign("data", $this->result);
		$this -> display();
	}
	public function creation_show3(){
        $this->R_TYPE = 7;
        self::getData($this->R_TYPE, "r_time");
        $this->assign("data", $this->result);
		$this -> display();
	}
	public function creation_show4(){
        $this->R_TYPE = 8;
        self::getData($this->R_TYPE, "r_time");
        $this->assign("data", $this->result);
		$this -> display();
	}
	public function creation_show5(){
        $this->R_TYPE = 9;
        self::getData($this->R_TYPE, "r_time");
        $this->assign("data", $this->result);
		$this -> display();
	}
    /**
     * 方法功能：修改二级页面：教改项目
     */
    public function creation_show1_update(){
        $where = $_GET['id'];
        $tp = $_GET['by'];
        switch ($tp) {
            case 1: $this->dest = "教改项目"; break;
            case 2: $this->dest = "教改成果"; break;
            case 3: $this->dest = "创新实验项目"; break;
            case 4: $this->dest = "学生创新项目"; break;
            case 5: $this->dest = "学生创新成果"; break;
            default: $this->dest = "教改项目"; break;
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

    /**
     * 方法功能：删除二级页面：教改项目
     */
    public function creation_show1_delete() {
        $where = $_GET['id'];
        $ty = $_GET['ta'];
        $n = M("Regulations");
        $QUERY = "DELETE FROM tp_regulations WHERE id =".$where."";
        $n -> execute($QUERY);
        $this->redirect("creation_show".$ty."");
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