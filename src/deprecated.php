<?php

namespace Tolkam;

/**
 * Dumps variable into string
 *
 * @deprecated Use \dump()|\dd() instead
 * @param  mixed  $var
 * @param  bool   $log
 * @param  bool   $html
 * @return void
 */
function dump($var, $log = false, $html = true)
{
    ob_start();
    var_dump($var);
    $str = ob_get_clean();

    if ($log) {
        error_log('Tolkam\\dump:' . $str);
    }

    if (!empty(ini_get('display_errors'))) {
        $str = str_replace("]=>\n", "] =>", $str);
        $str = preg_replace('~=> {1,}~', '=> ', $str);

        echo($html ? "<pre>{$str}</pre>" : $str) . "\n";
    }
}
