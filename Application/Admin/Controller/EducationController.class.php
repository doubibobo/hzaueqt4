<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\CoursetaskModel;
use Admin\Model\CourselinkModel;
use Admin\Model\CoursetpModel;
use Admin\Model\CoursersModel;
use Admin\Model\CourseModel;
class EducationController extends Controller {
    private $R_TYPE;
    private $FIRSTINFOR = 0;
    private $result = array();
    private $allCourse = array();
    private $allType = array();

    public function _initialize(){
      if(!isset($_SESSION['username']) || $_SESSION['username'] == ''){
        $this -> redirect("/Admin/Login");
      }
    }

    /**
     * @param $type
     * @param $order
     * 方法功能：根据参数给定的条件查询表中的数据
     */
    private function getData($type, $order) {
        $n = M("Regulations");
        $query = "select * from tp_regulations where r_type = ".$type." ORDER BY ".$order." desc";
        $this->result = $n -> query($query);
    }

    /**
     * 方法功能：展示二级页面：教学动态
     */
	public function education_show1(){
        $this->R_TYPE = 4;
        self::getData($this->R_TYPE, 'id');
        $this->assign("data", $this->result);
		$this -> display();
	}

    /**
     * 方法功能：修改二级页面：教学动态
     */
	public function education_show1_update(){
	    $where = $_GET['id'];
        $n = M("Regulations");
        $QUERY = "SELECT * FROM tp_regulations WHERE id =".$where."";
        $allResults = $n -> query($QUERY);
        if ($allResults) {
            $this->assign("data", $allResults[$this->FIRSTINFOR]);
        } else {
            $this->error("有错误！");
        }
		$this -> display();
	}

	public function education_show1_delete() {
        $where = $_GET['id'];
        $n = M("Regulations");
        $QUERY = "DELETE FROM tp_regulations WHERE id =".$where."";
        $allResults = $n -> execute($QUERY);
        if ($allResults) {
            $this -> redirect('education_show1');
        } else {
            $this->error("删除失败！");
        }
    }
    /**
     * 方法功能：展示二级页面：教学动态
     */
	public function education_show2() {
        $this->R_TYPE = 3;
        self::getData($this->R_TYPE, 'id');
        $this->assign("data", $this->result[$this->FIRSTINFOR]);
        $this->display();
    }

    /**
     * 方法功能：查询符合条件的所有课程
     */
    private function findAllCourse($ty) {
        $m = M("Coursetp");
        $the = "SELECT id FROM tp_coursetp WHERE t_type = ".$ty."";
        $all = $m->query($the);
        $all = array_column($all, "id");
        if (!empty($all)) {
            $query = "SELECT * FROM tp_course WHERE c_type IN (".implode(',', $all).")";
        } else {
            $query = "SELECT * FROM tp_course WHERE  c_type = 0";
        }
	    $k = M("Course");
	    $this-> allCourse = $k -> query($query);
    }

    /**
     * @param $ty
     * 方法功能：查询某一大类中的所有小类别
     */
    private function findAllCourseTy($ty) {
        $k = M("Coursetp");
        $this->allType = $k -> where("t_type = $ty") -> select();
    }

    /**
     * 方法功能：添加一个课程类别
     */
    public function addCourseTy() {
        $hahah = $_POST['hahah'];
        $m = M("Coursetp");
        $data['t_name'] = $_POST['courseName'];
        $data['t_type'] = $_POST['ty'];
        $result = $m -> add($data);
        if ($result) {
            switch ($hahah) {
                case 0: $this->redirect("education_show3_one"); break;
                case 1: $this->redirect("education_show3_two"); break;
                default: $this->redirect("education_show3_one");
            }
        } else {
            $this->error("添加失败");
        }
    }
    /**
     * 方法功能：添加某个类别下的课程
     */
    public function addCourse() {
        $m = M("Course");
        $data['c_type'] = $_POST['ct'];
        $data['c_name'] = $_POST['gallery_title'];
        $data['ccnt'] = htmlspecialchars_decode($_POST['content']);
        $result = $m -> add($data);
        if($result){
            $data = array(
                'code'=>'0',
                'id'=>$result
            );
            echo json_encode($data);
        }
    }

