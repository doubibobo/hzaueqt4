<?php
namespace Home\Controller;
use Think\Controller;
class SearchController extends Controller {
	private $theMap;
    public function glo_search($value='')
    {
        if ($_POST['find'] == "") {
        	$filter = "";
        } else {
        	$filter = $_POST['find'];
        }
        $this -> theMap = $filter;
        $model = M("Regulations");
        $condition['r_name'] = array('like', "%".$this -> theMap."%");
        $count = $model -> where($condition) -> count();
        $Page = new \Think\Page($count, 18);
        $show = $Page->show();// 分页显示输出
        $pre = $Page -> firstRow;
        $next = $Page -> listRows;
        $links = $model -> where($condition) -> order("r_time desc") -> limit($pre.','.$next) -> select();
        $this -> assign("data", $links);
        $this -> assign("show", $show);
        $this -> display();
    }
    public function search_article($value='')
    {   
        $where = $_GET['id'];
        $model = M("Regulations");
        $data = $model -> where("id = $where") -> find();
        $this -> assign("data", $data);
        $this -> display();
    }
}
?>