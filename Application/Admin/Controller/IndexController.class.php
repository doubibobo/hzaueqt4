<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\InformationModel;
class IndexController extends Controller {
	// 判断是否登录和登录用户的用户类型
    public function _initialize(){
      if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
        $this -> redirect("/Admin/Login");
      }
    }
    /**
     * 方法功能：展示后台首页的第一个页面
     */
    public function index_show1(){
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
		$doqueryjiaoxueziyuan = "select * from tp_imagics where type = 99";
		$doquerychengguozhanshi = "select * from tp_imagics where type = 98";
		$doquerymeituxinshang = "select * from tp_imagics where type = 97";


		$arr1 = $m -> query($doquery1);
		$arr2 = $m -> query($doquery2);
		$jiaoxueziyuan = $m -> query($doqueryjiaoxueziyuan);
		$chengguozhanshi = $m  -> query($doquerychengguozhanshi);
		$meituxinshang = $m -> query($doquerymeituxinshang);

		$k = M('Link');
		// doquery3是返回底部校内链接的查询语句
		$doquery3 = "select * from tp_link where type = 0";
		// doquery4是返回底部校际链接的查询语句
		$doquery4  = "select * from tp_link where type = 1";
		$arr3 = $k -> query($doquery3);
		$arr4 = $k -> query($doquery4);

		// doquery5是返回中心动态的查询语句
		$x = M('News');
		$query5 = "select * from tp_news";
		$arr5 = $x -> query($query5);

    	$this -> assign('data',$arr);
    	$this -> assign('data1',$arr1);
    	$this -> assign('data2',$arr2);
    	$this -> assign('data3',$arr3);
    	$this -> assign('data4',$arr4);
    	$this -> assign('data5',$arr5);
    	$this -> assign('jiaoxueziyuan', $jiaoxueziyuan);
    	$this -> assign('chengguozhanshi', $chengguozhanshi[0]);
    	$this -> assign('meituxinshang', $meituxinshang[0]);
        $this -> display();
    }

    /**
     * 方法功能：添加一份照片
     */
    public function addImagic() {
    	$this->isPostEmpty($_POST);
        //设置上传文件类型
    	// $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型


        $Realname = $_FILES['gallery_file']['name'];
        $upload = new \Think\Upload();//实例化上传类
        $upload -> maxSize = 3145728;//设置上传文件的大小
        $upload->rootPath  =   './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =   './File/'; // 设置附件上传（子）目录
        $upload->saveName = 'time';

        //上传文件
        $info = $upload -> upload();
        if(!$info){
            //上传错误提示信息
            $this -> error($upload->getError());
        }

        $n = M('Imagics');
        $n -> imgname = $_POST['gallery_title'];
        $n -> imgintro = $_POST['gallery_textarea'];
        $n -> type = $_POST['ty'];
        $n -> imgadd =$info['gallery_file']['savepath'].$info['gallery_file']['savename'];
        $last = $n -> add();
        if ($last) {
        	alertMessage("添加成功");
        } else {
        	alertMessage("请检查网络后重试");
        }
    }

    public function addImagic2() {
    	$_POST['gallery_title'] = $_POST['gallery_title'].','.$_POST['gallery_type'];
    	$this->isPostEmpty($_POST);
        //设置上传文件类型
    	// $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型


        $Realname = $_FILES['gallery_file']['name'];
        $upload = new \Think\Upload();//实例化上传类
        $upload -> maxSize = 3145728;//设置上传文件的大小
        $upload->rootPath  =   './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =   './File/'; // 设置附件上传（子）目录
        $upload->saveName = 'time';

        //上传文件
        $info = $upload -> upload();
        if(!$info){
            //上传错误提示信息
            $this -> error($upload->getError());
        }

        $n = M('Imagics');
        $n -> imgname = $_POST['gallery_title'];
        $n -> imgintro = $_POST['gallery_textarea'];
        $n -> type = $_POST['ty'];
        $n -> imgadd =$info['gallery_file']['savepath'].$info['gallery_file']['savename'];
        $last = $n -> add();
        if ($last) {
        	alertMessage("添加成功");
        } else {
        	alertMessage("请检查网络后重试");
        }
    }

    /**
     * 左上角图片编辑功能
     */
    public function imgEdit() {
    	$this->isPostEmpty($_POST);
        $n = M('Imagics');
        $where = $_POST['id'];
        $n -> imgname = $_POST['gallery_title'];
        $n -> imgintro = $_POST['gallery_textarea'];
        // $n -> type = $_POST['ty'];
        $result = $n -> where("id = $where")->save();

        if ($result) {
        	alertMessage("修改成功");
        } else {
        	alertMessage("请检查网络后重试");
        }
    }		

    /**
     * 左上角图片编辑功能
     */
    public function imgEdit3() {
        $this->isPostEmpty($_POST);
        $n = M('Imagics');
        $where = $_POST['gallery_id'];
        $n -> imgname = $_POST['gallery_title'];
        $n -> imgintro = $_POST['gallery_textarea'];
        $result = $n -> where("id = $where")->save();
        if ($result) {
            alertMessage("修改成功");
        } else {
            alertMessage("请检查网络后重试");
        }
    }       

    /**
     * 左上角图片编辑功能
     */
    public function imgEdit4() {
        $this->isPostEmpty($_POST);
        $n = M('Imagics');
        $where = $_POST['id'];
        $n -> imgname = $_POST['gallery_title'];
        $result = $n -> where("id = $where")->save();
        if ($result) {
            alertMessage("修改成功");
        } else {
            alertMessage("请检查网络后重试");
        }
    }       

    public function imgEditChange() {
    	$where = $_POST['id'];
    	if ($_FILES['gallery_file']['name'] == "") {

    	} else {
    		$model = M("Imagics");
	        $Realname = $_FILES['gallery_file']['name'];
	        $upload = new \Think\Upload();//实例化上传类
	        $upload -> maxSize = 3145728;//设置上传文件的大小
	        $upload->rootPath  =   './Uploads/'; // 设置附件上传根目录
	        $upload->savePath  =   './File/'; // 设置附件上传（子）目录
	        $upload->saveName = 'time';

	        //上传文件
	        $info = $upload -> upload();
	        if(!$info){
	            //上传错误提示信息
	            alertMessage($upload->getError());
	        } else {
       			$model -> imgadd =$info['gallery_file']['savepath'].$info['gallery_file']['savename'];
       			$result = $model -> where("id = $where") -> save();
       			if ($result) {
       				alertMessage("修改成功！");
       			} else {
       				alertMessage("修改失败");
       			}
	        }
    	}
    	alertMessage("请选择要上传的图片！");
    }

    // 判断post提交的各项数据是否为空
    private function isPostEmpty($type) {
    	foreach ($type as $value) {
    	 	if ($value == "") {
    				alertMessage("请将各项内容填写完整！");
    		}
    	 }
    }

    /**
     * 左上角图片删除功能
     */
    public function imgDelete() {
        $type = $_GET['ty'];
        $id = $_GET['id'];
        $n = M("Imagics");
        $result = $n -> where("id = $id") -> delete();
        if ($result) {
            switch ($type) {
                case 0: $this -> redirect("index_show1");break;
                case 1: $this -> redirect("index_show1");break;
                case 2: $this -> redirect("index_show2");break;
                case 3: $this -> redirect("index_show2");break;
                case 4: $this -> redirect("index_show2");break;
                case 5: $this -> redirect("index_show3");break;
                case 6: $this -> redirect("index_show3");break;
                case 7: $this -> redirect("index_show3");break;
                case 8: $this -> redirect("index_show3");break;
                case 9: $this -> redirect("index_show4");break;
                case 10: $this -> redirect("index_show4");break;
                case 11: $this -> redirect("index_show4");break;
                default: $this -> redirect("index_show1");
            }
        } else {
            $this -> error("删除失败");
        }
    }

    /**
     * 方法功能；展示第二个页面
     */
    public function index_show2(){
        // $Page = new \Think\Page($count, 5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        // $show = $Page->show();// 分页显示输出
        // // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        // $list = $the_notice_model->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->getField('id, infoname, infotime');


        $m = M("Imagics");
        // doquery1是返回左上角图片信息的查询语句
        $doquery1 = "select * from tp_imagics where type = 2";
        $count1 = $m -> where("type = 2") -> count();
        $doquery2 = "select * from tp_imagics where type = 3";
        $count1 = $m -> where(	"type = 3") -> count();
        $doquery3 = "select * from tp_imagics where type = 4";
        $count1 = $m -> where("type = 4") -> count();

        $arr1 = $m -> query($doquery1);
        $arr2 = $m -> query($doquery2);
        $arr3 = $m -> query($doquery3);
        $this->assign("data1", $arr1);
        $this->assign("data2", $arr2);
        $this->assign("data3", $arr3);
        $this -> display();
    }

    public function getPage($type) {
    	$mode = M("Imagics");
    	$count = $mode -> where("type = $type") -> select();
    	$Page = new \Think\Page($count, 20);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;
        $links = $mode -> where("type = $type") -> order("id desc") -> limit($pre.','.$next) -> select();
    }

    /**
     * 方法功能：展示第三个页面
     */
    public function index_show3() {
        $m = M("Imagics");
        // doquery1是返回左上角图片信息的查询语句
        $doquery1 = "select * from tp_imagics where type = 5";
        $doquery2 = "select * from tp_imagics where type = 6";
        $doquery3 = "select * from tp_imagics where type = 7";
        $doquery4 = "select * from tp_imagics where type = 8";
        $arr1 = $m -> query($doquery1);
        $arr2 = $m -> query($doquery2);
        $arr3 = $m -> query($doquery3);
        $arr4 = $m -> query($doquery4);
        $this->assign("data1", $arr1);
        $this->assign("data2", $arr2);
        $this->assign("data3", $arr3);
        $this->assign("data4", $arr4);
        $this -> display();
    }
    public function index_show4() {
        $m = M("Imagics");
        // doquery1是返回左上角图片信息的查询语句
        $doquery1 = "select * from tp_imagics where type = 9";
        $doquery2 = "select * from tp_imagics where type = 10";
        $doquery3 = "select * from tp_imagics where type = 11";
        $arr1 = $m -> query($doquery1);
        $arr2 = $m -> query($doquery2);
        $arr3 = $m -> query($doquery3);
        $this->assign("data1", $arr1);
        $this->assign("data2", $arr2);
        $this->assign("data3", $arr3);
        $this -> display();
    }
    /**
     * 方法功能：添加一个文件
     */
    public function addFile() {
        //设置上传文件类型
        $Realname = $_FILES['gallery_file']['name'];
        $upload = new \Think\Upload();//实例化上传类
        $upload -> maxSize = 3145728;//设置上传文件的大小
        $upload->rootPath  =   './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =   './File/'; // 设置附件上传（子）目录
        $upload->saveName = 'time';

        //上传文件
        $info = $upload -> upload();
        if(!$info){
            //上传错误提示信息
            // $this -> error($upload->getError());
            alertMessage($upload->getError());
        }
        $n = M('Imagics');
        $n -> imgname = $Realname;
        $n -> imgintro = date("Y-m-d");
        $n -> type = $_POST['ty'];
        $n -> imgadd =$info['gallery_file']['savepath'].$info['gallery_file']['savename'];
        $last = $n -> add();
        if($last){
            // $this -> success("添加成功");
            alertMessage("添加成功");
//            $this -> redirect('Index/index','','0','上传成功'); // 进行重定向操作，返回到主页
        }else{
            // $this -> error("上传失败！");
            alertMessage("上传失败");
        }
    }
    // 指向添加通知公告的书写界面
    public function addInfor() {
    	$this -> display();
    }
    // 后台实现添加动作
	public function subInfor(){
		$n = M('Information');
		$n -> Create();  //创建数据对象
		$n -> infortime = date("Y-m-d");
		$n -> uid = 5;		//这个地方设置完登录后要进行修改
		if($_POST['inforname'] == "" || $_POST['inforcnt'] == ""){
			$id = 0;
		}else{
			$id  = $n -> add(); //写入数据库，并且返回result的值进行判断
		}
		if($id){
	        $data = array(
	            'code'=>'0',
	            'id'=>$id
	        );
	        echo json_encode($data);
		}
	}
	// 所有新闻通知的展示
	public function showInfor() {
		$n = M("Information");
		$doquery = "select * from tp_information";
		$arr = $n -> query($doquery);
		$this -> assign('data',$arr);
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
	//新闻通知的修改提交界面
	public function updateInfor() {
		$where = $_GET['id'];
		$n = M('Information');
		$doquery = "select * from tp_information where id = ".$where."";
		$arr = $n -> query($doquery);
		$arred = $arr[0];
		$arred['inforcnt'] = htmlspecialchars_decode($arred['inforcnt']);
		$this -> assign('data',$arred);
		$this -> display();
	}
	// 新闻通知修改方法
	public function doupdateInfor() {
		$where = $_POST['id'];
		$n = M('Information');
		$n -> date = date("Y-m-d");
		$n -> inforname = $_POST['inforname'];
		$n -> inforcnt = $_POST['inforcnt'];
		$result = $n -> where("id = $where") -> save();
		if($result){
            $data = array(
                'code'=>'1',
                'where'=> $where,
            );
            echo json_encode($data);
    	}
	}
	// 新闻通知删除方法
	public function deleteInfor() {
		$where = $_GET['id'];
		$n = M('Information');
		$doquery = "delete from tp_information where id = ".$where."";
		$result = $n -> execute($doquery);
		if($result) {
			$this -> redirect("Index/showInfor");
		} else {
			$this -> error('删除失败！');
		}
	}
	// 左侧图片区域文件上传操作
	public function imgadd () {

		//设置上传文件类型
		$Realname = $_FILES['file']['name'];
		$upload = new \Think\Upload();//实例化上传类
		$upload -> maxSize = 3145728;//设置上传文件的大小
   		$upload->rootPath  =   './Uploads/'; // 设置附件上传根目录
		$upload->savePath  =   './File/'; // 设置附件上传（子）目录
		$upload->saveName = 'time';

		//上传文件
		$info = $upload -> upload();
		if(!$info){
			//上传错误提示信息
			// $this -> error($upload->getError());
			alertMessage($upload->getError());
		}
		$n = M('Imagics');
		$n -> imgname = $_POST['gallery_title'];
		$n -> imgintro = $_POST['gallery_textarea'];
		$n -> type = $_POST['type']; 
		$n -> imgadd =$info['gallery_file']['savepath'].$info['gallery_file']['savename'];
		$last = $n -> add();

		if($last){
			$this -> redirect('Index/index','','0','上传成功'); // 进行重定向操作，返回到主页
		}else{
			$this -> error("上传失败！");
		}
	}

	// 首页链接的增加
	public function addLink() {
		$n = M('Link');
		$n -> Create();
		$result = $n -> add();
		if($result) {
			$this -> success("添加成功");
		} else {
			$this -> error("添加失败");
		}
	}

	// 首页链接修改
	public function subLink() {
		$this->isPostEmpty($_POST);
		// 判断网址是否合法
		if (!isUrl($_POST['linkadd'])) {
			alertMessage("网址格式错误!正确格式为：http://www.baidu.com");
		}
 
		$n = M("Link");
		$n->linkname = $_POST['linkname'];
		$n->linkadd = $_POST['linkadd'];


		$where = $_POST['id'];
		$result = $n->where("id = $where")->save();
		if ($result) {
			alertMessage("修改成功");
		} else {
			alertMessage("修改失败");
		}
	}

	// 首页链接的删除
	public function deleteLink() {
		$where = $_GET['id'];
		$n = M('Link');
		$doquery = "delete from tp_link where id = ".$where."";
		$result = $n -> execute($doquery);
		if($result) {
			$this -> success("删除成功");
		} else {
			$this -> error("删除失败");
		}
	}
	// 首页链接的修改
	public function updateLink() {
		$where = $_GET['id'];
		$n = M("Link");
		$doquery = "update tp_link set linkname = '".$_POST['linkname']."',linkadd = '".$_POST['linkadd']."',type = ".$_POST['type']." where id = ".$where."";
		$result = $n -> execute($doquery);
		if($result) {
			$this -> success("修改成功");
		} else {
			$this -> error("修改失败");
		}
	}

	// 首页中心动态的添加
	public function newsAdd() {
		$this -> display();
	}
	//后台实现中心动态的添加操作
	public function newsDoAdd() {
		$n = M('News');
		$n -> Create();  //创建数据对象
		if($_POST['newtitle'] == "" || $_POST['newcontent'] == "" || $_POST['newauthor'] == "" || $_POST['oldauthor'] == ""){
			$id = 0;
		}else{
			$id  = $n -> add(); //写入数据库，并且返回result的值进行判断
		}
		if($id){
	        $data = array(
	            'code'=>'0',
	            'id'=>$id
	        );
	        echo json_encode($data);
		}
	} 
	// 中心动态的删除操作
	public function newsDelete() {
		$where = $_GET['id'];
		$doquery = "delete from tp_news where id = ".$where."";
		$n = M("News");
		$result = $n -> execute($doquery);
		if($result) {
			$this -> redirect("Index/index");
		} else {
			$this -> error("删除失败");
		}
	}
	// 中心动态的修改操作
	public function newsUpdate() {
		$where = $_GET['id'];
		$n = M('News');
		$doquery = "select * from tp_news where id = ".$where."";
		$arr = $n -> query($doquery);
		$arred = $arr[0];
		$arred['newcontent'] = htmlspecialchars_decode($arred['newcontent']);
		$this -> assign('data',$arred);
		$this -> display();
	}
	// 新闻通知修改方法
	public function newsDoUpdate() {
		$where = $_POST['id'];
		$n = M('News');
		$n -> newtitle = $_POST['newtitle'];
		$n -> newcontent = $_POST['newcontent'];
		$n -> newauthor = $_POST['newauthor'];
		$n -> oldauthor = $_POST['oldauthor'];
		$result = $n -> where("id = $where") -> save();
		if($result){
            $data = array(
                'code'=>'1',
                'where'=> $where,
            );
            echo json_encode($data);
    	}
	}		
	// 查询中心动态的某一条数据
	public function newsOne() {
		$where = $_GET['id'];
		$n = M("News");
		$doquery = "select * from tp_news where id = ".$where."";
		$doquery1 = "UPDATE tp_news set clicknum = clicknum + 1 where id = ".$where."";
		$arr = $n -> query($doquery);
		$arr[0]['newcontent'] = htmlspecialchars_decode($arr[0]['newcontent']);
		$this -> assign('data',$arr[0]);
		$this -> display();
	}

	// 展示新闻通知的页面
	public function index_show5($value='')
	{
		# code...
		$model = new InformationModel();
		$this -> assign("data", $model -> getAllInformation());
		$this -> display();
	}

	// 添加一条通知公告
	public function addOneInformation($value='')
	{
		# code...
		$model = new InformationModel();
		$infor = $this -> isPostNull($_POST);
		if ($model -> addOneInformation($infor)) {
			$data = "success";
		} else {

		}
		echo json_encode($data);
	}

	// 修改一条通知的显示页面
	public function modifyOneInformation($value='')
	{
		# code...
		$model = new InformationModel();
		$this -> assign("data", $model -> getOneInformation($this -> getTheId()));
		$this -> display();
	}

	// 修改一条通知
	public function modifyOneInformationDo($value='')
	{
		# code...
		$model = new InformationModel();
		$info = $this -> isPostNull($_POST);
		if ($model -> modifyOneInformation($info['id'], $info)) {
			$data = "success";
		} else {
			
		}
		echo json_encode($data);
	}

	// 删除一条id
	public function deleteOneInformation($value='')
	{
		# code
		$model = new InformationModel();
		if ($model -> deleteOneInformation($this -> getTheId())) {
			alertMessage("删除成功！");
		} else {
			alertMessage("删除失败！");
		}
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

	// 判断post传值的各项是不是为空
	private function isPostNull($value)
	{
		foreach ($value as $key => $theInformation) {
			if (empty($theInformation)) {
				alertMessage("请将各项填写完整");
			}
		}
		return $value;
	}
}