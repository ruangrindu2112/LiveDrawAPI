<?php

require 'vendor/autoload.php';

use DiDom\Document;
use Didom\Query;
use DiDom\StyleAttribute;

class LiveDraw
{
    public function __construct()
    {
    }

    public static function parsingSingapore()
    {
        $filename = 'singapore.html';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        $table =  $doc->find('div.article-body')[0];
        return $table->html();



    }
    public static function parsingSydney()
    {
        $filename = 'sydney.html';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        $table =  $doc->find('table')[0];

        foreach ($table->find('tr') as $key => $value) {
            if ($key == 0) {
                // return $value->html();
            } else if ($key == 1) {
                $result['periode'] = trim($value->text());
            } else {
                // return $value->html();
                if ($value->has('table')) {

                    foreach ($value->find('table')[0]->find('tr') as  $tr) {


                        $angka = [];
                        foreach ($tr->find('img') as $img) {
                            array_push($angka, self::antara($img->src, '_', '.jpg'));
                        }
                        $angka = implode('', $angka);
                        $arr = [
                            'type' => trim($tr->find('td')[0]->text()),
                            'value' => $angka
                        ];
                        if (trim($tr->find('td')[0]->text()) !== '') {

                            array_push($result['data'], $arr);
                        }
                    }
                }
            }
        }

        return $result;
    }
    public static function parsingSydney4d()
    {
        $filename = 'sydney4d.html';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];
        // $result['periode'] = trim($doc->find('td[align=right]')[0]->text());

        $periode =  $doc->find('table')[4]->find('table')[1]->find('span')[1]->text();
        $result['periode'] = $periode;

        $tb4 =  $doc->find('table')[5];

        $utama =  $tb4->find('table')[1];
        $tengah =   $tb4->find('table')[5];
        $akhir =   $tb4->find('table')[12];


        $angkaatas = [];
        foreach ($utama->find('tr')[0]->find('table') as $key => $tbatas) {
            foreach ($tbatas->find('td') as $td) {
                $angkaatas[] .= $td->text();
            }
        }


        $angkaatas =  array_chunk($angkaatas, 4);
        foreach ($angkaatas as $key => $value) {
            if ($key == '0') {
                $type = '1st Prize';
            } else if ($key == '1') {
                $type = '2nd Prize';
            } else {
                $type = '3rd Prize';
            }

            array_push($result['data'], [
                'type' => $type,
                'value' => implode('', $value)
            ]);
        }


        $angkatengah = [];
        foreach ($tengah->find('tr')[0]->find('table') as $key => $tbatas) {
            if ($key >= 1) {

                foreach ($tbatas->find('td') as $td) {
                    $angkatengah[] .= $td->text();
                }
            }
        }

        $angkatengah =  array_chunk($angkatengah, 4);
        foreach ($angkatengah as $key => $value) {

            $angkatengah[$key] = implode('', $value);
            # code...
        }
        array_push($result['data'], [
            'type' => 'Starter Prize',
            'value' => $angkatengah
        ]);

        $angkaakhir  = [];
        foreach ($akhir->find('tr')[0]->find('table') as $key => $tbatas) {
            if ($key >= 1) {

                foreach ($tbatas->find('td') as $td) {
                    $angkaakhir[] .= $td->text();
                }
            }
        }
        $angkaakhir =  array_chunk($angkaakhir, 4);
        foreach ($angkaakhir as $key => $value) {

            $angkaakhir[$key] = implode('', $value);
            # code...
        }
        array_push($result['data'], [
            'type' => 'Consolation Prize',
            'value' => $angkaakhir
        ]);

