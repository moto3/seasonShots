<?php 
header('Content-type: text/javascript; charset=utf-8');

$imageDirectory = 'daily_timelapse/';
$reqDate = $_GET['showDate'];
  foreach(glob(rtrim($imageDirectory."*".$reqDate."*.jpg")) as $file) {
    $result[] = $file;
}
//得られたファイルリストを作成時刻でソーティングし直す
array_multisort(
  array_map( 'filemtime', $result ),
  SORT_NUMERIC,
  SORT_DESC,  //これで新しい写真から順番に表示
  $result
);
 //json化してデータを返す
$jsonTest = json_encode($result);

echo "document.getElementById('id_fileList').textContent=".$jsonTest.";";
 ?>
