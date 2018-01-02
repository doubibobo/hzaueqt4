<?php
namespace Home\Controller;
use Think\Controller;
class FictitiousController extends Controller {
    private $R_TYPE = 3;
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
	public function fictitious_show1() {
        $this->R_TYPE = 15;
        self::getData($this->R_TYPE);
		$this -> display();
	}
	public function fictitious_show2() {
        $this->R_TYPE = 16;
        self::getData($this->R_TYPE);
		$this -> display();
	}
	public function fictitious_show3() {
        $this->R_TYPE = 17;
        self::getData($this->R_TYPE);
		$this -> display();
	}
	public function fictitious_show4() {
        $this->R_TYPE = 18;
        self::getData($this->R_TYPE);
		$this -> display();
	}
    private function findItems($where) {
        $m = M("Regulations");
        $query = "select r_time, r_name, r_content from tp_regulations where id = ".$where."";
        $this -> all = $m->query($query);
    }
	public function fictitious_show1_article(){
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> display();
	}
	public function fictitious_show2_article(){
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> display();
	}
	public function fictitious_show3_article(){
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> display();
	}
	public function fictitious_show4_article(){
        $where = $_GET['id'];
        self::findItems($where);
        $this -> assign("data", $this->all[0]);
        $this -> display();
	}
}
?>