<?php

namespace App\Adapter;

use League\Flysystem\Adapter\AbstractAdapter;
use League\Flysystem\Config;

class SwarmAdapter extends AbstractAdapter
{
    private $client = null;
    private $config = '';

    public function __construct(\GuzzleHttp\Client $client, $config = [])
    {
        $this->client = $client;
        $this->config = $config;
    }


    /**
     * Write a new file.
     *
     * @param string $path
     * @param string $contents
     * @param Config $config   Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function write($path, $contents, Config $config)
    {
        // var_dump('write', $path, $contents,  $config);
        return $this->upload($path, $contents,  $config);
    }

    /**
     * Write a new file using a stream.
     *
     * @param string   $path
     * @param resource $resource
     * @param Config   $config   Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function writeStream($path, $resource, Config $config)
    {
        // var_dump('writeStream', $path, $resource,  $config);
        return $this->upload($path, $resource,  $config);
    }

    /**
     * Update a file.
     *
     * @param string $path
     * @param string $contents
     * @param Config $config   Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function update($path, $contents, Config $config)
    {
    }

    /**
     * Update a file using a stream.
     *
     * @param string   $path
     * @param resource $resource
     * @param Config   $config   Config object
     *
     * @return array|false false on failure file meta data on success
     */
    public function updateStream($path, $resource, Config $config)
    {
    }

    /**
     * Rename a file.
     *
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     */
    public function rename($path, $newpath)
    {
    }

    /**
     * Copy a file.
     *
     * @param string $path
     * @param string $newpath
     *
     * @return bool
     */
    public function copy($path, $newpath)
    {
    }

    /**
     * Delete a file.
     *
     * @param string $path
     *
     * @return bool
     */
    public function delete($path)
    {
    }

    /**
     * Delete a directory.
     *
     * @param string $dirname
     *
     * @return bool
     */
    public function deleteDir($dirname)
    {
    }

    /**
     * Create a directory.
     *
     * @param string $dirname directory name
     * @param Config $config
     *
     * @return array|false
     */
    public function createDir($dirname, Config $config)
    {
    }

    /**
     * Set the visibility for a file.
     *
     * @param string $path
     * @param string $visibility
     *
     * @return array|false file meta data
     */
    public function setVisibility($path, $visibility)
    {
    }


    /**
     * Check whether a file exists.
     *
     * @param string $path
     *
     * @return array|bool|null
     */
    public function has($path)
    {
    }

    /**
     * Read a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function read($path)
    {
    }

    /**
     * Read a file as a stream.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function readStream($path)
    {
    }

    /**
     * List contents of a directory.
     *
     * @param string $directory
     * @param bool   $recursive
     *
     * @return array
     */
    public function listContents($directory = '', $recursive = false)
    {
    }

    /**
     * Get all the meta data of a file or directory.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getMetadata($path)
    {
    }

    /**
     * Get the size of a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getSize($path)
    {
    }

    /**
     * Get the mimetype of a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getMimetype($path)
    {
    }

    /**
     * Get the last modified time of a file as a timestamp.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getTimestamp($path)
    {
    }

    /**
     * Get the visibility of a file.
     *
     * @param string $path
     *
     * @return array|false
     */
    public function getVisibility($path)
    {
    }

    /**
     * curl -X POST -H "Content-Type: text/plain" --data "some-data" http://localhost:8500/bzz:/
     * curl 'https://swarm-gateways.net/bzz:/?defaultpath=300px-175Togepi.webp' \
     * -H 'authority: swarm-gateways.net' \
     * -H 'accept: text' \
     * -H 'content-type: multipart/form-data; boundary=----WebKitFormBoundaryCN9BErqGw6FAdTVd' \
     * --data-binary $'------WebKitFormBoundaryCN9BErqGw6FAdTVd\r\nContent-Disposition: form-data; name="uploadSelected"\r\n\r\n300px-175Togepi.webp\r\n------WebKitFormBoundaryCN9BErqGw6FAdTVd\r\nContent-Disposition: form-data; name="file"; filename="300px-175Togepi.webp"\r\nContent-Type: image/webp\r\n\r\n\r\n------WebKitFormBoundaryCN9BErqGw6FAdTVd--\r\n' \
     * --compressed
     */
    /**
     * @param string $path
     * @param resource|string $contents
     * @param string $mode
     *
     * @return array|false file metadata
     */
    protected function upload(string $path, $contents, $config)
    {
        // $path = $this->applyPathPrefix($path);

        // var_dump($path);

        $response = $this->client->request("POST", $this->config['gateway'],  [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => $contents,
                    'filename' => $path,
                ],
            ]
        ]);
        // var_dump($response->getBody()->__toString());
        return $response->getBody()->__toString();
    }
}
