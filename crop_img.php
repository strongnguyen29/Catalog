<?php
include 'functions.php';

$files = glob("files/hoplong/*.jpg");

$newArr = [];

foreach ($files as $file) {
    if (preg_match('/(\d+)[^\/]*\.(jpg|jpeg|png)/', $file, $matches)) {
        $newArr[$matches[1]] = $file;
    }
}
ksort($newArr);
$i = 1;
foreach ($newArr as $file) {
    $newName = $i . '.jpg';
    if (preg_match('/(.*)\/[^\/]+\.(jpg|jpeg|png)/', $file, $matches)) {

        $path = $matches[1] . '/crop';

        if (!file_exists($path)) mkdir(__DIR__ . '/' . $path);
        echo $matches[2] .  "\n";
        $newName = printf('%s/%s.%s', $path, $i, $matches[2]);
        $success = cropImage($file, $newName, $matches[2]) ? 'OK' : 'FAILD';
        echo $newName . " - " . $success . "\n";
        $i++;

        $newName = printf('%s/%d.%s', $path, $i, $matches[2]);
        $success = cropImage($file, $newName, $matches[2], true) ? 'OK' : 'FAILD';

        echo $newName . " - " . $success . "\n";
        $i++;
    }
}
