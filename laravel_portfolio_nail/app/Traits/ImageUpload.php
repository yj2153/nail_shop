<?php

namespace App\Traits;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImageUpload
{
  /**
   * profile image resize
   *
   * @param UploadedFile $file upload image file
   * @return string file name
   */
  private function saveImage(UploadedFile $file, $sizeW, $sizeH, $diskName, $dbFile): string
  {
    //기존파일이 존재할 경우 삭제.
    if (!empty($dbFile)) {
      Storage::delete($dbFile);
    }

    // $tempPath = $this->makeTempPath();

    // Image::make($file)->fit($sizeW, $sizeH)->save($tempPath);
    // Image::make($file)->fit($sizeW, $sizeH)->save($file);
    $filePath = Storage::putFile($diskName, $file);

    return basename($filePath);
  }

  /**
   * temp file create
   *
   * @return string file path
   */
  private function makeTempPath(): string
  {
    $tmp_fp = tmpfile();
    $meta   = stream_get_meta_data($tmp_fp);
    return $meta["uri"];
  }
}
