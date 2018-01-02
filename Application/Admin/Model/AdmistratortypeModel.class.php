<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-5-23
 * Time: 下午4:37
 */
namespace Admin\Model;
use Think\Model\RelationModel;
class AdmistratortypeModel extends RelationModel{
    protected $_link = array(
        'Admistrator' => array(
            'mapping_type'  => self::HAS_MANY,//定义从属的关系
            'class_name'    => 'Administrator',
            'foreign_key'   => 'type',//关联的外键名称
            'mapping_name'  => 'administrator',//映射的名称，用于查询数据
        ),
    );
}
?>