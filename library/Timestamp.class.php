<?php
namespace library;

class Timestamp {
    /* 
    Un rappel des formats accessibles
    Type    Complet     Sans zéro
    Année   Y           y
    Mois    m           n
    Jour    d           j           N (1 lundi / 7 dimanche)
    Heure   H           G
    Minute  i
    Seconde s
    */

    public static function formatDateTime($timestamp, $dateformat, $timeformat) {
        $date = self::formatDate($timestamp, $dateformat);
        $time = self::formatHeure($timestamp, $timeformat);
        return $date.($date != '' && $time != '' ? ' à ' : '').$time;
    }

    public static function formatDate($timestamp, $format) {
        $list_mois = array(1 => 'janvier', 2 => 'février', 3 => 'mars', 4 => 'avril', 5 => 'mai', 6 => 'juin', 7 => 'juillet', 8 => 'août', 9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre');
        $list_jours = array(1 => 'lundi', 2 => 'mardi', 3 => 'mercredi', 4 => 'jeudi', 5 => 'vendredi', 6 => 'samedi', 7 => 'dimanche');

        // On cleane certains mots clé
        $format = str_replace('jour', '\j\o\u\r', $format);
        $format = str_replace('mois', '\m\o\i\s', $format);

        // On formatte la date
        $return = date($format, $timestamp);

        // On remplace les mots clés
        $return = str_replace('jour', $list_jours[date('N', $timestamp)], $return);
        $return = str_replace('mois', $list_mois[date('n', $timestamp)], $return);

        // On renvoit la valeur
        return $return;
    }

    public static function formatHeure($timestamp, $format) {
        return date($format, $timestamp);
    }

}