<?php
/**
 * Created by PhpStorm.
 * User: zhuch
 * Date: 2017/8/8
 * Time: 15:41
 */

// 进行文件转换，将office等文件转化为pdf格式
function tranOffice($input_file,$type="pdf"){
    // 首先设置文件的编码
    // var_dump($input_file);
    $input_file=iconv("utf-8", "gb2312", $input_file);
    $out_file=substr($input_file, 0,strrpos($input_file, "."));
    if($type!=="pdf")    
        $out_file=$out_file.'.html';
    else 
        $out_file=$out_file.'.pdf';
    $file="java -jar ./ThinkPHP/Library/Vendor/jodconverter-2.2.2/lib/jodconverter-cli-2.2.2.jar "."./"."$input_file"." ./"."$out_file";  
    // 调用系统命令
    $status=exec($file);
}

// 获得使用get方式传递的id值
function getValue() {
    if (is_numeric($_GET['id']) && is_int($_GET['id']+0)) {
        return $_GET['id'];
    } else {
        return 0;
    }
}

// 判断某个字符串是否为url
function isUrl($url) {
    if (preg_match('/^^((https|http|ftp|rtsp|mms)?:\/\/)[^\s]+$/', $url, $matches)) {
        return true;
    } else {
        return false;
    }
}

// 判断表单是否是通过点击修改提交的内容
function isFormSubmit() {
    if (!isset($_POST['submithahah'])) {
        echo "<script>alert('你可能是个加黑客，哈哈哈'); window.location.href=document.referrer; </script>";
    }
}

// 弹出提示信息
function alertMessage($message) {
    echo "<script>alert(\"$message\"); window.location.href=document.referrer; </script>";
    exit();
}

// 使用正则表达式判断邮箱格式是否合法
function isEmailValid($email) {
    if (preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i', $email)) {
        return true;
    }
    return false;
}

// 验证手机号码是否合法
function isPhoneValid($phone) {
    if (preg_match('/^\d{7,11}$/', $phone)) {
        return true;
    }
    return false;
}

// 判断用户名是否合法
function isUsernameValid($username) {
    if(preg_match('/^[a-zA-Z\d_]{3,50}$/i', $username))
    {
        return true;
    }
    return false;
}

// 使用正则表达式验证密码是否由大小写字母以及数字组成
function isPwdValid($pwd) {
    if (preg_match("/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,10}$/", $pwd)) {
        return true;
    } else {
        return false;
    }
}

