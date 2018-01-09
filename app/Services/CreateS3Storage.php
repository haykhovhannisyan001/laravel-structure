<?php

namespace App\Services;

class CreateS3Storage
{
    const PUBLIC = 'public';
    const PRIVATE = 'private';

    function make($bucket)
    {
        $config = config('filesystems.disks.s3');

        return \Illuminate\Support\Facades\Storage::createS3Driver([
            'driver' => 's3',
            'key' => $config['key'],
            'secret' => $config['secret'],
            'region' => $config['region'],
            'bucket' => $bucket
        ]);
    }

    function getFileVisibility($status)
    {
        return $status ? self::PUBLIC : self::PRIVATE;
    }
}