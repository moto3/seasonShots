<?php 
header('Content-type: text/javascript; charset=utf-8');

//$reqHour = '13';
//$beginDate = '20160822';
$reqHour = $_GET['showHour'];
$beginDate = $_GET['beginDate'];
$result = array();
$imageDirectory = 'daily_timelapseSandbox/';

  foreach(glob(rtrim($imageDirectory."*".$reqHour."00.jpg")) as $file) {
    $result[] = $file;
}

foreach($result as $value){
//echo '$result='.$value;
//echo(PHP_EOL);
}


foreach ($result as $key => $value){ //指定された開始日より前のファイルはオミットする

$datePictureTaken = substr( $value, strlen($imageDirectory),8); 
//ディレクトリー名を削除して…（./".$imageDirectory）なので。+2とする

//echo "datePictureTaken=".$datePictureTaken;
//echo(PHP_EOL);

if( $beginDate > $datePictureTaken ){ 
      unset($result[$key]);
  }
}

//Indexを詰める
$result = array_values($result);

/*
echo "現在の配列ポインターが差す価＝".current($result); 

echo(PHP_EOL);
echo "■行列削除後の\$key=".$key;
echo(PHP_EOL);
echo "■行列削除後の\$value=".$value;
echo(PHP_EOL);
*/

//デバッグのために入れた
//foreach($result as $value){

//echo(PHP_EOL);
//echo "\$resultの配列内容=".$value;
  
//}
reset($result); //これは呼ぶ必要があるのか、どうか？

 //json化してデータを返す
$jsonTest = json_encode($result);
//echo(PHP_EOL);
echo "document.getElementById('id_fileList').textContent=".$jsonTest.";";
//echo(PHP_EOL);
?>
