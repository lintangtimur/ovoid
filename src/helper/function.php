<?php

/**
 * dumping variable
 *
 * @param  mixed $var
 * @return mixed
 */
function dd2($var)
{
    die(var_dump($var));
}

/**
 * Generate v4 UUID
 * @return string
 */
function gen_uuid()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),

        // 16 bits for "time_mid"
        mt_rand(0, 0xffff),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand(0, 0x0fff) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand(0, 0x3fff) | 0x8000,

        // 48 bits for "node"
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}

/**
 * generate random MAC Address
 *
 * @return string
 */
function gen_mac()
{
    return implode(':', str_split(substr(md5(mt_rand()), 0, 12), 2));
}
