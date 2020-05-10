<?php

use Jenssegers\Blade\Blade;
require 'LiveDraw.class.php';
error_reporting(1);








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

        $data = LiveDraw::parsingTaiwan($file);

        // print_r($data);
        $blade = new Blade('views', 'cache');
        // echo $blade->render('taiwan', ['data' => $data]);

        // echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        die;
        break;

        // case 'CHN':

        //     $data = LiveDraw::parsingChina();
        //     // print_r($data);
        //     echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        //     break;
        // case 'CAM':

        //     $data = LiveDraw::parsingCambodia();
        //     // print_r($data);
        //     echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        //     break;
        // case 'SYD':

        //     $data = LiveDraw::parsingSydney4d();
        //     // print_r($data);
        //     echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        //     break;
        // case 'SD':

        //     $data = LiveDraw::parsingSydney();
        //     // print_r($data);
        //     echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        //     break;
        // case 'SGP':

        //     $data = LiveDraw::parsingSingapore();
        //     // print_r($data);
        //     echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        //     break;


        // case 'SGP45':

        //     $data = LiveDraw::parsingSingapore45();
        //     // print_r($data);
        //     echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        //     break;
        // case 'HK':

        //     $data = LiveDraw::parsingHongkong();
        //     // print_r($data);
        //     echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        //     break;


    default:
        $data = LiveDraw::parsingTest($file);
        //  print_r($data);
        //  die;

        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    echo $data;

    ?>

</body>

</html>
