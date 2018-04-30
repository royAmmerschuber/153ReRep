<?php
/**
 * Created by PhpStorm.
 * User: Roy
 * Date: 14/03/2018
 * Time: 11:14
 */

class Uploader
{
    public Static $THUMB_LOC="media/thumbnail/";
    public Static $VIDEO_LOC="media/video/";

    public static function upload($file, $folder){
        $p=pathinfo($file["name"]);
        $filename=$p["filename"];
        $num=0;
        $fileExt=$p["extension"];
        while(file_exists($folder.$filename.$num.".".$fileExt)){
            $num++;
        }
        $newFile=$folder.$filename.$num.".".$fileExt;
        if(move_uploaded_file($file["tmp_name"], $newFile)){
            return $filename.$num.".".$fileExt;
        }else{
            return "";
        }
    }

    public static function checkImage($file){
        if(getimagesize($file["tmp_name"])===false){
//            echo "not Image";
            return false;
        }
        $finfo=finfo_open(FILEINFO_MIME_TYPE);
        $type=finfo_file($finfo,$file["tmp_name"]);;
        //echo $file["name"]."\n";
        //echo $type."\n";
        if($type!="image/jpeg"&&
            $type!="image/png"&&
            $type!="image/gif"
        ){
            //echo "not right format";
            return false;

        }
        return true;
    }
    public static function checkVideo($file){
        $finfo=finfo_open(FILEINFO_MIME_TYPE);
        $type=mime_content_type($file["tmp_name"]);;
        //echo $type;
        if(strstr($type,"video/")===false&&
            strstr($type,"audio/")===false&&
            strstr($type,"image/")===false
        ){
            //echo "not a video";
            return false;
        }
        return true;
    }
}