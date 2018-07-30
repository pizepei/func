<?php
/**
 * Created by PhpStorm.
 * User: pizepei
 * Date: 2018/7/28
 * Time: 11:02
 * 函数方法入口
 */
namespace pizepei\func;

class Func
{

    private static $class = '';
    /**
     * 分类
     */
    public static function M($name)
    {
        $name = explode('.',$name);

        if(count($name) >1){
            return static::$class = 'pizepei\func\\'.$name[0].'\\'.ucfirst($name[1]);
        }else{
            return static::$class = 'pizepei\func\\'.$name[0].'\\'.ucfirst($name[0]);
        }
    }

    /**
     * 使用方法
     */
    public static function F($name)
    {

//        static::$class::class;


    }


}