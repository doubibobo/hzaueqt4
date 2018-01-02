<?php
namespace Home\Controller;
use Think\Controller;
class CreationController extends Controller {
    private $R_TYPE;
    private $FIRSTINFOR = 0;
    private $SECONDINFOR = 1;
    private $sql = "select * from tp_regulations where r_type = ";
    private $arr = array();
    private $all = array();
    private $team = array();

    /**
     * 方法功能：进行sql语句的组装，并且返回中心简介和管理模式的查询结果
     */
    private function getData($type) {
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

	public function creation_show1() {
        $this -> getData(5);
        $this -> display();
	}
	public function creation_show2() {
        $this -> getData(6);
        $this -> display();
	}
	public function creation_show3() {
        $this -> getData(7);
        $this -> display();
	}
	public function creation_show4() {
        $this -> getData(8);
        $this -> display();
	}
	public function creation_show5() {
        $this -> getData(9);
        $this -> display();
	}

	private function findItems($where) {
        $m = M("Regulations");
        $query = "select r_time, r_name, r_content from tp_regulations where id = ".$where."";
        $this -> all = $m->query($query);
    }
	public function creation_show1_article() {
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> display();
    }
    public function creation_show2_article() {
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> display();
    }
    public function creation_show3_article() {
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> display();
    }
    public function creation_show4_article() {
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> display();
    }
    public function creation_show5_article() {
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> display();
    }
}
?>