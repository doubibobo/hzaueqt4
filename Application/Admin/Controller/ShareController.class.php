<?php
namespace Admin\Controller;
use Think\Controller;
class ShareController extends Controller {
    private $FIRSTINFOR = 0;
    private $SECONDINFOR = 1;
    private $THIRDINFOR = 2;
    private $result = array();
    public function _initialize(){
      if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
        $this -> redirect("/Admin/Login");

      }
    }
    private function getData() {
        $n = M("Regulations");
        $query = "select * from tp_regulations where r_type = 14";
        $this->result = $n -> query($query);
    }
	public function share_show1(){
        self::getData();
        $this->assign("data", $this->result[$this->FIRSTINFOR]);
		$this -> display();
	}
	public function share_show2(){
        self::getData();
        $this->assign("data", $this->result[$this->SECONDINFOR]);
		$this -> display();
	}
	public function share_show3(){
        self::getData();
        $this->assign("data", $this->result[$this->THIRDINFOR]);
		$this -> display();
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
}