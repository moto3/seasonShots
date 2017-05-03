<?php
//http://php-archive.net/php/unlink-old-file/
//の記事は古いファイルを削除 inlink($file); するというもの
//今回は確認のためにprintするだけにした

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
    if($mod > $expire){ //指定時間よりも新しいものを抽出
        //chmod($file, 0666);
        print("\$expire = " . $expire.PHP_EOL);
        echo "$file was last modified at: " . date ("F d Y H:i:s.", $mod).PHP_EOL;
        print("\$mod = " . $mod.PHP_EOL);
        print($file.PHP_EOL);
    }
}
?>
