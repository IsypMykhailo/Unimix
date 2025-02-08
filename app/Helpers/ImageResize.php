<?php

namespace App\Helpers;

use InvalidArgumentException;

class ImageResize
{
    public function cutImage($filename, $targetWidth, $targetHeight){
        $info   = getimagesize($_SERVER['DOCUMENT_ROOT'].'/storage/' . $filename);
        $width  = $info[0];
        $height = $info[1];
        $type   = $info[2];
        $img = $this->imagecreatefromfile($_SERVER['DOCUMENT_ROOT'].'/storage/' . $filename);

        $w1 = 0;
        $h1 = $targetHeight;

        if (empty($w1)) {
            $w1 = ceil($h1 / ($height / $width));
        }
        if (empty($h1)) {
            $h1 = ceil($w1 / ($width / $height));
        }

        $tmp = imageCreateTrueColor($w1, $h1);
        if ($type == 1 || $type == 3) {
            imagealphablending($tmp, true);
            imageSaveAlpha($tmp, true);
            $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
            imagefill($tmp, 0, 0, $transparent);
            imagecolortransparent($tmp, $transparent);
        }

        $tw = ceil($h1 / ($height / $width));
        $th = ceil($w1 / ($width / $height));
        if ($tw < $w1) {
            imageCopyResampled($tmp, $img, ceil(($w1 - $tw) / 2), 0, 0, 0, $tw, $h1, $width, $height);
        } else {
            imageCopyResampled($tmp, $img, 0, ceil(($h1 - $th) / 2), 0, 0, $w1, $th, $width, $height);
        }

        $img = $tmp;

        $w = $targetWidth;
        $h = $targetHeight;

        $x = '1%';
        $y = '1%';

        if (strpos($x, '%') !== false) {
            $x = intval($x);
            $x = ceil(($width * $x / 100) - ($w / 100 * $x));
        }
        if (strpos($y, '%') !== false) {
            $y = intval($y);
            $y = ceil(($height * $y / 100) - ($h / 100 * $y));
        }

        $tmp = imageCreateTrueColor($w, $h);
        if ($type == 1 || $type == 3) {
            imagealphablending($tmp, true);
            imageSaveAlpha($tmp, true);
            $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
            imagefill($tmp, 0, 0, $transparent);
            imagecolortransparent($tmp, $transparent);
        }

        imageCopyResampled($tmp, $img, 0, 0, $x, $y, $width, $height, $width, $height);
        $img = $tmp;
        imagejpeg($img, $_SERVER['DOCUMENT_ROOT'].'/storage/' . $filename);
    }

    public function cutBackground($filename, $targetWidth, $targetHeight){
        $info   = getimagesize($_SERVER['DOCUMENT_ROOT'].'/storage/' . $filename);
        $width  = $info[0];
        $height = $info[1];
        $type   = $info[2];
        $img = $this->imagecreatefromfile($_SERVER['DOCUMENT_ROOT'].'/storage/' . $filename);

        $w1 = $targetWidth;
        $h1 = 0;

        if (empty($w1)) {
            $w1 = ceil($h1 / ($height / $width));
        }
        if (empty($h1)) {
            $h1 = ceil($w1 / ($width / $height));
        }

        $tmp = imageCreateTrueColor($w1, $h1);
        if ($type == 1 || $type == 3) {
            imagealphablending($tmp, true);
            imageSaveAlpha($tmp, true);
            $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
            imagefill($tmp, 0, 0, $transparent);
            imagecolortransparent($tmp, $transparent);
        }

        $tw = ceil($h1 / ($height / $width));
        $th = ceil($w1 / ($width / $height));
        if ($tw < $w1) {
            imageCopyResampled($tmp, $img, ceil(($w1 - $tw) / 2), 0, 0, 0, $tw, $h1, $width, $height);
        } else {
            imageCopyResampled($tmp, $img, 0, ceil(($h1 - $th) / 2), 0, 0, $w1, $th, $width, $height);
        }

        $img = $tmp;

        $w = $targetWidth;
        $h = $targetHeight;

        $x = '0%';
        $y = '0%';

        if (strpos($x, '%') !== false) {
            $x = intval($x);
            $x = ceil(($width * $x / 100) - ($w / 100 * $x));
        }
        if (strpos($y, '%') !== false) {
            $y = intval($y);
            $y = ceil(($height * $y / 100) - ($h / 100 * $y));
        }

        $tmp = imageCreateTrueColor($w, $h);
        if ($type == 1 || $type == 3) {
            imagealphablending($tmp, true);
            imageSaveAlpha($tmp, true);
            $transparent = imagecolorallocatealpha($tmp, 0, 0, 0, 127);
            imagefill($tmp, 0, 0, $transparent);
            imagecolortransparent($tmp, $transparent);
        }

        imageCopyResampled($tmp, $img, 0, 0, $x, $y, $width, $height, $width, $height);
        $img = $tmp;
        imagejpeg($img, $_SERVER['DOCUMENT_ROOT'].'/storage/' . $filename);
    }

    public function imagecreatefromfile( $filename ) {
        if (!file_exists($filename)) {
            throw new InvalidArgumentException('File "'.$filename.'" not found.');
        }
        switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($filename);
                break;

            case 'png':
                return imagecreatefrompng($filename);
                break;

            case 'gif':
                return imagecreatefromgif($filename);
                break;

            case 'webp':
                return imagecreatefromwebp($filename);
                break;

            default:
                throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png, webp or gif image.');
                break;
        }
    }
}