    /**
     * 方法功能：删除一个类别，并且删除这个类别下的所有课目
     */
    public function deleteTheType() {
        $where = $_GET['id'];
        $m = M("Coursetp");
        $result = $m -> where("id = $where") -> delete();
        if ($result) {
//            $this -> redirect("education_show3_one");
            echo "<script>alert('操作成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        } else {
            $this -> error("删除失败");
        }
    }

    /**
     * 方法功能：删除某一个具体的课程
     */
    public function deleteACourse() {
        $where = $_GET['id'];
        $m = M("Course");
        $result = $m -> where("id = $where") -> delete();
        if ($result) {
//            $this -> redirect("education_show3_one");
            echo "<script>alert('操作成功');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
        } else {
            $this -> error("删除失败");
        }
    }

    // 这里是试验区课表
	public function education_show3_one(){
        // self::findAllCourse(0);
        // self::findAllCourseTy(0);
        // $this -> assign("data1", $this->allType);
        // $this -> assign("data", $this->allCourse);
		// $this -> display();
                // 找到所有的课程的类别
        $model = new CoursetpModel();
        $this -> assign("allCoursetp", $model -> allCoursetp(0));
        $this -> education_show41(0);
        $this -> assign("data", "试验区课表");
        $this -> display('education_show41');
	}
	public function education_show3_two(){
        // self::findAllCourse(1);
        // self::findAllCourseTy(1);
        // $this -> assign("data1", $this->allType);
        // $this -> assign("data", $this->allCourse);
        // $this -> display();
                // 找到所有的课程的类别
        $model = new CoursetpModel();
        $this -> assign("allCoursetp", $model -> allCoursetp(1));
        $this -> education_show41(1);
        $this -> assign("data", "课程课表");
        $this -> display('education_show41');
	}

    /**
     * 方法功能：跳转到修改页面
     */
	public function education_show3_one_update(){
	    $where = $_GET['id'];
	    $m = M("Course");
	    $arr = $m -> where("id = $where") -> select();
	    $this -> assign("data", $arr[0]);
		$this -> display();
	}

    /**
     * 方法功能：执行修改命令
     */
	public function education_show3_one_updateDo() {
        $where = $_POST['id'];
        $m = M("Course");
        $m -> ccnt = htmlspecialchars_decode($_POST['content']);
        $result = $m -> where("id = $where") -> save();
        if($result){
            $data = array(
                'code'=>'1',
                'where'=> $where,
            );
            echo json_encode($data);
        }
    }
	public function education_show3_two_update(){
		$this -> display();
	}

    private function education_show41($type, $status) {
        $model = new CoursetpModel();
        $courseModel = new CourseModel();
        // $type表示类别的名称，其中，0表示试验区课表，非0表示课程课表
        $this -> assign("allCoursetType", $model->getAllCoursetp($type));
        $this -> assign("allCourse", $courseModel->getAllCourse($type));
    }

    // $status 表示课程状态，0表示没有授课，1表示在授
	public function education_show4(){
        // $this -> education_show41(1, 1);
        $modelhahaha = new CourseModel();
        $this -> assign("allmanyCourse", $modelhahaha -> getManyCourse());
        // 找到所有的课程的类别
        $model = new CoursetpModel();
        $this -> assign("allCoursetp", $model -> allCoursetp(3));
        $this -> assign("data", "在授课程");
		$this -> display('education_show41');
	}

    // 增加一个课程的大类(课程课表)
    public function addCoursetp() {
        // 首先判断名称是不是为空
        if (empty($_POST['coursename'])) {
            alertMessage("请填写分类名称！");
        }
        // 增加一条数据
        $model = new CoursetpModel();
        if ($model->addCoursetp($_POST['coursename'], $_POST['theType'], $_POST['coursetp'])) {
            alertMessage("增加分类成功！");
        } else {
            alertMessage("请检查网络之后重试");
        }
    }

    // 删除一条分类
    public function deleteCoursetp() {
        // 首先进行类型的判断
        $id = getValue();
        if ($id) { 
            $mode = new CoursetpModel();
            if ($mode->deleteCoursetp($id)) {
                alertMessage("删除大类成功！");
            } else {
                alertMessage("请检查网络之后重试！");
            }
        } else {
            alertMessage("请求有误！");
        }
    }

