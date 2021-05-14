<?php

/**
 * Imprime as saidas formatadas
 * @param obj $obj, $dump=false, $break=true
 * @return print
 */
function trace($obj, $dump = false, $break = true) {
    print '<pre>';
        ($dump) ? var_dump($obj) : print_r($obj);
    print '</pre>';
    if ($break) exit;
}
