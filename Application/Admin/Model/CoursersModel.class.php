<?php
	namespace Admin\Model;
	use Think\Model\RelationModel;
	use Think\Model;
	class CoursersModel extends RelationModel {
		// 关联表
		protected $_link = array(
			'coursers' => array(
				'mapping_type'  => self::BELONGS_TO,//定义从属的关系
	            'class_name'    => 'course',
	            'foreign_key'   => 'cid',//关联的外键名称
	            'mapping_name'  => 'allResource',//
				),
			);

		// 添加课件
		public function addACourseResource($id, $type = 0) {
			$Realname = $_FILES['gallery_file']['name'];
	        $upload = new \Think\Upload();//实例化上传类
	        $upload -> maxSize = 3145728;//设置上传文件的大小
	        $upload->rootPath  =   './Uploads/'; // 设置附件上传根目录
	        $upload->savePath  =   './Coursers/'; // 设置附件上传（子）目录
	        $upload->saveName = 'time';
	        $info = $upload -> upload();
	        if(!$info){
	            //上传错误提示信息
	            alertMessage($upload->getError());
	        }
			$mode = M("Coursers");
			$mode -> cid = $id;
			$mode -> rsname = $Realname;
			$mode -> rsadd = $info['gallery_file']['savepath'].$info['gallery_file']['savename'];
			$mode -> rsdate = date("Y-m-d");
			$mode -> type = $type;
			return $mode -> add();
		}

		// 查询所有课件
		public function getAllCourse($id, $pre, $next, $type = 0) {
			$mode = M("Coursers");
			return $mode->where("cid = $id and type = $type")->order('id desc')->limit($pre.','.$next)->select(); 
		}

		//删除某个课件
		public function deleteAcoursers($id) {
			$mode = M("Coursers");
			return $mode -> where("id = $id") -> delete();
		}	
	}