<?php
include 'LiveDraw.class.php';


// method panggil :  php index.php 'nama_file'
// misal :  php index.php taiwan

if(isset($argv)){

    $file = $argv[1];
}else{
    $file = $_GET['country'];
}


switch ($file) {
    case 'taiwan':

        $data = LiveDraw::parsingTaiwan($file);
        // print_r($data);
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        break;

    case 'china':

        $data = LiveDraw::parsingChina();
        // print_r($data);
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        break;
    case 'cambodia':

        $data = LiveDraw::parsingCambodia();
        // print_r($data);
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        break;
    case 'sydney4d':

        $data = LiveDraw::parsingSydney4d();
        // print_r($data);
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        break;
    case 'sydney':

        $data = LiveDraw::parsingSydney();
        // print_r($data);
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        break;
    case 'singapore':

        $data = LiveDraw::parsingSingapore();
        print_r($data);
        // echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        break;

    default:
        # code...
        break;
}
