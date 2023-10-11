<?php

namespace App\Service;

class FunctionService
{

    public function encodepassword()
    {

        $chars = "1234ABCDRUJLQOOCE56789";
        return substr(str_shuffle($chars), 0, 8);
    }

    public function encoderef()
    {

        $chars = "1234ABCDRUJLQOOCE56789";
        return substr(str_shuffle($chars), 0, 4);
    }
    public function encodematricule()
    {

        $chars = "123456789";
        return substr(str_shuffle($chars), 0, 4);
    }

    public function annee()
    {

        $mois = date("m");

        if ($mois < 8) { // avant Août
            $fin = date("Y");
            $debut = $fin - 1;
        } else {
            $debut = date("Y");
            $fin = $debut + 1;
        }
        $datev = $debut . '/' . $fin;

        return $datev;
    }

    public function mois()
    {

        $collect = ['JANVIER' . ' ' . date("Y"),
            'FEVRIER' . ' ' . date("Y"), 'MARS' . ' ' . date("Y"), 'AVRIL' . ' ' . date("Y"), 'MAI' . ' ' . date("Y"),
            'JUIN' . ' ' . date("Y"), 'JUILLET' . ' ' . date("Y"), 'AOUT' . ' ' . date("Y"), 'SEPTEMBRE' . ' ' . date("Y"), 'OCTOBRE' . ' ' . date("Y"),
            'NOVEMBRE' . ' ' . date("Y"), 'DECEMBRE' . ' ' . date("Y"),];

        return $collect;

    }
    public function annees()
    {

        $collect = ['15'.' '.'JANVIER' . ' ' . date("Y"),
            '15'.' '.'FEVRIER' . ' ' . date("Y"), '15'.' '.'MARS' . ' ' . date("Y"), '15'.' '.'AVRIL' . ' ' . date("Y"), '15'.' '.'MAI' . ' ' . date("Y"),
            '15'.' '.'JUIN' . ' ' . date("Y"), '15'.' '.'JUILLET' . ' ' . date("Y"), '15'.' '.'AOUT' . ' ' . date("Y"), '15'.' '.'SEPTEMBRE' . ' ' . date("Y"), '15'.' '.'OCTOBRE' . ' ' . date("Y"),
            '15'.' '.'NOVEMBRE' . ' ' . date("Y"), '15'.' '.'DECEMBRE' . ' ' . date("Y"),];

        return $collect;

    }


}
