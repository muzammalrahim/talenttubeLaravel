<?php


return [
    'default_disk' => 'local',

    'ffmpeg' => [
        'binaries' => 'C:/ffmpeg/bin/ffmpeg.exe', //env('FFMPEG_BINARIES', 'C:/ffmpeg/bin/ffmpeg.exe'),
        'threads' => 12,
    ],

    'ffprobe' => [
        'binaries' => 'C:/ffmpeg/bin/ffprobe.exe', //env('FFPROBE_BINARIES', 'C:/ffmpeg/bin/ffprobe.exe'),
    ],

    'timeout' => 3600,
];
