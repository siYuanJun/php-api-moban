<?php
/**
 * 伪路由文件
 * @author siYuan
 */

$root = dirname(__FILE__); // To configure
require_once "{$root}/config/function.php";

$jsondata = array(
    "status" => 'error', //状态码
    "msg" => 'error', //提示
);

$app = filterbadstring(getapk("app")); // 文件夹名称
$c = filterbadstring(getapk("c")); // 控制器名称
$a = filterbadstring(getapk("a")); // 方法名称

if (empty($c)) {
    $c = "index"; // 控制器名称
}

$c = $c . "Controller";

if (empty($a)) {
    $a = "index"; // 方法名称
}

$cfile = "{$root}/controllers/{$c}.php";

if (file_exists($cfile)) { // 判断控制器文件是否为空
    require $cfile;
    $api = new $c;
    if (method_exists($api, $a)) { //判断当前方法是否为空
        $api->$a();
    } else {
        $jsondata['msg'] = "method not exists";
        json($jsondata);
    }
} else {
    $jsondata['msg'] = "api not exists";
    json($jsondata);
}