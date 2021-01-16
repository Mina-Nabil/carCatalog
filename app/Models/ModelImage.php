<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class ModelImage extends Model
{
    protected $table = "model_images";
    public $timestamps = false;


    public function compress()
    {
        $quality = 40;
        $ext = last(explode('.', $this->MOIM_URL));
        $fileNoExt = str_replace('.' . $ext, '', $this->MOIM_URL);
        $imagePath = public_path('storage/' . $this->MOIM_URL);
        $newImagePath =  $fileNoExt . '_' . $quality . '.' . $ext;
        echo "Extension: " . $ext . "\n";
        echo "FileNoExt: " . $fileNoExt . "\n";
        echo "Path: " . $imagePath . "\n";
        echo "New Path: " . $newImagePath . "\n";
        if ($ext == 'png') {
            try {
                $image = imagecreatefrompng($imagePath);
                imagejpeg($image, public_path('storage/' . $newImagePath), $quality);
                $this->MOIM_URL = $newImagePath;
                $this->save();
                unlink($imagePath);
            } catch (Exception $e) {
                echo "Something went wrong here \n";
                echo $e->getMessage();
                echo "\n";
            }
        } else if ($ext == 'jpg' || $ext == 'jpeg') {
            $image = self::imagecreatefromjpegexif($imagePath);
            try {
                imagejpeg($image, public_path('storage/' . $newImagePath), $quality);
                $this->MOIM_URL = $newImagePath;
                $this->save();
                unlink($imagePath);
            } catch (Exception $e) {
                echo "Something went wrong here \n";
                echo $e->getMessage();
                echo "\n";
            }
        }
    }

    private static function imagecreatefromjpegexif($filename)
    {
        $img = imagecreatefromjpeg($filename);
        $exif = exif_read_data($filename);
        echo "size before: ";
        echo $exif['FileSize'] . "\n";

        if ($img && $exif && isset($exif['Orientation'])) {
            $ort = $exif['Orientation'];

            if ($ort == 6 || $ort == 5)
                $img = imagerotate($img, 270, null);
            if ($ort == 3 || $ort == 4)
                $img = imagerotate($img, 180, null);
            if ($ort == 8 || $ort == 7)
                $img = imagerotate($img, 90, null);

            if ($ort == 5 || $ort == 4 || $ort == 7)
                imageflip($img, IMG_FLIP_HORIZONTAL);
        }
        return $img;
    }
}
