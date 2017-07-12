<?php
/**
 * Created by PhpStorm.
 * User: LCD
 * Date: 2017/7/12
 * Time: 19:16
 */

function filesDownload($filelist)
{
    //根据时间生成文件名
    $filename = 'download/'.date('YmdH').'.zip';
    $zip = new ZipArchive();
    if($zip->open($filename,ZIPARCHIVE::CREATE)!== true)
    {
        exit('open file failed or create file failed');
    }else{
        foreach($filelist as $val)
        {
            $zip->addFile($val,basename($val));
        }
        $zip->close();

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header('Content-disposition: attachment; filename='.basename($filename)); //文件名
        header("Content-Type: application/zip"); //zip格式的
        header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件
        header('Content-Length: '. filesize($filename)); //告诉浏览器，文件大小
        @readfile($filename);
    }

}

$list = array('images/1.jpg','images/2.png','images/3.jpg');

filesDownload($list);