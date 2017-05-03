<?php
//http://php-archive.net/php/unlink-old-file/
//の記事は古いファイルを削除 inlink($file); するというもの
//今回は確認のためにprintするだけにした

date_default_timezone_set('Asia/Tokyo');
 
//削除期限
$searchDate = "2017-05-01";
//ディレクトリ
$dir = dirname(__FILE__) . '/daily_timelapse/';
 
$list = scandir($dir);

foreach($list as $value){
    $file = $dir . $value;
    if(!is_file($file)) continue;
    $mod = date ("Y-m-d", filemtime( $file ));
    if($mod == $searchDate){ //指定日時に一致するものを抽出
        //chmod($file, 0666);
        print("\$searchDate = " . $searchDate .PHP_EOL);
        echo "$file was last modified at: " . $mod.PHP_EOL;
        print($file.PHP_EOL);
    }
}
?>
