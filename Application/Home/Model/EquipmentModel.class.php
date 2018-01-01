<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-5-23
 * Time: 下午4:50
 */
	namespace Home\Model;
    use Think\Model\RelationModel;
    class EquipmentModel extends RelationModel
    {
        // 获取所有的设施设备
        public function getAllEquipment($value)
        {   
            $model = M("Equipment");
            return $model -> select();
        }

        // 获取某一类的仪器设备
        public function getOneClassEquipment($value)
        {
            $model = M("Equipment");
            return $model -> where("$value = eqclass") -> select();
        }

        // 获取某一个仪器设备
        public function getOneEquipment($value)
        {
            $model = M("Equipment");
            return $model -> where("id = $value") -> find();
        }
    }