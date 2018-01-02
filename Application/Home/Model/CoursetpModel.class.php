<?php
	namespace Home\Model;
    use Think\Model\RelationModel;
    class CoursetpModel extends RelationModel
    {
        //将两个表进行关联
        protected $_link = array(
            'Coursetp' => array(
                'mapping_type' => self::HAS_MANY,//定义从属的关系
                'class_name' => 'course',
                'foreign_key' => 'c_type',//关联的外键名称
                'mapping_name' => 'allCourses',//映射的名称，用于查询数据
            ),
        );
    }