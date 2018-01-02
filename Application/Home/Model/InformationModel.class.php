<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-5-23
 * Time: 下午4:50
 */
	namespace Home\Model;
    use Think\Model\RelationModel;
    class InformationModel extends RelationModel
    {
        // 获得所有的通知公告
        public function getAllInformation($id, $pre, $next) {
            $mode = M("Information");
            return $mode->order('id desc')->limit($pre.','.$next)->select(); 
        }

        // 获得一条通知公告
        public function getOneInformation($value='')
        {   
            # code...
            $model = M("Information");
            return $model -> where("$value = id") -> find();
        }

        // 获得通知公告的总数
        public function getInformationCount($value='')
        {
            $mode = M("Information");
            return $mode -> count();
        }
    }