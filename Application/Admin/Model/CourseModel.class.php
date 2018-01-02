<?php
	namespace Admin\Model;
	use Think\Model\RelationModel;
	use Think\Model;
	class CourseModel extends RelationModel {
		// 添加一门新的课程
		public function addNewCourse ($value, $course, $type, $status) {
			$mode = M("Course");
			$mode -> c_name = $value;
			$mode -> c_type = $type;
			$mode -> t_status = $status;
			return $mode->add();
		}

		// 获得所有的课程信息
		public function getAllCourse($type) {
			$mode = D("Coursetp");
			return $mode -> where("t_type = $type") -> relation(true) -> select();
		}

		// 得到一门课程的信息
		public function getOneCourse($value) {
			$mode = D("Course");
			return $mode->where("id = $value")->relation(true)->find();
		}

		// 删除一门课程的信息
		public function deleteOneCourse($value) {
			$mode = D("Course");
			return $mode->where("id = $value")->relation(true)->delete();
		}

		// 修改一门课程的教学大纲、教学日历、主题交流信息等
		public function changeOneCourse($idName, $idData, $id) {
			$mode = M("Course");
			$mode -> $idName = $idData;
			return $mode -> where("id = $id") -> save();
		}

		// 查询所的课程信息
		public function getManyCourse() {
			$mode = D("Course");
			return $mode -> where("t_status = 1") -> select();
		}
	}