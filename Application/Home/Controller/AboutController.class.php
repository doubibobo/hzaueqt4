<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends Controller {
    private $R_TYPE = 1;
    private $FIRSTINFOR = 0;
    private $SECONDINFOR = 1;
    private $sql = "select * from tp_regulations where r_type = ";
    private $arr = array();
    private $all = array();
    private $team = array();

    /**
     * 方法功能：进行sql语句的组装，并且返回中心简介和管理模式的查询结果
     */
    private function getData() {
        $n = M("Regulations");
        $doQuery = $this->sql. "".$this->R_TYPE."";
        $this->arr = $n->query($doQuery);
    }
    /**
     * 方法功能：进行机构的查询，并且返回所有机构的查询结果
     */
    private function getAllAdmin() {
        $m = D("Admistratortype");
        $this->all = $m-> relation(true)->select();
    }
    private function getAllTeam() {
        $k = D("Team");
        $this->team = $k->relation(true)->select();
    }
    /**
     * 方法功能：显示中心简介页面
     */
	public function about_show1() {
	    self::getData();
		$this -> assign('data', $this->arr[$this->FIRSTINFOR]);
		$this -> display();
	}

    /**
     * 方法功能：显示机构设置页面
     */
	public function about_show2() {
	    self::getAllAdmin();
        // var_dump($this -> all);
        // exit();
	    $this->assign('all', $this->all);
		$this -> display();
	}

    /**
     * 方法功能：显示团队建设页面
     */
	public function about_show3() {
	    self::getAllTeam();
        $this->assign('all', $this->team);
		$this -> display();
	}

	public function about_show3_explan() {
	    $where = $_GET['id'];
	    $m = M("Teamitems");
	    $result = $m -> where("id = $where") -> select();
	    if (empty($result[0]['cnnt'])) {
            $result[0]['cnnt'] = "暂无简介";
        } else {

        }
        $this -> assign("data", $result[0]);
	    $this -> display();
    }

    /**
     * 方法功能：显示管理模式页面
     */
	public function about_show4() {
        self::getData();
		$this -> assign('data',$this->arr[$this->SECONDINFOR]);
		$this -> display();
	}
    /**
     * 方法功能：展示年度报告页面
     */
    public function about_show5(){
        $model = M("Regulations");
        $count = $model -> where("r_type = 19") -> count();
        $Page = new \Think\Page($count, 18);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;
        $links = $model -> where("r_type = 19") -> order("id desc") -> limit($pre.','.$next) -> select();
        $this -> assign("data", $links);
        $this -> assign("show", $show);
        $this -> display();
    }
    // 展示年度报告的详细内容
    public function about_show5_article(){
        $where = $_GET['id'];
        $model = M("Regulations");
        $data = $model -> where("id = $where") -> find();
        $this -> assign("data", $data);
        $this -> display();
    }
}
?>