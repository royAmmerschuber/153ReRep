<?php
class Database{

    private static $instance = null;
    private $config;
    private $pdo;
    private function __construct(){
        $this->config = parse_ini_file(__DIR__.'/../config/database.ini');
        try{
            $this->pdo = new PDO($this->config['engine'].':host='.$this->config['host'].';dbname='.$this->config['database'],
                $this->config['username'],$this->config['password']);
        }catch (Exception $e){
//            echo $e->getMessage();
            $this->pdo=new PDO($this->config['engine'].
                ':host='.$this->config['host'],
                $this->config['username'],
                $this->config['password']
            );
            $this->pdo->exec("Create Database ".$this->config['database'].";USE ".$this->config['database']);
            $this->seed();
        }


    }

    public static function instance():Database{
        if(Database::$instance == null){
            Database::$instance = new Database();
        }
        return Database::$instance;
    }

    public function connection():PDO{
        return $this->pdo;
    }

    public function query(String $stmt,array $params=array()):PDOStatement{
        $p=$this->pdo->prepare($stmt);
        foreach (array_keys($params) as $key ){
            /*echo "<pre>";
            echo $key;
            echo "</pre>";
            echo "<pre>";
            echo $params[$key];
            echo "</pre>";
            echo "<pre>";
            print_r($params);
            echo "</pre>";*/
            $p->bindParam($key,$params[$key], PDO::PARAM_STR);
        }
        $p->execute();
        return $p;
    }

    private function seed(){
        echo "database seeding";
        $this->pdo->exec(
        "Create table URole(
                    id int not null Primary Key Auto_Increment,
                    level int not null,
                    name varchar(64) not null
                );
                
                Create table `User`(
                    id int not null Primary Key Auto_Increment,
                    roleFK int not null,
                    name varchar(64) not null,
                    password varchar(256),
                    FOREIGN KEY (roleFK) references URole(id) on delete restrict on update restrict
                );
                
                Create table Customer(
                    id int not null Primary Key Auto_Increment,
                    name varchar(64) not null
                );
                
                Create table Report(
                    id int not null Primary Key Auto_Increment,
                    employeeFK int not null,
                    approverFK int,
                    customerFK int,
                    description varchar(256) not null,
                    signature blob,
                    FOREIGN KEY (employeeFK) references `User`(id) on delete cascade on update restrict,
                    FOREIGN KEY (approverFK) references `User`(id) on delete restrict on update restrict,
                    FOREIGN KEY (customerFK) references Customer(id) on delete restrict on update restrict
                );
                
                Create table AType(
                    id int not null Primary Key Auto_Increment,
                    name varchar(64) not null
                );
                
                Create table Location(
                    id int not null Primary Key Auto_Increment,
                    city varchar(64) not null,
                    plz varchar(6) not null,
                    street varchar(64) not null,
                    nr varchar(6) not null
                );
                Create table Activity(
                    id int not null Primary Key Auto_Increment,
                    reportFK int not null,
                    typeFK int not null,
                    locationFK int not null,
                    name varchar(64) not null,
                    FOREIGN KEY (reportFK) references Report(id) on delete cascade on update restrict,
                    FOREIGN KEY (typeFK) references AType(id) on delete restrict on update restrict,
                    FOREIGN KEY (locationFK) references Location(id) on delete restrict on update restrict
                );
                
                Create table Company(
                    id int not null Primary Key Auto_Increment,
                    name varchar(64) not null
                );
                
                Create table Customer_Company(
                    customerFK int not null,
                    companyFK int not null,
                    Primary Key (customerFK,companyFK),
                    FOREIGN KEY (customerFK) references Customer(id) on delete cascade on update restrict,
                    FOREIGN KEY (companyFK) references Company(id) on delete cascade on update restrict
                );
                Create table Company_Location(
                    companyFK int not null,
                    locationFK int not null,
                    Primary Key (locationFK,companyFK),
                    FOREIGN KEY (companyFK) references Company(id) on delete cascade on update restrict,
                    FOREIGN KEY (locationFK) references Location(id) on delete cascade on update restrict
                );
                Create table Coworker(
                    activityFK int not null,
                    employeeFK int not null,
                    Primary Key (activityFK,employeeFK),
                    FOREIGN KEY (activityFK) references Activity(id) on delete cascade on update restrict,
                    FOREIGN KEY (employeeFK) references `User`(id) on delete cascade on update restrict
                );
                insert into URole(level, name) values (0,'employee'),(1,'approver'),(2,'admin');
                insert into `153`.user(roleFK, name) value (3,'admin')"
        );
        //admin password=x
    }

}
?>
