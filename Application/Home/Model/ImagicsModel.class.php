<?php
	namespace Home\Model;
	use Think\Model\RelationModel;
	use Think\Model;
	class ImagicsModel extends RelationModel {
		// 得到一门课程的信息
		public function getOneImagics($value) {
			$mode = D("Imagics");
			return $mode->where("id = $value and type = 0")->find();
		}
	}