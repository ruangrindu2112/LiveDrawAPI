<?php

error_reporting(1);
require 'LiveDraw.class.php';


// method panggil :  php index.php 'nama_file'
// misal :  php index.php taiwan

if (isset($argv)) {

    $file = $argv[1];
} else {
    $file = $_GET['country'];
}

// var_dump($file);

switch (strtoupper($file)) {
    case 'TW':
        LiveDraw::parsingTaiwan($file);
        break;
    case 'MY':
        LiveDraw::parsingMalaysia();
        break;
    case 'MYD':
        LiveDraw::parsingMalaysiaDay();
        break;
    case 'CHN':
        $data = LiveDraw::parsingChina();
        break;
    case 'CAM':
        $data = LiveDraw::parsingCambodia();
        break;

    case 'SYD':
        $data = LiveDraw::parsingSydney4d();
        break;
    case 'SD':
        $data = LiveDraw::parsingSydneyx();
        break;
    case 'SGP':
        $data = LiveDraw::parsingSingapore();
        break;
    case 'SGM':
        $data = LiveDraw::parsingSingaporeMetro();
        break;
    case 'QTR':
        $data = LiveDraw::parsingQatar();
        break;

    case 'SGP45':
        $data = LiveDraw::parsingSingapore45();
        break;
    case 'HK':
        $data = LiveDraw::parsingHongkongx();
        break;
    case 'HKX':
        $data = LiveDraw::parsingHongkong();
        break;
    case 'MGN':
        $data = LiveDraw::parsingMagnum4d();
        break;
    case 'HKD':
        $data = LiveDraw::parsingHongkongSiang();
        break;



    default:
        $data = LiveDraw::parsingTest($file);
        break;
}
