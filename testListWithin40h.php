<?php
date_default_timezone_set('Asia/Tokyo');
 
//削除期限
$expire = strtotime("8 hours ago");
 
//ディレクトリ
$dir = dirname(__FILE__) . '/daily_timelapse/';
 
$list = scandir($dir);
foreach($list as $value){
    $file = $dir . $value;
    if(!is_file($file)) continue;
    $mod = filemtime( $file );
    if($mod > $expire){
        //chmod($file, 0666);
        println($file);
    }
}
