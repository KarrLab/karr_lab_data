<?php

# get directory
$dir = $_GET['dir'];
if ($dir == '') {
    $dir = 'public';
}

# check token
$token = $_GET['token'];
if ($dir != 'public' && file_get_contents('token') != $token) {
    http_response_code(401);
    die('Invalid token');
}

# get file name
$file = $_GET['file'];
if ($file == '') {
    http_response_code(400);
    die('A file must be requested');
}

# check file exists
if (!is_dir("$dir/$file")) {
    http_response_code(400);
    die('Invalid file');
}

# get version
$version = $_GET['version'];
if ($version == '' || $version == 'latest') {
    $version = count(scandir("$dir/$file")) - 3;
}

# check version exists
if (!file_exists("$dir/$file/$version")) {
    http_response_code(400);
    die('Invalid version');
}

# return file
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Content-Disposition: attachment; filename=$file");
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: '.filesize("$dir/$file/$version"));
readfile("$dir/$file/$version");

?>
