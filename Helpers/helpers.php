<?php
/**
 * @author selcukmart
 * 1.02.2022
 * 16:29
 */

if(!function_exists('c')){
    function c($v, $return = false)
    {
        if ($return) {
            $output = '<pre>';
        } else {
            echo '<pre>';
        }
        if (is_array($v) || is_object($v)) {
            if ($return) {
                $output .= print_r($v, true);
            } else {
                print_r($v);
            }
        } elseif ($return) {
            $output .= $v;
        } elseif (is_bool($v)) {
            var_dump($v);
        } else {
            echo $v;
        }
        if ($return) {
            $output .= '</pre>';
            return $output;
        }

        echo '</pre>';
    }
}
