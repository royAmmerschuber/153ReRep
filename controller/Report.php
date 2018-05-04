<?php
/**
 * Created by PhpStorm.
 * User: Roy
 * Date: 01/05/2018
 * Time: 11:26
 */

class Report
{
    public function index(){
        $this->new();
    }
    public function new(){
        include_once "layout/newReport.php";
    }
    public function newCheck(){
        Auth::securePage();
    }

    public function newCustomer(){
        include_once "layout/newCustomer.php";
    }
    public function newCustomerCheck(){
        Auth::securePage();
        $out=array();
        $out["success"]=false;
        if(isset($_POST["name"])){
            Database::instance()->query("insert into customer(name) values (:name)",array(
                ":name"=>$_POST["name"]
            ));
            $out["success"]=true;
        }else{
            $out["eName"]="name not set";
        }

        echo json_encode($out);
    }

    public function newActivity(){
        include_once "layout/newActivity.php";
    }
    public function checkActivity(){

    }

    public function loadData(){
        Auth::securePage();
        switch($_POST["area"]){
            case "customer":{
                $p=Database::instance()->query("select * from customer");
                $a=$p->fetchAll(PDO::FETCH_ASSOC);
                $o=array();
                foreach ($a as $v){
                    $o[$v["id"]]=$v["name"];
                }
                echo json_encode($o);
            }break;
        };
    }
}