<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-5-23
 * Time: 下午4:37
 */
namespace Home\Model;
use Think\Model\RelationModel;
class TeamModel extends RelationModel{
    protected $_link = array(
        'teamitems' => array(
            'mapping_type'  => self::HAS_MANY,//定义从属的关系
            'class_name'    => 'teamitems',
            'foreign_key'   => 'idt',//关联的外键名称
            'mapping_name'  => 'teamitems',//映射的名称，用于查询数据
        ),
    );
}
?>