    // 添加一门在售课程
    public function addACourse() {
        // 首先判断课程名是不是空
        if (empty($_POST['coursename'])) {
            alertMessage("课程名不能为空！");
        } else {
            $model = new CourseModel();
            if ($model -> addNewCourse($_POST['coursename'], $_POST['theType'], $_POST['coursetp'], $_POST['courseStatus'])) {
                alertMessage("课程添加成功！");
            } else {
                alertMessage("请检查网络之后重试！");
            }
        }
    }

    // 详细展示一门课程
	public function education_show4_1(){
        // 首先获取值
        $this -> doEducationShow("ccnt", "教学大纲");
		$this -> display("education_show4_all");
	}

    public function education_show4_all() {
        $this->show();
    }

    // 为课程添加教学大纲、课程课表、教学日历、主题交流等
    public function courseTeachAdd() {
        $mode = new CourseModel();
        switch (I('post.name')) {
            case "教学大纲":
                # code...
                $data = $mode -> changeOneCourse("ccnt", htmlspecialchars_decode(I('post.content')), I('post.id'));
                break;
            case "课程课表":
                # code...
                $data = $mode -> changeOneCourse("coursetable", htmlspecialchars_decode(I('post.content')), I('post.id'));
                break;
            case "教学日历":
                # code...
                $data = $mode -> changeOneCourse("coursedate", htmlspecialchars_decode(I('post.content')), I('post.id'));
                break;
            case "主题交流":
                # code...
                $data = $mode -> changeOneCourse("coursetheme", htmlspecialchars_decode(I('post.content')), I('post.id'));
                break;
            default:
                # code...
                alertMessage("信息错误！");
                break;
        }
        if ($data) {
            $data = "修改成功";
        } else {
            $data="修改失败";
        }
        echo json_encode($data);

    }

    // 删除一门课程
    public function deleteCourse() {
        $id = getValue();
        $courseModel = new CourseModel();
        if ($courseModel->deleteOneCourse($id)) {
            alertMessage("删除课程成功！");
        } else {
            alertMessage("删除课程失败！");
        }
    }

	public function education_show4_2(){
        $this -> doEducationShow("coursetable", "课程课表");
		$this -> display("education_show4_all");
	}
	public function education_show4_3(){
        $this -> doEducationShow("coursedate", "教学日历");
		// $this -> display('education_show4_all');
        $model = new CoursetaskModel();
        $this -> assign("AcourseAllRs", $model -> getAllTask(getValue(), 1));
        $this -> display();
	}
	public function education_show4_4(){
        $this -> doEducationShow("Coursers", "教材课件");
        $this -> getACourseAllRs();
		$this -> display();
	} 
    
    // 获得一门课程的所有课件信息
    public function getACourseAllRs() {
        $id = getValue();
        $mode = new CoursersModel();
        $this -> assign("AcourseAllRs", $mode -> getAllCourse($id));
    }
    //添加一门课程资源
    public function addCourseRs() {
        // 首先判断是否有文件上传！
        if (empty($_FILES['gallery_file']['name'])) {
            alertMessage("请选择上传的文件！");
        } else {
            $mode = new CoursersModel();
            if ($mode -> addACourseResource(I('post.theId'))) {
                alertMessage("文件上传成功！");
            } else {
                alertMessage("请检查网络之后重试！");
            }
        }
    }

    public function deleteACourseRS() {
        $mode = new CoursersModel();
        if ($mode -> deleteAcoursers(getValue())) {
            alertMessage("删除成功！");
        } else {
            alertMessage("删除失败！");
        }
    }

	public function education_show4_5(){
        $mode = new CourselinkModel();
        $id = getValue();
        $Page = new \Think\Page($mode -> allCount($id), 10);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;
        $this -> assign("allVideo", $mode -> selectAllLink($id, $pre, $next));
        $this -> assign("show", $show);
        $this -> doEducationShow();
		$this -> display();
	}

    public function deleteLink() {
        $mode = new CourselinkModel();
        if ($mode -> deleteAcoursers(getValue())) {
            alertMessage("删除成功！");
        } else {
            alertMessage("删除失败！");
        }
    }

    public function doAddEducationLink() {
        if (empty($_POST['linkname']) || empty($_POST['linkadd']) || empty($_FILES['gallery_file']['name']) || !isUrl($_POST['linkadd'])) {
            alertMessage("请输入完整且正确的的信息！");
        }

        if (empty($_POST['uploads'])) {
            alertMessage("您可能是一个假黑客，哈哈哈");
        } else {
            $mode = new CourselinkModel();
            if ($mode -> addCourseLink(I('post.id'), I('post.linkname'), I('post.linkadd'))) {
                alertMessage("视频添加成功！");
            } else {
                alertMessage("请检查网络之后重试！");
            }
        }
    }   

