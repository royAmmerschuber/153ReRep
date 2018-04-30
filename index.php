<?php
session_start();
foreach(glob('{model/*.php,controller/*.php,helper/*.php}',GLOB_BRACE) as $value){
    include_once $value;
}

//echo $_GET["path"]."\n";
if(!isset($_GET["path"])){
    $_GET["path"]="Main/index";


}

$path=explode("/",$_GET["path"]);
$contr=new $path[0]();
if(isset($path[1])&&method_exists($contr,$path[1])){
    $action=$path[1];
    $contr->$action();
}else{
    $contr->index();
}


