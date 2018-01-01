<?php
namespace Home\Controller;
use Think\Controller;
class LaboratoryController extends Controller {
    private $R_TYPE = 10;
    private $FIRSTINFOR = 0;
    private $sql = "select * from tp_regulations where r_type = ";
    private $arr = array();
    /**
     * 方法功能：进行sql语句的组装，并且返回中心简介和管理模式的查询结果
     */
    private function getData($type) {
        $n = M("Regulations");
        $doQuery = $this->sql. "".$type."";
        $this->arr = $n->query($doQuery);
    }
	public function laboratory_show1() {
        $this->R_TYPE = 10;
        self::getData($this->R_TYPE);
        $this->assign("data", $this->arr[$this->FIRSTINFOR]);
		$this -> display();
	}

    private function getPage($type) {
        $mode = M("Regulations");
        $count = $mode -> where("r_type = $type") -> count();
        $Page = new \Think\Page($count, 20);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;
        $links = $mode -> where("r_type = $type") -> order("id desc") -> limit($pre.','.$next) -> select();
        $this -> assign("data", $links);
        $this -> assign("show", $show);
    }

	public function laboratory_show21($type = 0) {
        $this -> display();
	}

    public function laboratory_show2() {
        $this -> getPage(11);
        $this -> display("laboratory_show21");
    }

	public function laboratory_show3() {
        $this->R_TYPE = 12;
        self::getData($this->R_TYPE);
        $this->assign("data", $this->arr);
		$this -> display();
	}
	public function laboratory_show4() {
        $this -> getPage(13);
		$this -> display();
	}

    public function theSearch() {
        if (!empty($_POST['search'])) {
            $_SESSION['search'] = $_POST['search'];
        }   else if (empty($_SESSION['search'])) {
            alertMessage("搜索项目不能为空！");
        }
        $map['r_name'] = array('like','%'.$_SESSION['search'].'%');
        $map['r_type'] = 11;
        $mode = M("Regulations");
        $count = $mode -> where($map) -> count();
        $Page = new \Think\Page($count, 20);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;
        $links = $mode -> where($map) -> order("id desc") -> limit($pre.','.$next) -> select();
        $this -> assign("data", $links);
        $this -> assign("show", $show);
        $this -> display("laboratory_show21");
    }

    private function findItems($where) {
        $m = M("Regulations");
        $query = "select r_time, r_name, r_content from tp_regulations where id = ".$where."";
        $this -> all = $m->query($query);
    }
	public function laboratory_show2_article(){
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> assign("value", "运行项目");
		$this -> display("laboratory_show_article");
	}
	public function laboratory_show4_article(){
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> assign("value", "项目成果");
		$this -> display("laboratory_show_article");
	}

    public function laboratory_show_article() {
        $this -> display();
    }
}
?>