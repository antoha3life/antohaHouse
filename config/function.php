<?php
/**
 * Created by PhpStorm.
 * User: varik
 * Date: 17.12.2018
 * Time: 23:59
 */

function GenerateUUID_OLD($length) // was default 14
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $charsl = strlen($chars);
    $uuid = "";
    $length = min(max($length, 6), 64); // length need to be somthing between 14 and 64

    for($i = 0; $i < $length; $i++)
        $uuid .= $chars[mt_rand(0, $charsl-1)];
    return $uuid;
}

function GenerateUUID($length = 16)
{
    if($length != 16)
        return GenerateUUID_OLD($length);

    $t_in = GenerateUUID_OLD(32).microtime(true);
    $t_in = md5($t_in);

    return MD5ToUUID($t_in);
}

function MD5ToUUID($a_sHashStr)
{
    $t_sMarkStr = '';

    $t_iHashLen = strlen($a_sHashStr);

    if($t_iHashLen %2 != 0)
        return '';

    for ($t_cnt = 0; $t_cnt < $t_iHashLen/2; $t_cnt++)
    {
        try
        {
            $t_symb =  substr($a_sHashStr, $t_cnt*2, 2);

            $t_var = hexdec($t_symb);

            if($t_var > 127)
                $t_var -= 128;

            if($t_var >= 31 && $t_var <= 37)
            {
                if($t_cnt%2 == 0)
                    $t_var *= 2;
                else if($t_cnt%3 == 0)
                    $t_var *= 3;
                else
                    $t_var /= 2;

                $t_var = (int) $t_var;
            }

            if($t_var >= 16 && $t_var <= 30)
                $t_var -= 15;

            if($t_var >= 38 && $t_var <= 47)
                $t_var += 10;

            if($t_var >= 58 && $t_var <= 64)
            {
                if($t_cnt%2 == 0)
                    $t_var -= ($t_var - 57);
                else if($t_cnt%3 == 0)
                    $t_var += (65 - $t_var);
                else $t_var += 2*(65 - $t_var);
            }

            if($t_var >= 91 && $t_var <= 96)
            {
                if($t_cnt%2 == 0)
                    $t_var -= ($t_var - 90);
                else if($t_cnt%3 == 0)
                    $t_var += (97 - $t_var);
                else $t_var += 2*(97 - $t_var);
            }

            if($t_var >= 123 && $t_var <= 127)
            {
                $t_var2 = 127 - $t_var + 1;
                $t_var = 122 - ($t_var2 * $t_var2);

                if($t_cnt%2 == 0)
                    $t_var -= (97-65);
            }

            if($t_var >= 0 && $t_var <= 15)
            {
                $t_hexSymb = '';

                if($t_cnt%2 == 0)
                    $t_hexSymb = sprintf("%x", $t_var);
                else
                    $t_hexSymb = sprintf("%X", $t_var);

                $t_sMarkStr .= $t_hexSymb;
            }
            else if($t_var >= 48 && $t_var <= 57)
                $t_sMarkStr .= chr($t_var);
            else if($t_var >= 65 && $t_var <= 90)
                $t_sMarkStr .= chr($t_var);
            else if($t_var >= 97 && $t_var <= 122)
                $t_sMarkStr .= chr($t_var);
            else
                return ''; ///
        }
        catch (Exception $ex) {
            $a = 1;
        }

    }

    return $t_sMarkStr;
}