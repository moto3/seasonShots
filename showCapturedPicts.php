<?php echo "<h1>指定日の画像一覧　　<button type='button' onclick='history.back()'>元のページに戻る</button></h1>";
$reqDate = $_POST['showdate']; //return date example:20170502

$dir = './daily_timelapse/';

$fileList = scandir($dir);
foreach($fileList as $value ){
  $file = $dir . $value;
  if (!is_file($file)) continue;
  if (strpos ($file,".jpg") != false) { //文字列に".jpg"が含まれるなら
      $modifiedDate = date("Ymd", filemtime($file));  //取得したファイルの変更日時を取得
      $modTime = date("Ymd - Hi", filemtime($file));
  if($modifiedDate == $reqDate){ //指定日に一致するなら
          echo $file . "was last modified at: " . $modTime . "<br>".PHP_EOL;
          //デバグのためにファイル名と実際の変更日時を表示させる
          $result[] = $file;
    }
  }
}
array_multisort(
  array_map( 'filemtime', $result ),
  SORT_NUMERIC,
  SORT_DESC,  //これで新しい写真から順番に表示
  $result
);

$numberOfPictures = count($result);
echo "<!DOCTYPE html><html><head><meta charset='utf-8'>";
echo "<style type='text/css'>";
echo "<!--";
echo "id.pictureBox {width: 90%;}";
echo "-->";
echo "</style>";
   echo "</head>";
  echo "<body><p>".substr($reqDate, 0, 4)."年".substr($reqDate, 4, 2)."月".substr($reqDate, 6, 2)."日――の撮影画像：".$numberOfPictures."枚ありました<p>";
for ($i = $numberOfPictures -1; $i > -1; $i--) {
    echo "<a href=";
    echo $result[$i];
    echo ">";
    echo substr($result[$i], -16, 4)."年".substr($result[$i], -12, 2)."月".substr($result[$i], -10, 2)."日――".substr($result[$i], -8, 2)."時".substr($result[$i], -6, 2)."分の画像";
    echo date("  \/Ymd - Hi", filemtime($result[$i]));
    echo "<img src=".$result[$i]." width = '95%'></a>";
    echo "<br><br>";
 }
   echo "<button type='button' onclick='history.back()'>元のページに戻る</button>";

   echo "</body></html>";

?>