	public function education_show4_6(){
        $this -> doEducationShow();
        $this -> getAllTask();
		$this -> display();
	}

    public function addTask() {
        $mode = new CoursetaskModel();
        // if ($_POST['content'] || $_POST['cid'] || $_POST['name']) {
        //     alertMessage("请输入完整的信息！");
        // }
        if ($mode -> addTask(htmlspecialchars_decode(I('post.content')), I('post.cid'), I('post.name'))) {
            // alertMessage("添加成功！");
            $data = "添加成功！";
        } else {
            $data = "请检查网络之后重试！";
        }
        echo json_encode($data);
    }

    public function addCa() {
        $mode = new CoursetaskModel();
        // if ($_POST['content'] || $_POST['cid'] || $_POST['name']) {
        //     alertMessage("请输入完整的信息！");
        // }
        if ($mode -> addTask(htmlspecialchars_decode(I('post.content')), I('post.cid'), I('post.name'), 1)) {
            // alertMessage("添加成功！");
            $data = "添加成功！";
        } else {
            $data = "请检查网络之后重试！";
        }
        echo json_encode($data);
    }

    public function getAllTask($value) {
        # code...
        // 查询所有的任务详情
        $mode = new CoursetaskModel();
        $id = getValue();
        // exit();
        $this -> assign("allTask", $mode -> getAllTask(getValue()));
    }

	public function education_show4_6_update(){
        $mode = new CoursetaskModel();
        $id = $_GET['cid'];
        $this -> assign("theData", $mode -> getATask($id));
        $this -> doEducationShow();
		$this -> display();
	}
    public function education_show4_7_update(){
        $mode = new CoursetaskModel();
        $id = $_GET['cid'];
        $this -> assign("theData", $mode -> getATask($id));
        $this -> doEducationShow();
        $this -> display();
    }
    public function doUpdateTask() {
        $mode = new CoursetaskModel();
        if ($mode ->submitTask(htmlspecialchars_decode(I('post.content')), I('post.cid'), I('post.name'))) {
            $data = "添加成功！";
        } else {
            $data = "请检查网络之后重试！";
        }
        echo json_encode($data);
    }
	public function education_show4_7(){
        $this -> doEducationShow("coursetheme", "主题交流");
		$this -> display('education_show4_all');
	}

    // 单个课程介绍的方法
    private function doEducationShow($data, $name) {
        # code...
        $id = getValue();
        $courseModel = new CourseModel();
        $result = $courseModel -> getOneCourse($id);
        $this -> assign("course", $result[$data]);
        $this -> assign("id", $result['id']);
        $this -> assign("cname", $result['c_name']);
        $this -> assign("name", $name);
    }

    // 与课程相关的提示信息
    private function courseAlert() {
        if (empty($this->oneCourse)) {
            alertMessage("错误，你可能是一个黑客级别的人物！");
        }
    }

    /**
     * 方法功能：更改动态方法1
     */
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

    /**
     * 方法功能：更改动态方法2
     */
    public function aboutDoUpdate1() {
        $where = $_POST['id'];
        $n = M('Regulations');
        $n -> r_content = htmlspecialchars_decode($_POST['content']);
        $n -> r_name = $_POST['gallery_title'];
        $n -> r_time = date("Y-m-d");
        $result = $n -> where("id = $where") -> save();
        if($result){
            $data = array(
                'code'=>'1',
                'where'=> $where,
            );
            echo json_encode($data);
        }
    }

    /**
     * 方法功能：添加一条动态
     */
    public function subInfor(){
	    $type = $_GET['at'];
        $n = M('Regulations');
        $n -> r_type = $type;
        $n -> r_time = date("Y-m-d");
        $n -> r_name = $_POST['gallery_title'];
        $n -> r_content = htmlspecialchars_decode($_POST['content']);
        $id  = $n -> add(); //写入数据库，并且返回result的值进行判断
        if($id){
            $data = array(
                'code'=>'0',
                'id'=>$id
            );
            echo json_encode($data);
        }
    }

    // 存储存储某一门课程的相关信息
    protected $oneCourse = array();
}