<?php
$str = '0t2.0.0.0#';
function isValidIP(string $str)
{
    $re = '/[0-9]+/m';
$prov = strpbrk($str, ' ');
$prov2 = strpbrk($str, ',');
    preg_match_all($re, $str, $matches);

    $las = count($matches[0]);
    $last = is_numeric($matches[0]);
    if ($matches[0][0] == '') {
        return false;
    } else {
        foreach ($matches[0] as $mat => $element) {
            $prov3 = ctype_digit($element);
            if ($element <= 255 && $las == 4 && $prov == false && $prov2 == false && $prov3 == true) {

            } else {

                return false;
            }

        }
    }
    return true;
}
var_dump(isValidIP($str));




