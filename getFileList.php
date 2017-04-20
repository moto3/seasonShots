<?php 
header('Content-type: text/javascript; charset=utf-8');

$imageDirectory = 'daily_timelapse/';
$reqDate = $_GET['showDate'];
  foreach(glob(rtrim($imageDirectory.$reqDate."*.jpg")) as $file) {
    $result[] = $file;
}
 //json化してデータを返す
$jsonTest = json_encode($result);

echo "document.getElementById('id_fileList').textContent=".$jsonTest.";";
 ?>


