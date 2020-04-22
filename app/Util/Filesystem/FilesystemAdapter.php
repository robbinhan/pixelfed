<?php

namespace App\Util\Filesystem;

use Illuminate\Filesystem\FilesystemAdapter as IlluminateFilesystemAdapter;

class FilesystemAdapter extends IlluminateFilesystemAdapter
{

    /**
     * Store the uploaded file on the disk with a given name.
     *
     * @param  string  $path
     * @param  \Illuminate\Http\File|\Illuminate\Http\UploadedFile|string  $file
     * @param  string  $name
     * @param  array  $options
     * @return string|false
     */
    public function putFileAs($path, $file, $name, $options = [])
    {
        $stream = fopen(is_string($file) ? $file : $file->getRealPath(), 'r');

        // Next, we will format the path of the file and store the file using a stream since
        // they provide better performance than alternatives. Once we write the file this
        // stream will get closed automatically by us so the developer doesn't have to.
        $result = $this->put(
            $path,
            $stream,
            $options
        );

        if (is_resource($stream)) {
            fclose($stream);
        }

        return $result ? $result : false;
    }
}
