<?php
echo "<h1>指定日の画像一覧　　<button type='button' onclick='history.back()'>元のページに戻る</button></h1>";
$reqDate = $_POST['showdate']; //return date example:20170502

$dir = './daily_timelapse/';

require "fileList.php"; 

$numberOfPictures = count($result);
echo "<!DOCTYPE html><html><head><meta charset='utf-8'>";
echo "<style type='text/css'>";
echo "<!--";
echo "id.pictureBox {width: 90%;}";
echo "-->";
echo "</style>";
   echo "</head>";
  echo "<body><p>".substr($reqDate, 0, 4)."年".substr($reqDate, 4, 2)."月".substr($reqDate, 6, 2)."日――の撮影画像：".$numberOfPictures."枚ありました。新しい写真から順に表示します<p>";
for ($i =  0; $i < $numberOfPictures; $i++) {
    echo "<a href=";
    echo $result[$i];
    echo ">";
    echo date("Y年m月d日 - H時i分", filemtime($result[$i])). "の写真";
    echo "<img src=".$result[$i]." width = '95%'></a>";
    echo "<br><br>";
 }
   echo "<button type='button' onclick='history.back()'>元のページに戻る</button>";

   echo "</body></html>";

?>
