<?php
/**
 * Created by PhpStorm.
 * User: Roy
 * Date: 12/03/2018
 * Time: 11:23
 */

class Auth
{
    /**
     * levels:<br>
     *  0-normal user<br>
     *  1-approver<br>
     *  2-admin
     * @param $level
     * @return bool
     */
    public static function securePage($level=0){
        if(!isset($_SESSION["uid"])) {

            echo "<script>window.location.replace(\"/153ReRep/Auth\")</script>";
            return false;


        }else{
            if($_SESSION["ulvl"]>=$level){
                return $_SESSION["uid"];
            }
        }
    }

    public function index(){
        $this->login();
    }

    public function login(){
        include_once "layout/login.php";
    }
    public function loginCheck(){
        $success=false;
        if(isset($_POST["name"]) && isset($_POST["password"])) {
            $valid = true;
            $db=Database::instance();
            $p = $db->query("Select count(*) from user where name=:name",array(
                ":name"=>$_POST["name"])
            );
            $x=$p->fetchColumn(0);
            if ($x == 0) {
                $valid = false;
                $eName = "the User Does not exist".$x;
            }
            $p = $db->query("Select u.*, r.level from user as u left join urole as r on u.roleFK=r.id where name=:name",array(
                ":name"=>$_POST["name"]
            ));
            $u = $p->fetch(PDO::FETCH_ASSOC);
            if (!password_verify($_POST["password"], $u["password"])) {
                $valid = false;
                $ePassword = "the Username or Password is incorrect";
            }

            if ($valid) {
                $_SESSION["uid"] = $u["id"];
                $_SESSION["ulvl"]=$u["level"];
                $success=true;
            }

        } else {
            $eName = "Please fill out the entire form";

        }
        $output=array(
            "eName"=>$eName,
            "ePassword"=>$ePassword,
            "success"=>$success
        );
        echo json_encode($output);
    }

    public function register(){
        include_once "layout/register.php";

    }
    public function registerCheck(){
        Auth::securePage(2);
        $success=false;
        $db=Database::instance();
        $pdo = $db->connection();
        $valid=true;
        if(isset($_POST["name"])&&isset($_POST["role"])&&isset($_POST["password1"])&&isset($_POST["password2"])){
            if($_POST["password1"] != $_POST["password2"]) {
                $valid = false;
                $ePwd2 = "the Passwords do not match";
            }
            $p=$db->query("select count(*) from user WHERE name=:name",array(
                ":name"=>$_POST["name"]
            ));
            if($p->fetchColumn(0)!=0){
                $valid=false;
                $eName="name is already taken";
            }
            if($valid){
                $p = $db->query("INSERT INTO user (name, password,roleFK) VALUE (:name,:password,(select id from urole where name=:role))",array(
                    ":name"=>$_POST["name"],
                    ":password"=>password_hash($_POST["password1"], PASSWORD_DEFAULT),
                    ":role"=>$_POST["role"]
                ));
                $p->execute();
                $success=true;

            }
        }else{
            $eName="there has been some Kind of mistake with the values.Please reload the page and try again";
        }
        //returning errors
        echo json_encode(array(
            "eName"=>$eName,
            "ePwd2"=>$ePwd2,
            "success"=>$success
        ));
    }

    public function logout(){
        session_destroy();
        echo "<script>window.location.replace(\"/WebVideoPlace/\")</script>";
    }

    public function edit(){
        Auth::securePage(0);
        $p=Database::instance()->connection()->prepare("
                select name,email from user where id=:uid");
        $p->bindParam(":uid",$_SESSION["uid"]);
        $p->execute();
        $x=$p->fetch(PDO::FETCH_ASSOC);
        include_once "layout/editUser.php";
    }
    public function editAct(){
        Auth::securePage();
        $pdo=Database::instance()->connection();
        $p=$pdo->prepare("select * from user where id=:uid");
        $p->bindParam(":uid",$_SESSION["uid"]);
        $p->execute();
        $x=$p->fetch(PDO::FETCH_ASSOC);
        if(password_verify($_POST["oPass"],$x["password"])){
            if($_POST["nPass"]==""){
                $_POST["nPass"]=$_POST["oPass"];
            }
            $p=$pdo->prepare("
                update user 
                set name=:name,
                    email=:email,
                    password=:pass 
                where id=:uid"
            );
            $hashword=password_hash($_POST["nPass"],PASSWORD_DEFAULT);
            $p->bindParam(":name",$_POST["name"]);
            $p->bindParam(":email",$_POST["email"]);
            $p->bindParam(":pass",$hashword);
            $p->bindParam(":uid",$_SESSION["uid"]);
            $p->execute();
        }else{
            echo "password does not match";
        }
    }
}