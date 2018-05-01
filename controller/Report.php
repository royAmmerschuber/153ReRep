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
        include_once "layout/newReport";
    }
    public function newCheck(){

    }
}