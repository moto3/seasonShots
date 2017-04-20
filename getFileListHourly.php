<?php 
header('Content-type: text/javascript; charset=utf-8');

$reqHour = $_GET['showHour'];
  foreach(glob(rtrim("daily_timelapse/*".$reqHour."00.jpg")) as $file) {
    $result[] = $file;
}
 //json化してデータを返す
$jsonTest = json_encode($result);

echo "document.getElementById('id_fileList').textContent=".$jsonTest.";";
 ?>


