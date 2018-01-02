<?php
	namespace Admin\Model;
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
		// 增加一条任务
		public function addTask($value, $id, $name, $type = 0) {
			# code...
			$mode = M("Coursetask");
			$mode -> cct = $value;
			$mode -> cid = $id;
			$mode -> cctname = $name;
			$mode -> cctdate = date("Y-m-d");
			$mode -> type = $type;
			return $mode -> add();
		}

		// 修改一条任务
		public function submitTask($value, $id, $name) {
			# code...
			$mode = M("Coursetask");
			$mode -> cct = $value;
			$mode -> cctname = $name;
			return $mode -> where("id = $id") -> save();
		}

		// 查询所有的任务
		public function getAllTask($cid, $value = 0) {
			$mode = M("Coursetask");
			return $mode -> where("cid = $cid and type = $value") -> select();
		}

		// 查询一条任务
		public function getATask($id) {
			$mode = M("Coursetask");
			return $mode -> where("id = $id") -> find();
		}
	}