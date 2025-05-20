<?php

namespace App\Repositories\Upload;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UploadImageRepository {

    private $file,$directory,$oldFileName,$extension;

    public function __construct($file,$directory,$oldFileName=NULL,$extension='webp') {
        $this->file = $file;
        $this->directory = $directory;
        $this->oldFileName = $oldFileName;
        $this->extension = $extension;
    }

    public function upload() {
        $fileName = time().random_int(11111,99999).'.'.$this->extension;
        $convertImage  = Image::make($this->file)->encode($this->extension, 60);
        Storage::disk('public')->put($this->directory.'/'.$fileName, $convertImage);
        return $fileName;
    }
}
