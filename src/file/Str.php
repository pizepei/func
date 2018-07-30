<?php
/**
 * Created by PhpStorm.
 * User: 84873
 * Date: 2018/7/30
 * Time: 17:10
 */

namespace pizepei\func\file;


class Str
{
    /**
     * 判断大小写
     * @param $str
     */
    function checkcase($str)
    {
        if (preg_match('/^[a-z]+$/', $str)) {
            //echo '小写字母';
            return false;
        } elseif (preg_match('/^[A-Z]+$/', $str)) {
            //echo '大写字母';
            return true;
        }
    }

}