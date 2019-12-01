<?php

    function curlSetLogin($url, $params = '')
    {
        // создаем new cURL ресурс
        $ch = curl_init();

        // чтобы не вернулся закодированный ответ
        curl_setopt($ch, CURLOPT_ENCODING ,"");

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);    // off false;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if ($params) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }


        // записываем в txt
        curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__. '/cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__. '/cookie.txt');

        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $content = curl_exec($ch);

        // изменяем кодировку
        $content = iconv('windows-1251', 'UTF-8', $content);

        curl_close($ch);

        echo $content;
    }

        if ($_GET['login']) {
            // авторизация при curl
            $url = "https://passport.i.ua/login/?";

            $params =
              [
                '_subm' => 'lform',
                'cpass' =>  '',
                '_url' => 'https://www.i.ua/?_rand=1575154361',
                '_rand' => '',
                'scode' => '3fa4c8b1e3e300ffe7a4112648d9de5f',
                'login' => 'zazeba@i.ua',
                'pass' => 'Dnepr3024',
                'g-token' => '03AOLTBLRUED6u3rJhx46D_Ry3OmyBrdA51yFZt7MR6TIFaKYN13siZzsWAwfsTbjMp0Uaefo5_LtKD9ftGc8DJ8-w5OLQUvmdnZN_erSCX_f90AI_fgINOMhfgyeTTlWcvUzW_T7RJibSyxVfpNnEKKutlBJA0DV_1jVNz8701s4OTW5eOlQAGLZ1RoaBZhDS2bZm8IB829f2SRXBUJ7GmOjlfcONu2Nuqz2I7agPvbpUt2aWtOogPeRiuOqWSZ-3WOpl3eNxPjM8v18Y4bECgyR3kOyP3m6aHQ5wSMdGNY1-vgd74W-IJuK-rdxLv9yZZ-TQ-sXsY53pm9q_397QGsTkmI4gG92vYjsRvrgzMNIXz9Z3yhkoytGksd02HM5n0olDLqrLLzU3cp7zSth7uNKO4IjhREerU_Ya1uN1TiLAhv_Xh3O-N2kSEGqMlY1gR_mqtqGh3zTu2NaYNoDJpu2mn0I9_2_dUVRNrecRRdhFTfe3TeHdjao',

              ];

            curlSetLogin($url, $params);

        } else {

            $url = 'http://catalog.i.ua/site_of_the_day/';
            $content = curlSetLogin($url);
            echo $content;
        }




        // вытягиваем картинки с контента https://olla.ua

        $curl = curl_init();

        // поля для ввода поиска
        $search_str = "shorts for men";

        // url для curl + $search_str если нужно прибавить поле поиска
        $url = "https://olla.ua/muzhchinam/muzhskaya_obuvi/botinki/";

        curl_setopt($curl, CURLOPT_URL, $url);

        // https:??
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        // redirect
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        //https://www.amazon.com/s?k=pc+video+games+2018&ref=nb_sb_noss
        //https://m.media-amazon.com/images/I/81GToTDrV5L._AC_UL320_ML3_.jpg

        $result = curl_exec($curl);

        preg_match_all("!https://olla.ua/image/cache/import_files/[^\s]*?/[^\s]*?_[^\s]*?-270x405.jpg!", $result, $matches);

        // присваиваем ключ по порядку
        $images =array_values(array_unique($matches[0]));

        // выводим в цыкле
        /*foreach ($images as $k => $image) {
            echo "<div>";
            echo "<img src='$images[$k]'><br />";
            echo "</div>";
        }*/

        for ($i = 0, $iMax = count($images); $i < $iMax; $i++) {

            echo '<div>';
            echo    "<img src='$images[$i]'>";
            echo '</div>';
        }

        curl_close($curl);
