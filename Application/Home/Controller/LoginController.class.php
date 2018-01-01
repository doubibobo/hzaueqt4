<?php
/**
 * Created by PhpStorm.
 * User: doubibobo
 * Date: 17-6-3
 * Time: 下午8:13
 */

namespace Home\Controller;


use Think\Controller;

class LoginController extends Controller
{
    /**
     * 用户登录
     */
    public function index() {

    }

    /**
     * 用户注册
     */
    public function register() {
        $user = D("user");
        $user->create();
        $result = $user->add();
        if($result){
//            $this->assign("jumpUrl","__APP__/index/index");
            $this->success('注册成功！');
        }else{
//            $this->assign("jumpUrl","__APP__/user/register");
            $this->error($user->getError());
        }
    }
}