<?php
namespace Home\Controller;
use Think\Controller;
class EducationController extends Controller {
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
        $n = M("Regulations");
        $doQuery = $this->sql. "".$type."";
        $this->arr = $n->query($doQuery);
    }
	public function education_show1() {
		$mode = M("Regulations");
		$count = $mode -> where("r_type = 4") -> count();
		$Page = new \Think\Page($count, 20);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;
        $links = $mode -> where("r_type = 4") -> order("id desc") -> limit($pre.','.$next) -> select();
        $this -> assign("data", $links);
        $this -> assign("show", $show);
		$this -> display();
	}
	public function education_show2() {
        $this->R_TYPE = 3;
		self::getData($this->R_TYPE);
		$this->assign("data", $this->arr[$this->FIRSTINFOR]);
		$this -> display();
	}
	public function education_show3() {
        // 首先展示试验区课表，c_type = 0
        $mode = D("Coursetp");
        $this -> assign("shiyanqu", $mode -> where("t_type = 0") -> relation(true) -> select());
        // 其次展示课程课表
        $this -> assign("kechengkebiao", $mode -> where("t_type != 0") -> relation(ture) -> select());
		$this -> display();
	}
	public function education_show4() {
        $mode = D("Coursetp");
        $this -> assign("shiyanqu", $mode -> where("t_type = 0") -> relation(true) -> select());
        // 其次展示课程课表
        $this -> assign("kechengkebiao", $mode -> where("t_type != 0") -> relation(ture) -> select());
        $this -> display();
	}

	public function education_show1_article(){
        $where = $_GET['id'];
        $m = M("Regulations");
        $query = "select r_time, r_name, r_content from tp_regulations where id = ".$where."";
        $this -> all = $m->query($query);
        $this -> assign("data", $this->all[0]);
		$this -> display();
	}
}
?>