        // return $angkaakhir;
        return $result;
    }

    //  cambodia

    public static function parsingCambodia()
    {
        $filename = 'cambodia.html';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = trim($doc->find('td[align=right]')[0]->text());
        $result['data'] = [];

        // return $tableAtas = $doc->find('tbody')[0]->html();

        $table =  $doc->find('table');

        // found tr3
        $tr3 =  $table[0]->find('tr[align=center]')[3];
        $angka = [];
        foreach ($tr3->find('td') as $td) {

            foreach ($td->find('img') as $key => $img) {
                array_push($angka, self::antara($img->src, 'images/bola/kuning_', '.jpg'));
            }
        }



        $slice = array_chunk($angka, 4, false);
        foreach ($slice as $key => $value) {
            if ($key == '0') {
                $type = '1st Prize';
            } else if ($key == '1') {
                $type = '2nd Prize';
            } else {
                $type = '3rd Prize';
            }

            array_push($result['data'], [
                'type' => $type,
                'value' => implode('', $slice[$key])
            ]);
        }


        $tr4 =    $table[0]->find('tr[align=center]')[4];
        $angka = [];
        foreach ($tr4->find('img') as $key => $value) {
            if (strpos($value->src, 'kiri') === false && strpos($value->src, 'kanan') === false) {

                $angka[] = self::antara($value->src, 'images/bola/kuning_', '.jpg');
            }
            # code...
        }

        $slice = array_chunk($angka, 4, false);
        $kiri = [];
        $kanan = [];
        foreach ($slice as $key => $value) {
            if ($key % 2 == 0) {
                $kiri[] = implode('', $value);
            } else {
                $kanan[] =  implode('', $value);
            }
        }
        array_push($result['data'], [
            'type' => 'Lucky Prizes',
            'value' => $kiri
        ]);
        array_push($result['data'], [
            'type' => 'Consolation Prizes',
            'value' => $kanan
        ]);
        return $result;
    }


    //chinaOK
    public static function parsingChina()
    {
        $filename = 'china.html';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = trim($doc->find('p')[0]->text());
        $result['data'] = [];

        //   3 table parsing
        $table1 = $doc->find('table#table_home_1')[0];
        $table2 = $doc->find('table#table_home_2')[0];
        $table3 = $doc->find('table#table_home_3')[0];

        // table 1 prose
        foreach ($table1->find('tr') as $tr) {
            $td =  $tr->find('td');
            array_push($result['data'], [
                'type' => $td[0]->text(),
                'value' => $td[1]->text(),
                // 'value' => str_split($td[1]->text(), 2),
            ]);
        }

        // table 2 proses

        $bakul = [];
        foreach ($table2->find('td') as $td) {
            // $bakul[] .= trim($td->text());
            array_push($bakul, $td->text());
            // array_push($bakul, str_split($td->text(), 2));
        }
        array_push(
            $result['data'],
            [
                'type' => trim($table2->find('caption')[0]->text()),
                'data' => $bakul
            ]
        );
        $bakul = [];
        foreach ($table3->find('td') as $td) {
            // $bakul[] .= trim($td->text());
            array_push($bakul, $td->text());
            // array_push($bakul, str_split($td->text(), 2));
        }
        array_push(
            $result['data'],
            [
                'type' => trim($table3->find('caption')[0]->text()),
                'data' => $bakul
            ]
        );







        return $result;
    }

    // taiwan OK
    public static function parsingTaiwan()
    {
        // tentuin web / file yang mau di parsing
        $filename = 'taiwan.html';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);

        $table =  $doc->find('table')[0];
        $result = [];
        $result['periode'] = trim($doc->find('div#periode')[0]->text());
        $result['data'] = [];
        foreach ($table->find('tr') as $tr) {
            $td = $tr->find('td');
            $em = [];
            foreach ($tr->find('em') as $ems) {
                $em[] .=    $ems->text();
                // array_push($em, str_split($ems->text(), 2));
            }




            array_push($result['data'], [
                'type' => $td[1]->text(),
                'value' => implode('', $em)
            ]);
        }

        return $result;
    }

    public static function getData($filename)
    {
        $data = file_get_contents('sample/' . $filename);
        return $data;
    }


    private static function antara($string, $start, $end)
    {
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }

    private static function newDoc($string)
    {
        $document = new Document($string);
        return $document;
    }
    /**
     * list parrsing data
     */
}
