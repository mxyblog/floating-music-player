<?php

/**
 * author: lovefc
 * maintain:小雨啊
 */
set_time_limit(0);

header('Access-Control-Allow-Origin:*');

header('Access-Control-Allow-Methods:GET');

header('Access-Control-Allow-Headers:x-requested-with');

define('PATH', strtr(dirname(__FILE__), '\\', '/'));

require(PATH.'/init.php');

$rand_arr = array(
    6800773181
);

$list = isset($_GET['list'])?$_GET['list']:false;
$id =  isset($_GET['id'])?$_GET['id']:false;
// 保存目录,不设置为不保存
$dir = PATH .'/data';
// 过期时间
$etime = 1200;
if($id){
    //播放时才请求歌词
    $lyric = save($id,$dir,$etime,true);
    echo $lyric;
}else{
    //返回列表
    if($list){
        $rand_arr = explode(',',$list);
    }
    //随机选取一个歌单列表
    $key=array_rand($rand_arr,1);
    $playlist_id = $rand_arr[$key];

    $musicLIST = save($playlist_id,$dir,$etime,false);
    echo $musicLIST;
}