<?php
	namespace Home\Model;
	use Think\Model\RelationModel;
	use Think\Model;
	class CourseModel extends RelationModel {
		// 添加一门新的课程
		public function addNewCourse ($value, $course) {
			$mode = M("Course");
			$mode -> c_name = $value;
			$mode -> c_type = $course;
			return $mode->add();
		}

		// 获得所有的课程信息
		public function getAllCourse($type, $status) {
			$mode = M("Course");
			if ($type == 0) {
				return $mode -> where("c_type = $type") -> select();
			} else {
				if ($status == 1) {
					return $mode -> where("t_status = $status and c_type != 0") -> select();
				} else {
					return $mode -> where("c_type != 0") -> select();
				}
			}
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
	}