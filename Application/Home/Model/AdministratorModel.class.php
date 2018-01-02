<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-5-23
 * Time: 下午4:50
 */
	namespace Home\Model;
    use Think\Model\RelationModel;
    class AdministratorModel extends RelationModel
    {
        //将两个表进行关联
        protected $_link = array(
            'Administrator' => array(
                'mapping_type' => self::BELONGS_TO,//定义从属的关系
                'class_name' => 'Admistrator_type',
                'foreign_key' => 'type',//关联的外键名称
                'mapping_name' => 'all',//映射的名称，用于查询数据
            ),
        );
    }