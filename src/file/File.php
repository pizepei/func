<?php
/**
 * Created by PhpStorm.
 * User: 84873
 * Date: 2018/7/28
 * Time: 15:07
 * @title 文件类
 */
namespace pizepei\func\file;

class File
{

    /**
     *  判断目录是否存在
     * 不存在创建
     * @param $dir
     * @param int $mode
     * @return bool
     */
    public static function createDir($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode,true)) return TRUE;
        if (!static::createDir(dirname($dir), $mode)) return FALSE;
        return @mkdir($dir, $mode,true);
    }

    protected $arr = array();
    function findFile($flodername, $filename)
    {
        if (!is_dir($flodername)) {
            return "不是有效目录";
        }
        if ($fd = opendir($flodername)) {
            while($file = readdir($fd)) {
                if ($file != "." && $file != "..") {
                    echo $newPath = $flodername.'/'.$file;
                    if (is_dir($newPath)) {
                        $this->findFile($newPath, $filename);
                    }
                    if ($file == $filename) {
                        $this->arr[] = $newPath;
                    }
                }
            }
        }
        return $this->arr;

    }






}