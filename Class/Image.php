<?php

namespace App;

class Image
{

    public function resize($from, $dest, $new_width, $extension = null)
    {
        $type = '';
        $ext = '';

        if ($extension)
            $ext = $extension;
        else {
            $pathinfo = pathinfo($from);
            $ext = $pathinfo['extension'];
        }

        switch ($ext) {
            case 'png':
                $type = IMAGETYPE_PNG;
                break;
            case 'PNG':
                $type = IMAGETYPE_PNG;
                break;
            case 'jpg':
                $type = IMAGETYPE_JPEG;
                break;
            case 'JPG':
                $type = IMAGETYPE_JPEG;
                break;
            case 'jpeg':
                $type = IMAGETYPE_JPEG;
                break;
            case 'JPEG':
                $type = IMAGETYPE_JPEG;
                break;
            case 'gif':
                $type = IMAGETYPE_GIF;
                break;
            case 'GIF':
                $type = IMAGETYPE_GIF;
                break;
            case 'bmp':
                $type = IMAGETYPE_BMP;
                break;
            case 'BMP':
                $type = IMAGETYPE_BMP;
                break;
        }

        list($width, $height) = getimagesize($from);
        $new_height = abs($new_width * $height / $width);

        $bg = imagecreatetruecolor($new_width, $new_height);
        switch (strtolower($type)) {
            case IMAGETYPE_PNG:
                imagesavealpha($bg, true);
                imagealphablending($bg, false);
                $src = imagecreatefrompng($from);
                break;
            case IMAGETYPE_JPEG:
                $src = imagecreatefromjpeg($from);
                break;
            case IMAGETYPE_GIF:
                $src = imagecreatefromgif($from);
                break;
            case IMAGETYPE_BMP:
                $src = imagecreatefrombmp($from);
                break;
            default:
                return;
        }

        $ti = imagecolortransparent($src);
        if ($ti >= 0) {
            $tc = imagecolorsforindex($src, $ti);
            $ti = imagecolorallocate($bg, $tc['red'], $tc['green'], $tc['blue']);
            imagefill($bg, 0, 0, $ti);
            imagecolortransparent($bg, $ti);
        }

        imagecopyresampled($bg, $src, 0, 0, 0, 0, $new_width, $new_height, imagesx($src), imagesy($src));
        imagedestroy($src);
        if ($type == IMAGETYPE_PNG)
            imagepng($bg, $dest);
        else
            imagejpeg($bg, $dest, 100);
        imagedestroy($bg);
    }

}
