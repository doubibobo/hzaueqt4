<?php
	namespace Home\Model;
	use Think\Model\RelationModel;
	use Think\Model;
	class CoursetaskModel extends RelationModel {
		// 关联表
		protected $_link = array(
			'coursers' => array(
				'mapping_type'  => self::BELONGS_TO,//定义从属的关系
	            'class_name'    => 'course',
	            'foreign_key'   => 'cid',//关联的外键名称
	            'mapping_name'  => 'allResource',//
				),
			);

		// 查询所有的任务
		public function getAllTask($id, $pre, $next, $type = 0) {
			$mode = M("Coursetask");
			return $mode->where("cid = $id and type = $type")->order('id desc')->limit($pre.','.$next)->select(); 
		}

		// 查看某个课程下面对应的课件的数目
		public function allCount($id, $type = 0) {
			$mode = M("Coursetask");
			return $mode -> where("cid = $id and type = $type") -> count();
		}

		// 查询一条任务
		public function getATask($id) {
			$mode = M("Coursetask");
			return $mode -> where("id = $id") -> find();
		}
	}