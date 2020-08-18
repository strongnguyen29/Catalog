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
        $newArr[$matches[1]] = $file;
        $path = $matches[1] . '/crop';

        if (!file_exists($path)) mkdir(__DIR__ . '/' . $path);

        $newName = printf('%s/%s.%s', $path, $i, $matches[2]);
        cropImage($file, $newName, $matches[2]);
        echo $newName . "\n";
        $i++;

        $newName = printf('%s/%s.%s', $path, $i, $matches[2], true);
        cropImage($file, $newName, $matches[2]);
        echo $newName . "\n";
        $i++;
    }
}
