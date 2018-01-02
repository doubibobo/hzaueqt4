<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\EquipmentModel;
class EquipmentController extends Controller {
    private $R_TYPE = 2;
    private $FIRSTINFOR = 0;
    private $SECONDINFOR = 1;
    private $THIRDINFOR = 2;
    private $FOURTHINFOR = 3;
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

	public function equipment_show1() {
		self::getData();
        $this -> assign('data', $this->arr[$this->FIRSTINFOR]);
		$this -> display();
	}
	public function equipment_show2() {
        self::getData();
        $this -> assign('data', $this->arr[$this->SECONDINFOR]);
		$this -> display();
	}
	public function equipment_show3() {
        self::getData();
        $this -> assign('data', $this->arr[$this->THIRDINFOR]);
		$this -> display();
	}
	public function equipment_show4() {
		// $mode = new EquipmentModel();
  //       $this -> assign("data", $mode -> getAllEquipment());
        self::getData();
        $this -> assign('data', $this->arr[$this->FOURTHINFOR]);
		$this -> display();
	}
	public function equipment_show4_eqt() {
		$where = $_GET['id'];
        $model = new EquipmentModel();
        $this -> assign("data", $model -> getOneEquipment($where));
		$this -> display();
	}


    // 获得某一个页面的id

}
?>