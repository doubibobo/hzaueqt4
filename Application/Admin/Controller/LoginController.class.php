<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\UserModel;

class LoginController extends Controller {
	public function index() {
		$this -> display();
	}

	// 进行登录页面
	public function doLogin() {
		$model = new UserModel();
		if ($_POST['id'] == "" || $_POST['pwd'] == "") {
			$data = "请填写用户名和密码！";
		} else {
			if ($model -> checkName($_POST['id'], $_POST['pwd'])) {
				// $this -> ajaxReturn($text);
				$data = "success";
			} else {
				$data = "用户名或密码错误！";
			}
		}
        echo json_encode($data);

	}

	// // 登录进行页面
	// public function do_login() {
	// 	$n = M('All');
	// 	$userid = $_GET['userid'];
	// 	$username = $_POST['username'];
	// 	$usertype = $_POST['usertype'];
	// 	// 首先判断是否是已经注册过的用户，前提是用户注册的用户名唯一
	// 	$doquery0 = "select count(id) from tp_all where uname = ".$userid."";
	// 	$result0 = $n -> query($doquery0);
	// 	if($result0) {
	// 		$doquery1 = "select id from tp_all where uname = ".$userid."";
	// 		$result1 = $n -> query($doquery1);
	// 		if($result1[0]['utype'] == $usertype || $result1[0]['utype'] == $usertype || $result1[0]['utype'] == $usertype) {
	// 			$doquery2 = "select * from tp_all where uname = ".$userid."";
	// 			$_SESSION['userid'] = $userid;
	// 			$_SESSION['username'] = $username;
	// 			$_SESSION['usertype'] = $usertype;
	// 			$text = "pass";
	// 			$this -> redirect("Index/index");
	// 		} else {
	// 			$text = "您不是管理员用户！";
	// 		}
	// 	} else {
	// 		$text = "您尚未注册账号！";
	// 	}
	// 	$this -> ajaxReturn($text);
	// }

	// 注销登录
	public function login_out(){
		$_SESSION = array();
		if(isset($_COOKIE['session_name()'])){
			setcookie(session_name(),'',time()-1,'/');
		}
		session_destroy();
		$this -> redirect("/Admin");
	}
}
?>