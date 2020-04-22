<?php

namespace App\Util\Filesystem;

use InvalidArgumentException;
use League\Flysystem\Util;
use League\Flysystem\Filesystem as LeagueFilesystem;
use League\Flysystem\Adapter\CanOverwriteFiles;

class Filesystem extends LeagueFilesystem
{

    /**
     * @inheritdoc
     */
    public function writeStream($path, $resource, array $config = [])
    {
        if (!is_resource($resource)) {
            throw new InvalidArgumentException(__METHOD__ . ' expects argument #2 to be a valid resource.');
        }

        $path = Util::normalizePath($path);
        $this->assertAbsent($path);
        $config = $this->prepareConfig($config);

        Util::rewindStream($resource);

        return $this->getAdapter()->writeStream($path, $resource, $config);
    }

    /**
     * @inheritdoc
     */
    public function putStream($path, $resource, array $config = [])
    {
        if (!is_resource($resource)) {
            throw new InvalidArgumentException(__METHOD__ . ' expects argument #2 to be a valid resource.');
        }

        $path = Util::normalizePath($path);
        $config = $this->prepareConfig($config);
        Util::rewindStream($resource);

        if (!$this->getAdapter() instanceof CanOverwriteFiles && $this->has($path)) {
            return (bool) $this->getAdapter()->updateStream($path, $resource, $config);
        }

        return  $this->getAdapter()->writeStream($path, $resource, $config);
    }
}
