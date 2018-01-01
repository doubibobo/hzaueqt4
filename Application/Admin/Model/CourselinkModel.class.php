<?php
	namespace Admin\Model;
	use Think\Model\RelationModel;
	use Think\Model;
	class CourselinkModel extends RelationModel {
		// 关联表
		protected $_link = array(
			'coursers' => array(
				'mapping_type'  => self::BELONGS_TO,//定义从属的关系
	            'class_name'    => 'course',
	            'foreign_key'   => 'cid',//关联的外键名称
	            'mapping_name'  => 'allLink',//
				),
			);

		// 计算视频的总数
		public function allCount($id) {
			$mode = M("Courselink");
			return $mode -> where("cid = $id") -> count();
		}

		// 添加视频
		public function addCourseLink($id, $theName, $theAdd) {
			$Realname = $_FILES['gallery_file']['name'];
	        $upload = new \Think\Upload();//实例化上传类
	        $upload -> maxSize = 3145728;//设置上传文件的大小
	        $upload->rootPath  =   './Uploads/'; // 设置附件上传根目录
	        $upload->savePath  =   './CoursersLink/'; // 设置附件上传（子）目录
	        $upload->saveName = 'time';
	        $info = $upload -> upload();
	        if(!$info){
	            //上传错误提示信息
	            alertMessage($upload->getError());
	        }
			$mode = M("Courselink");
			$mode -> cid = $id;
			$mode -> linkname = $theName;
			$mode -> linkadd = $theAdd;
			$mode -> linkbook = $info['gallery_file']['savepath'].$info['gallery_file']['savename'];
			return $mode -> add();
		}

		// 查询所有视频
		public function selectAllLink($id, $pre, $next) {
			$mode = M("Courselink");
			return $mode->where("cid = $id")->order('id desc')->limit($pre.','.$next)->select(); 
		}

		// 修改某个视频
		public function subCourseLink($id) {

		}

		//删除某个视频
		public function deleteAcoursers($id) {
			$mode = M("Courselink");
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			return $mode -> where("id = $id") -> delete();
		}	
	}