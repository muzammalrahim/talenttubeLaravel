<?php


return [
    'default_disk' => 'local',

    'ffmpeg' => [
        'binaries' =>  env('FFMPEG_BINARIES', 'C:\xampp\htdocs\talenttubeLaravel\ffmg'),
        'threads' => 12,
    ],

    'ffprobe' => [
        'binaries' =>  env('FFPROBE_BINARIES', 'C:\xampp\htdocs\talenttubeLaravel\ffmg'),
    ],

    'timeout' => 3600,
];
