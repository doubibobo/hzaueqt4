<?php
namespace Home\Controller;
use Think\Controller;
class OtherController extends Controller {    
        public function other_showtow() {
                $this -> display();
        }
        public function other_showthree() {
                $this -> display();
        }
        public function other_showfour()
        {
                $this -> display();
        }

	public function other_show2($type = 2, $value = "教改成果") {
                $m = M("Imagics");
                $count = $m -> where("type = $type") -> count();
                $Page = new \Think\Page($count, 20);
                $show = $Page->show();// 分页显示输出
                $pre = $Page -> firstRow;
                $next = $Page -> listRows;
                $links = $m -> where("type = $type") -> order("id desc") -> limit($pre.','.$next) -> select();
                $this -> assign("data", $links);
                $this -> assign("value", $value);
                $this -> assign("show", $show);
                $this -> display("other_showtow");
	}
	public function other_show3($type = 9, $value = "规章制度") {
                $m = M("Imagics");
                $count = $m -> where("type = $type") -> count();
                $Page = new \Think\Page($count, 20);
                $show = $Page->show();// 分页显示输出
                $pre = $Page -> firstRow;
                $next = $Page -> listRows;
                $links = $m -> where("type = $type") -> order("id desc") -> limit($pre.','.$next) -> select();
                $this -> assign("data", $links);
                $this -> assign("value", $value);
                $this -> assign("show", $show);
                $this -> display("other_showthree");
	}
        public function other_show4($type = 5, $value="实验图库")
        {
                $m = M("Imagics");
                $count = $m -> where("type = $type") -> count();
                $Page = new \Think\Page($count, 20);
                $show = $Page->show();// 分页显示输出
                $pre = $Page -> firstRow;
                $next = $Page -> listRows;
                $links = $m -> where("type = $type") -> order("id desc") -> limit($pre.','.$next) -> select();
                $this -> assign("data", $links);
                $this -> assign("value", $value);
                $this -> assign("show", $show);
                $this -> display("other_showfour");
        }

        // 这里是教改成果的三个页面
        public function other1() {
                $this -> other_show2(2, "教改成果");
        }
        public function other2() {
                $this -> other_show2(3, "科技成果");
        }
        public function other3() {
                $this -> other_show2(4, "其它成果");
        }

        // 这里是美图欣赏的三个页面
        public function beautiful1()
        {
              $this -> other_show4(5, "实验图库");
        }

        public function beautiful2()
        {
              $this -> other_show4(6, "实验瞬间");
        }
        public function beautiful3()
        {
              $this -> other_show4(7, "田间掠影");
        }
        public function beautiful4()
        {
              $this -> other_show4(8, "其他美图");
        }

        public function show1() {
                $this -> other_show3(9, "规章制度");
        }

        public function show2() {
                $this -> other_show3(10, "使用说明");
        }
        public function show3() {
                $this -> other_show3(11, "申请表单");
        }

}
?>