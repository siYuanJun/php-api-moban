<?php

function enaddslashes($str = "")
{
    if (get_magic_quotes_gpc() == 1) {
        return $str;
    } else {
        return addslashes($str);
    }
}

function strget($str)
{
    $val = '';
    if (is_array(@$_GET[$str])) {
        $val = enaddslashes(implode(',', @$_GET[$str]));
    } else {
        $val = enaddslashes(@$_GET[$str]) . "";
    }
    return $val;
}

function getapk($keyname)
{
    $key = strget($keyname);
    if (empty($key)) {
        $str = $_SERVER['REQUEST_URI'];
        $str = substr($str, strpos($str, "?") + 1);
        parse_str($str, $arr);
        if (array_key_exists($keyname, $arr)) {
            $key = $arr[$keyname];
        }
    }
    return $key;
}

// STRPOST
function strpost($str)
{
    $val = '';
    if (is_array(@$_POST[$str])) {
        $val = enaddslashes(implode(',', @$_POST[$str]));
    } else {
        $val = enaddslashes(@$_POST[$str]) . "";
    }
    return $val;
}

function filterbadstring($str)
{
    $a = array(
        "\n",
        "\\",
        "\r",
        "\t",
        "'",
        "\"",
        "%",
        ",",
        "(",
        ")",
        "[",
        "]",
        ";",
        "$"
    );
    $b = array(
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        "",
        ""
    );
    return str_replace($a, $b, $str);
}

function json($str)
{
    exit(json_encode($str, JSON_UNESCAPED_UNICODE));
}

function is_not_json($str){
    return is_null(json_decode($str));
}
