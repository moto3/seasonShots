<?php echo "<h1>電源投入時テスト画像一覧　　<button type='button' onclick='history.back()'>トップページに戻る</button></h1>";
$reqDate = $_POST['showdate'];

  foreach(glob(rtrim("./daily_timelapse/電源投入時テスト_".$reqDate."*.jpg")) as $file) {
    $result[] = $file;
}
$numberOfPictures = count($result);
echo "<!DOCTYPE html><html><head><meta charset='utf-8'>";
echo "<style type='text/css'>";
echo "<!--";
echo "id.pictureBox {width: 90%;}";
echo "-->";
echo "</style>";
   echo "</head>";
  echo "<body><p>".substr($reqDate, 0, 4)."年".substr($reqDate, 4, 2)."月".substr($reqDate, 6, 2)."日――の電源投入時テスト画像：".$numberOfPictures."枚ありました<p>";
for ($i = 0; $i < $numberOfPictures; $i++) {
    echo "<a href=";
    echo $result[$i];
    echo ">";
    echo substr($result[$i], -16, 4)."年".substr($result[$i], -12, 2)."月".substr($result[$i], -10, 2)."日――".substr($result[$i], -8, 2)."時".substr($result[$i], -6, 2)."分の画像";
    echo "<img src=".$result[$i]." width = '95%'></a>";
    echo "<br><br>";
 }
   echo "<button type='button' onclick='history.back()'>トップページに戻る</button>";

   echo "</body></html>";

?>
