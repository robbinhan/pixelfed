<?php

namespace App\Util\Filesystem;

use Illuminate\Filesystem\FilesystemManager as IlluminateFilesystemManager;
use \League\Flysystem\FilesystemInterface;

class FilesystemManager extends IlluminateFilesystemManager
{
    /**
     * Adapt the filesystem implementation.
     *
     * @param  \League\Flysystem\FilesystemInterface  $filesystem
     * @return \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected function adapt(FilesystemInterface $filesystem)
    {
        return new FilesystemAdapter($filesystem);
    }
}
