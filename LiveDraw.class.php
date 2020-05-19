<?php

require 'vendor/autoload.php';

use DiDom\Document;
use Didom\Query;
use DiDom\StyleAttribute;

use Jenssegers\Blade\Blade;


class LiveDraw
{
    public function __construct()
    {
    }


    public static function render($template, $data = [])
    {
    }

    public static function parsingMagnum4d()
    {

        $tanggal = date('d-m-Y', strtotime("tomorrow"));
        $url = 'https://webservices.magnum4d.my/results/past/latest-before/' . $tanggal . '/1';
        $result['periode'] = [];
        $result['data'] = [];

        $data = json_decode(@file_get_contents($url), false);
        $part = $data->PastResultsRange->PastResults;

        $result['periode'] = $part->DrawDate;
        array_push($result['data'], [
            'type' => '1st Prize',
            'data' => $part->FirstPrize
        ]);
        array_push($result['data'], [
            'type' => '2nd Prize',
            'data' => $part->SecondPrize
        ]);
        array_push($result['data'], [
            'type' => '3rd Prize',
            'data' => $part->ThirdPrize
        ]);


        $special = [];
        for ($i = 1; $i <= 10; $i++) {
            $rx = 'Special' . $i;
            array_push($special, $part->$rx);
        }
        array_push(
            $result['data'],
            [
                'type' => 'Special Prize',
                'data' => $special
            ]

        );
        $console = [];
        for ($i = 1; $i <= 10; $i++) {
            $rx = 'Console' . $i;
            array_push($console, $part->$rx);
        }

        array_push(
            $result['data'],
            [
                'type' => 'Consolation Prize',
                'data' => $console
            ]

        );

        // print_r($result);
        $blade = new Blade('views', 'cache');
        echo $blade->make('mgn', ['result' => (object) $result])->render();



        //    https://webservices.magnum4d.my/results/past/latest-before/12-05-2020/1

    }

