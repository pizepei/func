<?php
/**
 * Created by PhpStorm.
 * User: 84873
 * Date: 2018/7/30
 * Time: 17:10
 */

namespace pizepei\func\str;


class Str
{
    /**
     * 判断大小写
     * @param $str
     */
    public function checkcase($str)
    {
        if (preg_match('/^[a-z]+$/', $str)) {
            //echo '小写字母';
            return false;
        } elseif (preg_match('/^[A-Z]+$/', $str)) {
            //echo '大写字母';
            return true;
        }
    }

    /**
     * 获取随机数字
     * @param $length
     * @param $crypto_strong
     */
    public static function int_rand($length,$one='')
    {
        $str = self::random_pseudo_bytes(32,10,$one);
        $strlen = strlen($str)-1;
        $results = '';
        for($i=1;$i<=$length;$i++){
            $results  .= $str{mt_rand(0,$strlen)};
        }


        return $results;
    }
    /**
     * 获取随机字符串
     * @param $length
     * @throws \Exception
     */
    public static function str_rand($length,$one='')
    {
        return $str = self::random_pseudo_bytes(32,16,$one);
    }

    /**
     * 随机
     * @param int    $length
     * @param int    $tobase
     * @param string $one
     * @return string
     * @throws \Exception
     */
    public static function random_pseudo_bytes($length=32,$tobase=16,$one='')
    {
        if(function_exists('openssl_random_pseudo_bytes')){
            $str = openssl_random_pseudo_bytes($length,$crypto_strong);
            if(!$crypto_strong){ throw new \Exception('请检测系统环境');}
            return $tobase==16?md5(bin2hex($one.$str)):base_convert(md5(bin2hex($one.$str)),16,$tobase);
        }else{
            $str = md5($one.str_replace('.', '', uniqid(mt_rand(), true)));
            return $tobase==16?$str:base_convert($one.$str,16,$tobase);
        }
    }

    /**
     *生成uuid方法
     * @param bool $strtoupper 是否大小写
     * @param int  $separator 分隔符  45 -       0 空字符串
     * @param bool $parameter true 是否使用空间配置分布式时不同机器上使用不同的值
     * @return string
     */
    public static function getUuid($strtoupper=false,$separator=45,$parameter=false)
    {
        $charid = md5(($parameter?$parameter:mt_rand(10000,99999)).uniqid(mt_rand(), true));
        if($strtoupper){$charid = strtoupper($charid);}
        $hyphen = chr($separator);// "-"
        $uuid = substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12);
        return $uuid;
    }

}