<?php

// use App\Functions\Helpers as Help; se vogliamo usare una funzione Help::'nomefunzione'


namespace App\Functions;

class Helpers
{
    public static function getCsvData($path)
    {
        $file_stream = fopen($path, "r");
        if ($file_stream === false) {
            exit('Cannot open the file' . $path);
        }
        $data = [];
        while ($row = fgetcsv($file_stream)) {
            $data[] = $row;
        }
        fclose($file_stream);
        return $data;
    }

    public static function getStars($number)
    {
        $fullTemplate = '';
        for ($i = 0; $i < 5; $i++) {
            if ($i < $number) {
                $fullTemplate .= '<i class="fa-solid fa-star text-warning hype-text-shadow"></i>';
            } else {
                $fullTemplate .= '<i class="fa-regular fa-star"></i>';
            }
        }
        return $fullTemplate;
    }

    /* TEXT FORMATTER */
    public static function getFormattedWordsWithComma($string)
    {
        $trimmedString = trim($string);
        $wordsArray = explode(' ', $trimmedString);
        $wordsArray = array_filter($wordsArray);
        $formattedString = implode(', ', $wordsArray);

        return $formattedString;
    }

    public static function getInitialsFromWords($string)
    {

        $formattedName = '';
        foreach (explode(' ', $string) as $parola) {
            $formattedName .= strtoupper($parola[0]);
        }

        return $formattedName;
    }

    public static function getRandomValue($array)
    {
        return $array[array_rand($array)];
    }
}
