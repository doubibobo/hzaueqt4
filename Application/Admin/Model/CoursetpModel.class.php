<?php 
	namespace Admin\Model;
    use Think\Model\RelationModel;
    use Think\Model;
    class CoursetpModel extends  RelationModel {
    	// 将表进行关联
    	protected $_link = array(
	        'coursetp' => array(
	            'mapping_type'  => self::HAS_MANY,//定义从属的关系
	            'class_name'    => 'course',
	            'foreign_key'   => 'c_type',//关联的外键名称
	            'mapping_name'  => 'allcourse',//映射的名称，用于查询数据
	        ),
   		);

   		// 得到所有的课程的名称
    	public function getAllCoursetp($type) {
            if ($type == 0) {
                // 如果是试验区课表
            }
    		$mode = M("Coursetp");
    		return $mode -> where("t_type = $type") -> select();
    	}

    	// 增加一条分类
    	public function addCoursetp($value, $type, $theType) {
    		$mode = M("Coursetp");
    		$mode -> t_name = $value;
            $mode -> t_type = $theType;
    		return $mode -> add();
    	}

    	// 删除一条分类
    	public function deleteCoursetp($value) {
    		$mode = D("Coursetp");
            $theMode = M("course");
            $result = $theMode->select();
            $result['c_type'] = 0;
            $theMode -> where("c_type = $value") -> save($result);
    		return $mode -> where("id = $value") -> delete(); 
    	}

        // 找到所有的课程类别
        public function allCoursetp($type) {
            $mode = M("coursetp");
            if ($type == 0 || $type == 1) {
                return $mode -> where("$type = t_type") -> select();
            } else {    
                return $mode -> select();
            }
        }
    }