    public static function parsingHongkongSiang()
    {
        // $filename = 'singapore.html';
        $filename = 'HKS';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        $table = $doc->find('table')[4];
        $tr = $table->find('tr');


        // first prize $tr[1]
        // second $tr[3]
        // third $tr[5]
        // starter $tr[5]
        // consol $tr[13]

        $periode = $doc->find('table')[3]->find('span')[0]->text();
        $result['periode'] = str_replace('LIVE DRAW at ', '', $periode);

        $baskom  = '';
        foreach ($tr[1]->find('td') as $td) {
            $baskom .= $td->text();
        }
        $arr = [
            'type' => '1st Prize',
            'value' => $baskom
        ];
        // 2nd
        array_push($result['data'], $arr);
        $baskom  = '';
        foreach ($tr[3]->find('td') as $td) {
            $baskom .= $td->text();
        }
        $arr = [
            'type' => '2nd Prize',
            'value' => $baskom
        ];
        array_push($result['data'], $arr);
        // 3rd
        $baskom  = '';
        foreach ($tr[5]->find('td') as $td) {
            $baskom .= $td->text();
        }
        $arr = [
            'type' => '3rd Prize',
            'value' => $baskom
        ];
        array_push($result['data'], $arr);

        $baskomx = [];
        foreach ($tr[6]->find('table') as $key => $tablex) {
            if ($key != 0) {
                $baskomy = '';
                foreach ($tablex->find('td') as $td) {

                    $baskomy .= $td->text();
                }
                array_push($baskomx, $baskomy);
            }
        }
        $arr = [
            'type' => 'Starter Prize',
            'value' => $baskomx
        ];
        array_push($result['data'], $arr);

        // print_r($baskomx);

        $baskomx = [];
        foreach ($tr[13]->find('table') as $key => $tablex) {
            if ($key != 0) {
                $baskomy = '';
                foreach ($tablex->find('td') as $td) {

                    $baskomy .= $td->text();
                }
                array_push($baskomx, $baskomy);
            }
        }
        $arr = [
            'type' => 'Consolation Prize',
            'value' => $baskomx
        ];
        array_push($result['data'], $arr);

        $blade = new Blade('views', 'cache');
        echo $blade->make('hkd', ['result' => (object) $result])->render();
        // print_r($result);
    }
    public static function parsingHongkongx()
    {
        // $filename = 'singapore.html';
        $filename = 'HKX';

        $htmlString =  self::getData($filename);


        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        $table = $doc->find('table')[0];
        $trx = $table->find('tr');
        // foreach ($table->find('tr') as $key => $tr) {
        //     print_r($key . "\n" . $tr->html() . "\n================\n");
        // }




        // 1st prize
        $tdFirstPrize = $trx[2]->find('td');
        $arr = [
            'type' => $tdFirstPrize[0]->text(),
            'value' => $tdFirstPrize[1]->text()
        ];
        array_push($result['data'], $arr);
        // 2nd
        $tdFirstPrize = $trx[3]->find('td');
        $arr = [
            'type' => $tdFirstPrize[0]->text(),
            'value' => $tdFirstPrize[1]->text()
        ];
        array_push($result['data'], $arr);

        $result['periode'] = trim($trx[1]->text());
        // 3rd
        $tdFirstPrize = $trx[4]->find('td');
        $arr = [
            'type' => $tdFirstPrize[0]->text(),
            'value' => $tdFirstPrize[1]->text()
        ];
        array_push($result['data'], $arr);

        // starter

        $starter = [];
        foreach ($trx[6]->find('td') as $td) {

            array_push($starter, trim($td->text()));
        }

        $arr = [
            'type' => 'Starter Prize',
            'value' => $starter
        ];
        array_push($result['data'], $arr);

        $consol = [];
        for ($i = 9; $i < 11; $i++) {

            foreach ($trx[$i]->find('td') as $td) {

                array_push($consol, trim($td->text()));
            }
        }

        $arr = [
            'type' => 'Consolation Prize',
            'value' => $consol
        ];
        array_push($result['data'], $arr);






        $result['periode'] = trim($trx[1]->text());


        // print_r($result);

        $blade = new Blade('views', 'cache');
        echo $blade->make('hk', ['result' => (object) $result])->render();

        // print_r($tr[0]->html());





        // print_r($tr[0]->html());


    }
    public static function parsingHongkong()
    {
        // $filename = 'singapore.html';
        $filename = 'HKX';

        $htmlString =  self::getData($filename);
        echo $htmlString;
        die;
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];



        $table = $doc->find('table');
        $tr =  $table[1]->find('table')[1]->find('tr');
        $periode = explode(' at', str_replace('LIVE DRAW ', '', $tr[0]->find('td')[0]->text()));
        $result['periode'] = $periode[0];

        for ($i = 1; $i < 4; $i++) {
            $prizes = [];
            foreach ($tr[$i]->find('span.hkball') as $ball) {
                array_push($prizes, trim($ball->text()));
            }
            $arr = [
                'type' => trim($tr[$i]->find('td')[0]->text()),
                'value' => implode('', $prizes)
            ];

            array_push($result['data'], $arr);
        }
        // starter
        $type = trim($tr[4]->find('td')[0]->text());
        $prizez = [];
        foreach ($tr[4]->find('table')[0]->find('td') as $td) {
            $prizes = '';
            foreach ($td->find('span.hkball') as $hkball) {
                // return $hkball->text();
                $prizes .= $hkball->text();
            }
            array_push($prizez, $prizes);
        }


        $arr = [
            'type' => $type,
            'value' => $prizez
        ];
        array_push($result['data'], $arr);

        // consolation
        $type = trim($tr[6]->find('td')[0]->text());
        $prizez = [];
        foreach ($tr[6]->find('table')[0]->find('td') as $td) {
            $prizes = '';
            foreach ($td->find('span.hkball') as $hkball) {
                // return $hkball->text();
                $prizes .= $hkball->text();
            }
            array_push($prizez, $prizes);
        }


        $arr = [
            'type' => $type,
            'value' => $prizez
        ];
        // print_r($arr);

        array_push($result['data'], $arr);


