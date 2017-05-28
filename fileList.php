<?php
$fileList = scandir($dir);
foreach($fileList as $value ){
  $file = $dir . $value;
  if (!is_file($file)) continue;
  if (strpos ($file,".jpg") != false) { //文字列に".jpg"が含まれるなら
      $modifiedDate = date("Ymd", filemtime($file));  //取得したファイルの変更日時を取得
      $modTime = date("Ymd - Hi", filemtime($file));
  if($modifiedDate == $reqDate){ //指定日に一致するなら行列に追加
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
?>
