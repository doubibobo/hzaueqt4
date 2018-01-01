<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\InformationModel;
use Home\Model\ImagicsModel;

class IndexController extends Controller {

	public function gol_search() {
		$this -> show();
	}
    public function index(){
    	// 首页展示部分通知
    	$n = M('Information');
    	// doquery是返回十条通知信息的查询语句
    	$doquery = "select * from tp_information order by id desc limit 10";
    	$arr = $n -> query($doquery);

    	$m = M("Imagics");
    	// doquery1是返回左上角图片信息的查询语句
		$doquery1 = "select * from tp_imagics where type = 0";
    	// doquery2是返回右上角欢迎界面的查询语句
		$doquery2 = "select * from tp_imagics where type = 1";

		$arr1 = $m -> query($doquery1);
		$arr2 = $m -> query($doquery2);
        $doqueryjiaoxueziyuan = "select * from tp_imagics where type = 99";
		$doquerychengguozhanshi = "select * from tp_imagics where type = 98";
		$doquerymeituxinshang = "select * from tp_imagics where type = 97";

		$jiaoxueziyuan = $m -> query($doqueryjiaoxueziyuan);
		$chengguozhanshi = $m  -> query($doquerychengguozhanshi);
		$meituxinshang = $m -> query($doquerymeituxinshang);
		$this -> assign('jiaoxueziyuan', $jiaoxueziyuan);
    	$this -> assign('chengguozhanshi', $chengguozhanshi[0]);
    	$this -> assign('meituxinshang', $meituxinshang[0]);

    	
		$k = M('Link');
		// doquery3是返回底部校内链接的查询语句
		$doquery3 = "select * from tp_link where type = 0";
		// doquery4是返回底部校际链接的查询语句
		$doquery4  = "select * from tp_link where type = 1";
		$arr3 = $k -> query($doquery3);
		$arr4 = $k -> query($doquery4);

		$y = M('News');
		$doquery5 = "select * from tp_news order by id desc limit 10";
		$arr5 = $y -> query($doquery5);

        $n = M("Regulations");
        $doQuery6 = "select * from tp_regulations where r_type = 4";
        $arr6 = $n->query($doQuery6);

    	$this -> assign('data',$arr);
    	$this -> assign('data1',$arr1);
    	$this -> assign('data2',$arr2);
    	$this -> assign('data3',$arr3);
    	$this -> assign('data4',$arr4);
    	$this -> assign('data5',$arr5);
    	$this -> assign('data6',$arr6);
        $this -> display();
    }
	// 新闻通知具体内容的展示
	public function itemsInfor() {
		$where = $_GET['id'];
		$doquery = "select * from tp_information where id = ".$where."";
		$n = M('Information');
		$arr = $n -> query($doquery);
		$arred = $arr[0];
		$arred['inforcnt'] = htmlspecialchars_decode($arred['inforcnt']);
		$this -> assign('data',$arred);
		$this -> display();
	}
	// 查询中心动态的某一条数据
	public function newsOne() {
		$where = $_GET['id'];
		$n = M("News");
		$doquery = "select * from tp_news where id = ".$where."";
		$doquery1 = "UPDATE tp_news set clicknum = clicknum + 1 where id = ".$where."";
		$arr = $n -> query($doquery);
		$n -> execute($doquery1);
		$arr[0]['newcontent'] = htmlspecialchars_decode($arr[0]['newcontent']);
		$this -> assign('data',$arr[0]);
		$this -> display();
	}

	public function notice($value='')
	{
		$model = new InformationModel();
        $Page = new \Think\Page($model -> getInformationCount($id), 10);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;
        $this -> assign("data", $model -> getAllInformation($pre, $next));
        $this -> assign("show", $show);
		$this -> display();
	}

	public function showInfor($value='')
	{
		$where = $this ->getTheId();
		$model = new InformationModel();
		$this -> assign("data", $model -> getOneInformation($where));
		$this -> display();
	}

	// 左上角图片的详细展示
	public function pictureshow($value='')
	{
		$model = new ImagicsModel();
		$this -> assign("data", $model -> getOneImagics($this -> getTheId()));
		$this -> display();
	}

	// 获得前台页面的id
	private function getTheId($value='')
	{
		# code...
		$id = trim($_GET['id']);
		if (!empty($id) && is_numeric($id)) {
			return $id;
		} else {
			alertMessage("查询错误，哈哈哈");
		}
	}
}