        // for ($i = 4; $i < 6; $i++) {
        //     $type = trim($tr[$i]->find('td')[0]->text());
        //     $prizez = [];
        //     foreach ($tr[$i]->find('table')[0]->find('td') as $td) {
        //         $prizes = '';
        //         foreach ($td->find('span.hkball') as $hkball) {
        //             // return $hkball->text();
        //             $prizes .= $hkball->text();
        //         }
        //         array_push($prizez, $prizes);
        //     }


        //     $arr = [
        //         'type' => $type,
        //         'value' => $prizez
        //     ];
        //     print_r($arr);

        //     // array_push($result['data'], $arr);
        // }

        // print_r($result);


        $blade = new Blade('views', 'cache');
        echo $blade->make('hk', ['result' => (object) $result])->render();
    }
    public static function parsingSingapore45()
    {
        // $filename = 'singapore.html';
        $filename = 'Singapore45';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = null;
        $result['data'] = null;

        if ($doc->has('div#winner')) {

            $winner = $doc->find('div#winner')[0];
            $table = $winner->find('table')[0];
            $imgs = '';

            foreach ($table->find('tr') as $key => $value) {

                if ($key == 0) {
                    $result['periode'] =  trim($value->text());
                } elseif ($key == 2) {

                    // return $value->html();
                    foreach ($value->find('img') as $img) {
                        $imgs .= self::antara($img->src, 'image/', '.');
                    }
                } elseif ($key == 3) {

                    foreach ($value->find('img') as $img) {
                        $imgs .= self::antara($img->src, 'image/', '.');
                    }
                }
            }
            $result['data'] = str_split($imgs, 2);
        } else if ($doc->has('div#fourd')) {
            $fourd =  $doc->find('div#fourd')[0];

            $table = $fourd->find('table');
            $table1  = $table[0];

            $table2  = $table[1];
            $table3  = $table[2];
            $result['periode'] = '';

            foreach ($table1->find('tr') as $tr) {
                $arr = [
                    'type' => trim($tr->find('th')[0]->text()) . ' Prize',
                    'value' => trim($tr->find('td')[0]->text())
                ];

                array_push($result['data'], $arr);
            }


            $type = trim($table2->find('th')[0]->text());
            $prizes = [];
            foreach ($table2->find('td') as $td) {
                array_push($prizes, trim($td->text()));
            }
            $arr = [
                'type' => $type . ' Prizes',
                'value' => $prizes
            ];
            array_push($result['data'], $arr);



            $type = trim($table3->find('th')[0]->text());
            $prizes = [];
            foreach ($table3->find('td') as $td) {
                array_push($prizes, trim($td->text()));
            }
            $arr = [
                'type' => $type . ' Prizes',
                'value' => $prizes
            ];
            array_push($result['data'], $arr);
        }



        $blade = new Blade('views', 'cache');
        echo  $blade->make('sgp45', ['result' => (object) $result])->render();
    }
    public static function parsingQatar()
    {

        $filename = 'QTR';
        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        // $table = $doc->find('tbody');
        // $trx = $table->find('tr');
        // foreach ($doc->find('tbody') as $key => $tr) {
        //     print_r($key . "\n" . $tr->html() . "\n================\n");
        // }

        // print_r($table->html());
        $tbody =  $doc->find('tbody');
        foreach ($tbody[0]->find('tr') as $tr) {
            $td = $tr->find('td');
            $arr = [
                'type' => $td[0]->text(),
                'data' => $td[1]->find('span')[0]->text()
            ];
            array_push($result['data'], $arr);
        }
        $starter = [];
        foreach ($tbody[1]->find('td') as $key => $td) {
            array_push($starter, $td->find('span')[0]->text());
        }

        $arr = [
            'type' => 'Starter Prize',
            'data' => $starter
        ];
        array_push($result['data'], $arr);

        $result['periode'] = $doc->find('thead.thead-dark')[0]->find('th')[0]->text();

        $blade = new Blade('views', 'cache');
        echo $blade->make('qtr', ['result' => (object) $result])->render();
    }
    public static function parsingSingaporeMetro()
    {
        // $filename = 'singapore.html';
        $filename = 'SGM';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        $table =  $doc->find('table')[6];



        $tableUtama = $table->find('table')[2];

        $result['periode'] = $table->find('span.span1')[1]->text();


        foreach ($tableUtama->find('td') as $td) {
            $arr = [
                'type' => $td->find('span')[0]->text(),
                'data' => $td->find('span')[1]->text()
            ];
            array_push($result['data'], $arr);
        }




        $tableSecond = $table->find('table')[4];


        $starter = [];
        $consol = [];
        foreach ($tableSecond->find('tr') as $tr) {
            $td =  $tr->find('td');

            array_push($starter, $td[0]->text());
            array_push($starter, $td[1]->text());
            array_push($consol, $td[2]->text());
            array_push($consol,  $td[3]->text());
        }
        $arr = [
            'type' => 'Starter Prizes',
            'data' => $starter
        ];
        array_push($result['data'], $arr);
        $arr = [
            'type' => 'Consolation Prizes',
            'data' => $consol
        ];
        array_push($result['data'], $arr);

        $blade = new Blade('views', 'cache');
        echo $blade->make('sgm', ['result' => (object) $result])->render();
        // print_r($result);
    }
    public static function parsingSingapore()
    {
        // $filename = 'singapore.html';
        $filename = 'Singapore';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        $li =  $doc->find('li')[0];
        $table = $li->find('table');

        $table1  = $table[0];
        $table2  = $table[1];
        $table3  = $table[2];
        $result['periode'] = $table1->find('thead')[0]->find('th')[0]->text();
        foreach ($table1->find('tbody')[0]->find('tr') as $tr) {
            $arr = [
                'type' => trim($tr->find('th')[0]->text()),
                'data' => trim($tr->find('td')[0]->text())
            ];

            array_push($result['data'], $arr);
        }

        $type = trim($table2->find('th')[0]->text());
        $prizes = [];
        foreach ($table2->find('tbody')[0]->find('td') as $td) {
            array_push($prizes, trim($td->text()));
        }
        $arr = [
            'type' => $type,
            'data' => $prizes
        ];
        array_push($result['data'], $arr);
        $type = trim($table3->find('th')[0]->text());
        $prizes = [];
        foreach ($table3->find('tbody')[0]->find('td') as $td) {
            array_push($prizes, trim($td->text()));
        }
        $arr = [
            'type' => $type,
            'data' => $prizes
        ];
        array_push($result['data'], $arr);




        $blade = new Blade('views', 'cache');
        echo $blade->make('sgp', ['result' => (object) $result])->render();
        // return $result;
        // return $table->html();
    }
    public static function parsingMalaysia()
    {
        // $filename = 'sydney.html';
        $filename = 'MY';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        $table = $doc->find('table');
        // $trx = $table->find('tr');
        // foreach ($doc->find('table') as $key => $tr) {
        //     print_r($key . "\n" . $tr->html() . "\n================\n");
        // }



        $siang = $table[5];
        $starter = [];
        $consol = [];
        foreach ($siang->find('tr') as $key => $tr) {
            if ($key == 0) {
            } elseif ($key == 1) {
                $td = $tr->find('td');
                $arr = [
                    'type' => '1st Prize',
                    'data' => $td[1]->find('span')[0]->text()
                ];
                array_push($result['data'], $arr);
                $arr = [
                    'type' => '2nd Prize',
                    'data' => $td[2]->find('span')[0]->text()
                ];
                array_push($result['data'], $arr);
                $arr = [
                    'type' => '3rd Prize',
                    'data' => $td[3]->find('span')[0]->text()
                ];
                array_push($result['data'], $arr);
            } elseif ($key == 2 || $key == 3) {
                foreach ($tr->find('span') as $span) {
                    // echo $span->text();
                    array_push($starter, trim($span->text()));
                }
            } else {
                foreach ($tr->find('span') as $span) {
                    // echo $span->text();
                    array_push($consol, trim($span->text()));
                }
            }
        }

        $arr = [
            'type' => '4th Prize',
            'data' => $starter
        ];
        array_push($result['data'], $arr);

        $arr = [
            'type' => '5h Prize',
            'data' => $consol
        ];
        array_push($result['data'], $arr);

        $result['periode'] = $doc->find('span.title1')[0]->text();

        // foreach ($doc->find('span.span1') as $key => $value) {
        //     echo $value . "\n";
        // }

        $blade = new Blade('views', 'cache');
        echo $blade->make('my', ['result' => (object) $result])->render();
    }

    public static function removeSpace($string)
    {
        $string = preg_replace('/\s+/', '', $string);

        return $string;
    }

    public static function parsingMalaysiaDay()
    {
        // $filename = 'sydney.html';
        $filename = 'MY';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        $table = $doc->find('table');
        // $trx = $table->find('tr');
        // foreach ($doc->find('table') as $key => $tr) {
        //     print_r($key . "\n" . $tr->html() . "\n================\n");
        // }



        $siang = $table[4];
        $starter = [];
        $consol = [];
        foreach ($siang->find('tr') as $key => $tr) {
            if ($key == 0) {
            } elseif ($key == 1) {
                $td = $tr->find('td');
                $arr = [
                    'type' => '1st Prize',
                    'data' => $td[1]->find('span')[0]->text()
                ];
                array_push($result['data'], $arr);
                $arr = [
                    'type' => '2nd Prize',
                    'data' => $td[2]->find('span')[0]->text()
                ];
                array_push($result['data'], $arr);
                $arr = [
                    'type' => '3rd Prize',
                    'data' => $td[3]->find('span')[0]->text()
                ];
                array_push($result['data'], $arr);
            } elseif ($key == 2 || $key == 3) {
                foreach ($tr->find('span') as $span) {
                    // echo $span->text();
                    array_push($starter, trim($span->text()));
                }
            } else {
                foreach ($tr->find('span') as $span) {
                    // echo $span->text();
                    array_push($consol, trim($span->text()));
                }
            }
        }

        $arr = [
            'type' => '4th Prize',
            'data' => $starter
        ];
        array_push($result['data'], $arr);

        $arr = [
            'type' => '5th Prize',
            'data' => $consol
        ];
        array_push($result['data'], $arr);

        $result['periode'] = $doc->find('span.title1')[0]->text();

        // foreach ($doc->find('span.span1') as $key => $value) {
        //     echo $value . "\n";
        // }

        $blade = new Blade('views', 'cache');
        echo $blade->make('my', ['result' => (object) $result])->render();
    }
    public static function parsingSydneyx()
    {
        // $filename = 'sydney.html';
        $filename = 'SDX';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        $table = $doc->find('table')[0];
        $trx = $table->find('tr');
        // foreach ($table->find('tr') as $key => $tr) {
        //     print_r($key . "\n" . $tr->html() . "\n================\n");
        // }


        // 1st prize
        $tdFirstPrize = $trx[3]->find('td');
        $arr = [
            'type' => $tdFirstPrize[0]->text(),
            'data' => $tdFirstPrize[1]->text()
        ];
        array_push($result['data'], $arr);
        // 2nd
        $tdFirstPrize = $trx[4]->find('td');
        $arr = [
            'type' => $tdFirstPrize[0]->text(),
            'data' => $tdFirstPrize[1]->text()
        ];
        array_push($result['data'], $arr);

        $result['periode'] = trim($trx[1]->text());
        // 3rd
        $tdFirstPrize = $trx[5]->find('td');
        $arr = [
            'type' => $tdFirstPrize[0]->text(),
            'data' => $tdFirstPrize[1]->text()
        ];
        array_push($result['data'], $arr);
        // starter
        $tdFirstPrize = $trx[7]->find('td');

        $arr = [
            'type' => 'Starter Prize',
            'data' => $tdFirstPrize[0]->text()
        ];
        array_push($result['data'], $arr);
        // consol
        $tdFirstPrize = $trx[9]->find('td');
        $arr = [
            'type' => 'Consolation Prize',
            'data' => $tdFirstPrize[0]->text()
        ];
        array_push($result['data'], $arr);



        $blade = new Blade('views', 'cache');
        echo $blade->make('sd', ['result' => (object) $result])->render();
    }
    public static function parsingSydney()
    {
        // $filename = 'sydney.html';
        $filename = 'Sydney';

        $htmlString =  self::getData($filename);
        $doc = self::newDoc($htmlString);
        $result = [];
        $result['periode'] = [];
        $result['data'] = [];

        $result['periode'] =  $doc->find('table')[0]->find('td')[0]->text();
        $table =  $doc->find('table')[1];
        // return $table->html();

        foreach ($table->find('tr') as $key => $value) {
            // echo  $value->html();
            foreach ($value->find('tr') as  $tr) {



                $angka = [];
                foreach ($tr->find('img') as $img) {
                    array_push($angka, self::antara($img->src, '_', '.jpg'));
                }
                $angka = implode('', $angka);
                $arr = [
                    'type' => trim($tr->find('td')[0]->text()),
                    'data' => $angka
                ];
                if (trim($tr->find('td')[0]->text()) !== '') {

                    array_push($result['data'], $arr);
                }
            }
            // if ($key == 0) {
            //     // return $value->html();
            //     // $result['periode'] = trim($value->text());
            // } else if ($key == 1) {

            // } else {
            //     // return $value->html();
            //     if ($value->has('table')) {

            //         foreach ($value->find('table')[0]->find('tr') as  $tr) {


            //             $angka = [];
            //             foreach ($tr->find('img') as $img) {
            //                 array_push($angka, self::antara($img->src, '_', '.jpg'));
            //             }
            //             $angka = implode('', $angka);
            //             $arr = [
            //                 'type' => trim($tr->find('td')[0]->text()),
            //                 'value' => $angka
            //             ];
            //             if (trim($tr->find('td')[0]->text()) !== '') {

            //                 array_push($result['data'], $arr);
            //             }
            //         }
            //     }
            // }
        }

        // return $result;
        $blade = new Blade('views', 'cache');
        echo $blade->make('sd', ['result' => (object) $result])->render();
    }
    public static function parsingSydney4d()
    {
        $filename = 'sydney4d.html';
        $filename = 'Sydney4D';

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
                'data' => implode('', $value)
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
            'data' => $angkatengah
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
            'data' => $angkaakhir
        ]);

        // return $angkaakhir;
        // return $result;
        $blade = new Blade('views', 'cache');
        echo $blade->make('syd', ['result' => (object) $result])->render();
    }

    //  cambodia

    public static function parsingCambodia()
    {
        // $filename = 'cambodia.html';
        $filename = 'Cambodia';

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
        // return $result;


        $blade = new Blade('views', 'cache');
        echo  $blade->make('cambodia', ['result' => (object) $result])->render();
    }


    //chinaOK
    public static function parsingChina()
    {
        // $filename = 'china.html';
        $filename = 'China';

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







        // return $result;
        $blade = new Blade('views', 'cache');
        echo $blade->make('chn', ['result' => (object) $result])->render();
    }

    // taiwan OK
    public static function parsingTaiwan()
    {
        // tentuin web / file yang mau di parsing
        // $filename = 'taiwan.html';
        $filename = 'Taiwan';



        $htmlString =  self::getData($filename);

        // var_dump($htmlString);
        $doc = self::newDoc($htmlString);


        // return $doc->html();
        $table =  $doc->find('table')[0];

        // return $table->html();
        $result = [];
        $result['periode'] = trim($doc->find('div#periode')[0]->text());
        $result['data'] = [];
        foreach ($table->find('tr') as $tr) {

            $td = $tr->find('td');
            $em = [];
            foreach ($tr->find('em') as $ems) {
                // return $ems;
                $em[] .=    $ems->text();
                // array_push($em, str_split($ems->text(), 2));
            }




            array_push($result['data'], [
                'type' => $td[1]->text(),
                'data' => implode('', $em)
            ]);
        }
        // print_r((object)$result);
        // die;

<<<<<<< HEAD


=======


>>>>>>> b83a6edb691ad12a4456bd55b6e0297376bbac6e
        $blade = new Blade('views', 'cache');
        echo  $blade->make('tw', ['result' => (object) $result])->render();
    }

    public static function parsingTest($kode)
    {
        $kode = strtolower($kode);
        $url = self::kocokSource($kode);
        $htmlString = file_get_contents($url);
        // print_r($htmlString);


        $doc = self::newDoc($htmlString);
        // $doc = $doc->find('body')[0];
        $linkText =  $doc->find('a')[0]->text();
        $domElement = new DOMElement('a', $linkText);
        $doc->first('img')->remove();
        $doc->first('a')->replace($domElement);

        echo  $doc->find('table')[0]->html();
    }

    public static function kocokSource($name)
    {
        $array = [
            'singapore' => 'http://104.248.155.224/live-draw-sgp/res-sgp.php',
            'paris' => 'http://104.248.155.224/result-paris/paris-today.php',
            'canada' => 'http://104.248.155.224/live-draw-canada/res-canada.php',
            'portugal' => 'http://104.248.155.224/live-draw-portugal/res-portugal.php',
            'la' => 'http://104.248.155.224/live-draw-los-angeles/res-la.php',
            'barcelona' => 'http://104.248.155.224/live-draw-barcelona/res-barcelona.php',
            'liverpool' => 'http://104.248.155.224/live-draw-liverpool/res-liverpool.php',
            'washington' => 'http://104.248.155.224/live-draw-washington/res-washington.php',
            'seoul' => 'http://104.248.155.224/live-draw-seoul/res-seoul.php',
            'sydney' => 'http://104.248.155.224/live-draw-sydney/res-syd.php',
            'sd' =>   'http://104.248.155.224/live-draw-sydney/res-syd.php',
            'manchester' => 'http://104.248.155.224/live-draw-manchester/res-manchester.php',
            'shanghai' => 'http://104.248.155.224/live-draw-shanghai/res-shanghai.php',
            'hochiminh' => 'http://104.248.155.224/live-draw-hochiminh/res-hochiminh.php',
            'bangkok' => 'http://104.248.155.224/live-draw-bangkok/res-bangkok.php',
            'amsterdam' => 'http://104.248.155.224/live-draw-amsterdam/res-amsterdam.php',
            'lasvegas' => 'http://104.248.155.224/live-draw-lasvegas/res-vegas.php',
            'brazil' => 'http://104.248.155.224/live-draw-brazil/res-brazil.php',
            'london' => 'http://104.248.155.224/live-draw-london/res-london.php',
            'tokyo' => 'http://104.248.155.224/live-draw-tokyo/res-tokyo.php',
            'hk' => 'http://104.248.155.224/live-draw-hk/res-hk.php',
            'mexico' => 'http://104.248.155.224/live-draw-mexico/res-mexico.php',

        ];

        return $array[$name];
    }

    public static function getData($filename)
    {
        if (strpos($filename, 'http') !== false) {

            $data = file_get_contents('sample/' . $filename);
        } else {
            $data = self::dataSource($filename);
            $data = file_get_contents($data);
        }
        return $data;
    }


    public static function dataSource($provider)
    {
        $array = [
            "Sydney" => "http://sydneypoolstoday.com/index-menu.php", //ok
            // "Singapore" => "http://www.singaporepools.com.sg/en/product/Pages/4d_results.aspx",
            "Singapore" => "http://www.singaporepools.com.sg/DataFileArchive/Lottery/Output/fourd_result_top_draws_en.html", // ok
            "Hongkong" => "https://www.hongkongpools.com/live",
            "Singapore45" => "http://www.sg45toto.com/pc-home2.asp", //ok
            "Sydney4D" => "http://www.sydneypools.info/home", // ok
            "Cambodia" => "http://www.magnumcambodia.com/index-menu.php", //ok
            "China" => "http://www.chinapools.asia/home.php", // ok
            "Taiwan" => "http://www.taiwanlottery.net/livedraw.php", //ok
            // tambahan

            "SDX" => "http://104.248.155.224/live-draw-sydney/res-syd.php",
            "HKX" => "http://104.248.155.224/live-draw-hk/res-hk.php",
            "HKS" => "http://www.hkpools1.com/live",
            // "SGM" => "http://www.sgmetro.com/resultsg.php",
            "SGM" => "http://www.sgmetro.com/livesg.php",
            "QTR" => "http://94.237.84.99/livedraw/qatar",
            'MY' => "http://www.malaysialottery.net/"
        ];

        return $array[$provider];
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
