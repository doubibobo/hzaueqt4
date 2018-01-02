<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-5-23
 * Time: 下午4:50
 */
	namespace Admin\Model;
    use Think\Model\RelationModel;
    class InformationModel extends RelationModel
    {
        // 获得所有的通知公告
        public function getAllInformation($value='')
        {
            $model = M("Information");
            return $model -> select();
        }

        // 获得一条通知公告
        public function getOneInformation($value='')
        {   
            # code...
            $model = M("Information");
            return $model -> where("$value = id") -> find();
        }

        // 删除一条通知公告
        public function deleteOneInformation($value='')
        {
            $model = M("Information");
            return $model -> where("id = $value") -> delete();
        }

        // 修改一条通知公告
        public function modifyOneInformation($value='', $where)
        {
            $model = M("Information");
            $model -> inforname = $where['inforname'];
            $model -> inforcnt = $where['inforcnt'];
            $model -> infortime = date("Y-m-d");
            $model -> uid = 1;
            return $model -> where("id = $value") -> save();
        }

        // 添加一条通告
        public function addOneInformation($value = '')
        {
            $model = M("Information");
            $model -> inforname = $value['inforname'];
            $model -> inforcnt = $value['inforcnt'];
            $model -> infortime = date("Y-m-d");
            $model -> uid = 1;
            return $model -> add();
        }
    }