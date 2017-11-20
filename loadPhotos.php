<?php
  $dir = 'daily_timelapse/';
  if (!file_exists($dir)) {
    die('Error: Directory not found.');
  }

  $dh  = opendir($dir);
  $files = array();
  while (false !== ($fileName = readdir($dh))) {
    $ext = substr($fileName, strrpos($fileName, '.') + 1);
    if(in_array($ext, array("jpg","jpeg","png","gif"))){
      $files[] = (object) array(
        'fileName' => $fileName,
        'timestamp' => filemtime($dir . $fileName),
        'dateString' => date('Y/m/d H:i', filemtime($dir . $fileName))
      );
    }
  }

  //CONVERT FILENAME TO TIMESTAMP
  //NOT NECESSARY WHEN USED ON LIVE SERVER
  for($i = 0; $i < sizeof($files); $i++){
    $fileName = $files[$i]->fileName;
    if(strrpos($files[$i]->fileName, '_') !== FALSE){
      $fileName = substr($files[$i]->fileName, strrpos($files[$i]->fileName, '_')+1); //NORMALIZE
    }
    $files[$i]->timestamp = strtotime(substr($fileName, 0, strrpos($fileName, '.')));
    $files[$i]->dateString = date('Y/m/d H:i', $files[$i]->timestamp);
  }

  usort($files, "compare");
  echo json_encode($files);

  function compare($a, $b){
    if ($a->timestamp == $b->timestamp){ return 0; }
    return ($a->timestamp < $b->timestamp) ? -1 : 1;
  }
  
?>
