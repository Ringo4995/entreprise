<?php

function separation()
{
    echo "<br><br><br>";
}

function valideDate($date, $format = 'y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    if ($d && $d->format($format) == $date) {
        return true;
    } else {
        return false;
    }
}

function convertirstrtotime($date)
{
    $date = strtotime($date);
    $date = date("y-m-d", $date);
    return $date;
}
