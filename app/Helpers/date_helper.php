<?php

use Carbon\Carbon;

if (!function_exists('formatDateIso')) {
    /**
     * Fungsi untuk memformat date yang bertipe carbon
     *
     * @param  String $date
     * @param  String $format
     * @return string
     */
    function formatDateIso($date, $format = "dddd, D MMMM YYYY HH:mm", $addHours = 0)
    {
        if (!($date instanceof Carbon))
            $date = Carbon::createFromTimeString($date)->addHours($addHours);
        return $date->isoFormat($format);
    }
}


if (!function_exists('eventCanQrCode')) {

    /**
     * suatu event bisa dibuat QR codenya ketika sejam sebelum start date dan sebelum end date
     *
     * @param  Carbon $start
     * @param  Carbon $end
     * @return bool
     */
    function eventCanQrCode(Carbon $start, Carbon $end, $subHour = 0)
    {
        $now = Carbon::now();
        if ($now > $end)
            return false;

        if ($now > $start->subHours($subHour))
            return true;
    }
}

if (!function_exists('eventCanAbsen')) {
    /**
     * eventCanAbsen
     *
     * @param  mixed $start
     * @param  mixed $end
     * @param  mixed $subHour
     * @return bool
     */
    function eventCanAbsen(Carbon $start, Carbon $end, $subHour = 0, $addHour = 1)
    {
        $now = Carbon::now();
        if ($now > $start->subHours($subHour) && $now < $end->addHour($addHour))
            return true;
        return false;
    }
}

if (!function_exists('getGreeting')) {
    /**
     * getGreeting
     *
     * @param  mixed $time
     * @return string
     */
    function getGreeting(Carbon $time = null)
    {
        if ($time) $hour = $time->format('H');
        else $hour = Carbon::now()->format('H');

        if ($hour < 4) return "Selamat Malam";
        else if ($hour < 11) return "Selamat Pagi";
        else if ($hour < 16) return "Selamat Siang";
        else if ($hour < 18) return "Selamat Sore";
        else return "Selamat Malam";
    }
}

if (!function_exists('isPublished')) {
    /**
     * isPublished
     *
     * @param  mixed $time
     * @return bool
     */
    function isPublished(Carbon $time)
    {
        if ($time <= Carbon::now())
            return true;
        return false;
    }
}

if (!function_exists('rawSQLDateTime')) {
    /**
     * rawSQLDateTime to select
     *
     * @param  mixed $time
     * @return string
     */
    function rawSQLDateTime(Carbon $time = null)
    {
        if (!$time) $time = Carbon::now();
        $time = $time->toDateTimeString();
        return "STR_TO_DATE('{$time}', '%Y-%m-%d %H:%i:%s')";
    }
}
