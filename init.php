<?php

/**
 * 读取网易歌单数据
 * maintain:小雨啊
 */
header("Content-type:application/json;Charset=utf8");

function getJSON($playlist_id)
{
    return  file_get_contents(sprintf('https://api.injahow.cn/meting/?type=playlist&id=%s',$playlist_id));
}


function getLrc($song_id){
    return  file_get_contents(sprintf('https://api.injahow.cn/meting/?server=netease&type=lrc&id=%s',$song_id));
}

function save($id,$dir = null,$etime = 600,$url=false)
{
    if($dir){
        $filename = $dir .'/'. $id . '.json';
        if (is_file($filename)) {
           $time = time();
           $ftime = filemtime($filename);
           if(($time - $ftime) < $etime){
              return file_get_contents($filename);
           }
        }
    }
    if($url){
        $content = getLrc($id);
    }else{
        $content = getJSON($id);
    }
    if(!empty($content) && isset($filename)) {
        file_put_contents($filename, $content);
    }
    return $content;
}