<?php

/**
 * 读取网易歌单数据
 * maintain:小雨啊
 */
header("Content-type:application/json;Charset=utf8");

function getJSON($playlist_id,$lyc = false)
{
    $res =  file_get_contents(sprintf('https://api.injahow.cn/meting/?type=playlist&id=%s',$playlist_id));
    return $res;
}

function save($playlist_id,$dir = null,$lyc = false,$etime = 600)
{
    if($dir){
        $filename = $dir .'/'. $playlist_id . '.json';
        if (is_file($filename)) {
           $time = time();
           $ftime = filemtime($filename);
           if(($time - $ftime) < $etime){
              return file_get_contents($filename);
           }
        }
    }

    $musicLIST = getJSON($playlist_id, $lyc);
    if(!empty($musicLIST) && isset($filename)) {
        file_put_contents($filename, $musicLIST);
    }
    return $musicLIST;
}