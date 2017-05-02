<?php
function get_file_list($dir='./daily_timelapse') {
    $temp_file = array();
    if ($h_dir = opendir($dir)) {
        while (false !== ($filename = readdir($h_dir))) {
            if ($filename != '.' && $filename != '..') {
                if (is_file($dir . '/' . $filename)) {
                    $temp_file[$filename] = filectime($filename);
                }
            }
        }
    } else {
        exit("ERROR : cannot open directory $dir. ");
    }
    arsort($temp_file);
    return $temp_file;
}

print_r(get_file_list());
?>
