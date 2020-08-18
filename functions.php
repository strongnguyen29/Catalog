<?php

function downloadImageFromUrl($imagepath)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch,CURLOPT_URL, $imagepath);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result=curl_exec($ch);
    curl_close($ch);
    return $result;
}

function renameImage($fileName) {
    if (!$fileName) return false;

    if (preg_match('/(\d+)[^\/]*\.(jpg|jpeg|png)/', $fileName, $matches)) {

    }
}



function cropImage($filenameImage, $filename, $ext = 'jpg', $isRiht = false)
{
    if($ext == "jpeg" || $ext == "jpg") {
        $image = imagecreatefromjpeg($filenameImage);
    } elseif($ext == "png") {
        $image = imagecreatefrompng($filenameImage);
    }

    $width = imagesx($image);
    $height = imagesy($image);
    $newWidth = $width / 2;

    $startX = $isRiht ? $newWidth : 0;

    $thumb = imagecreatetruecolor( $newWidth, $height );
    // Resize and crop
    imagecopyresampled($thumb,
        $image,
        $newWidth, // Center the image horizontally
        $height, // Center the image vertically
        $startX, 0,
        $newWidth, $height,
        $width, $height
    );

    switch ($ext) {
        case 'jpg':
        case 'jpeg':
        {
            imagejpeg($thumb, __DIR__ . '/' . $filename, 100);
            break;
        }
        case 'png':
        {
            imagepng($thumb,$filename,1);
            break;
        }
        default:
        {
            imagejpeg($thumb, $filename, 100);
        }
    }
}
