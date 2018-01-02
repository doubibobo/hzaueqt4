<?php
namespace Home\Controller;
use Home\Model\CourseModel;
use Home\Model\CoursersModel;
use Home\Model\CourselinkModel;
use Home\Model\CoursetaskModel;
use Think\Controller;
class CourseController extends Controller {
	public function course() {
		$id = getValue();
		$mode = new CourseModel();
		$linkMode = new CoursetaskModel();

		$this -> assign("aCourseTask", $linkMode -> getATask($_GET['cid']));
		$this -> assign("oneCourse", $mode -> getOneCourse($id));
		$this -> display();
	}

	public function course_show1() {
		$mode = new CourseModel();
		$this -> assign("oneCourse", $mode -> getOneCourse(getValue()));
		$this -> display();
	}
	public function course_show2() {
		$mode = new CourseModel();
		$this -> assign("oneCourse", $mode -> getOneCourse(getValue()));
		$this -> display();
	}
	public function course_show3() {
		$id = getValue();
		$mode = new CourseModel();
		$courseRsModel = new CoursersModel();

		$Page = new \Think\Page($courseRsModel -> allCount($id), 20);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;

		$this -> assign("oneCourse", $mode -> getOneCourse($id));
		$this -> assign("allCorusers", $courseRsModel -> getAllCourse($id, $pre, $next));
		$this -> assign("show", $show);
		$this -> display();
	}

	public function education_show3_article(){
		$id = getValue();

		$model = new CoursersModel();
		$theRecord = $model -> findOne($id);
        $pdfWay = $theRecord['rsadd'];
        $pdfWay1=explode('.',$pdfWay);//om 负数从结尾开始取
        // $pdfWay = "./Uploads".$pdfWay;
        $frist = substr($pdfWay, 1, strlen($pdfWay));
        // var_dump($frist);
        // var_dump($pdfWay);
        // var_dump($pdfWay1);

        $theRealWay = $pdfWay1[1].'.pdf';
        tranOffice("./Uploads".$frist);
        $this->assign("data", $theRecord);
        $this->assign("theRealWay", $theRealWay);
        $this -> display();
	}

	public function course_show4() {
		$mode = new CourseModel();
		$linkMode = new CourselinkModel();
     	$id = getValue();
        $Page = new \Think\Page($linkMode -> allCount($id), 6);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;
        $this -> assign("allVideo", $linkMode -> selectAllLink($id, $pre, $next));
        $this -> assign("show", $show);
		$this -> assign("oneCourse", $mode -> getOneCourse($id));	
		$this -> display();
	}
	public function course_show5() {
		$mode = new CourseModel();
		$taskMode = new CoursetaskModel();
		$id = getValue();
		$Page = new \Think\Page($taskMode -> allCount($id), 18);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;	

        $this -> assign("allVideo", $taskMode -> getAllTask($id, $pre, $next));
		$this -> assign("oneCourse", $mode -> getOneCourse($id));
		$this -> assign("show", $show);
		$this -> display();
	}
	public function course_show6() {
		$mode = new CourseModel();
		$this -> assign("oneCourse", $mode -> getOneCourse(getValue()));
		$this -> display();
	} 
	public function course_show7() {
		$mode = new CourseModel();
		$taskMode = new CoursetaskModel();
		$id = getValue();
		$Page = new \Think\Page($taskMode -> allCount($id, 1), 18);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;	

        $this -> assign("allVideo", $taskMode -> getAllTask($id, $pre, $next, 1));
		$this -> assign("oneCourse", $mode -> getOneCourse($id));
		$this -> assign("show", $show);
		$this -> display();
	} 
}
?>