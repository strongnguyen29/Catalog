<?php

include 'functions.php';

define('PATH', __DIR__);

for ($i = 1; $i < 36; $i++) {
    $url = 'https://duytan.com/catalogue/congnghiep/files/thumb/'. $i . '.jpg?200609163319';
    $savefile = 'files/thumb/' . $i . '.jpg';
    $content = file_get_contents($url);
    if ($content) file_put_contents($savefile, $content);
    echo $url . "\n";
}

