<?php
namespace Home\Controller;
use Think\Controller;
class ShareController extends Controller {
    private $R_TYPE = 14;
    private $FIRSTINFOR = 0;
    private $SECONDINFOR = 1;
    private $THIRDINFOR = 2;
    private $sql = "select * from tp_regulations where r_type = ";
    private $arr = array();
    /**
     * 方法功能：进行sql语句的组装，并且返回中心简介和管理模式的查询结果
     */
    private function getData() {
        $n = M("Regulations");
        $doQuery = $this->sql. "".$this->R_TYPE."";
        $this->arr = $n->query($doQuery);
    }
	public function share_show1() {
        self::getData();
        $this->assign("data", $this->arr[$this->FIRSTINFOR]);
		$this -> display();
	}
	public function share_show2() {
        self::getData();
        $this->assign("data", $this->arr[$this->SECONDINFOR]);
		$this -> display();
	}
	public function share_show3() {
        self::getData();
        $this->assign("data", $this->arr[$this->THIRDINFOR]);
		$this -> display();
	}
}
?>