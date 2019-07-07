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

    /**
     * @Author pizepei
     * @Created 2019/7/7 8:58
     * @param $path
     * @title  删除文件夹以及文件夹下的所有文件
     * @explain 清空文件夹函数和清空文件夹后删除空文件夹函数的处理
     */
    public static function deldir($path)
    {
        //如果是目录则继续
        if(is_dir($path)){
            //扫描一个文件夹内的所有文件夹和文件并返回数组
            $p = scandir($path);
            foreach($p as $val){
                //排除目录中的.和..
                if($val !="." && $val !=".."){
                    //如果是目录则递归子目录，继续操作
                    if(is_dir($path.$val)){
                        //子目录中操作删除文件夹和文件
                        static::deldir($path.$val.'/');
                        //目录清空后删除空文件夹
                        @rmdir($path.$val.'/');
                    }else{
                        //如果是文件直接删除
                        unlink($path.$val);
                    }
                }
            }
        }

    }




}