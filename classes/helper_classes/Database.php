<?php
class Database {
    protected $config_db_details;
    protected $host;
    protected $db;
    protected $username;
    protected $password;
    protected $pdo;
    protected $stmt;
    protected $table;
    
    public $debug = true;
    public function __construct(){
        try{
            $this->config_db_details = parse_ini_file(__DIR__."/../../config.ini");
            $this->host = $this->config_db_details['host'];
            $this->db = $this->config_db_details['db'];
            $this->username = $this->config_db_details['username'];
            $this->password = $this->config_db_details['password'];
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->username, $this->password);

            if($this->debug){
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        }catch(PDOException $e){
            die($this->debug? $e->getMessage() : '');
        }
    }

    public function rawQuery($sql){
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }



    public function insert($table, $data){
        $keys = array_keys($data);
        // print_r($keys);
        $fields = "`" . implode("`, `", $keys). "`";

        $placeholders = ":" . implode(", :", $keys);
        //echo $fields;
        // echo "<br>";
        //echo $placeholders;

        $sql = "INSERT INTO {$table} ({$fields}) VALUES({$placeholders})";
        print_r($data);
        echo "<br>";
        
        $this->stmt = $this->pdo->prepare($sql);

        return $this->stmt->execute($data);
    }

    public function lastInsertedID(){
        return $this->pdo->lastInsertId();
    }

    public function prepareColumnString($fields){
        $fieldsString = "";
        $i=0;
        foreach($fields as $column){
            $i++;
            $fieldsString.=$column;
            if($i < count($fields))
                $fieldsString.=",";
            
        }
        return $fieldsString;
    }
    
    public function readData($table,$fields=["*"], $condition="1"){
        $columnNameString = $this->prepareColumnString($fields);
        
        $sql = "SELECT {$columnNameString} from {$table} where {$condition}";
        echo $sql;
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($table,$condition="1"){
        $sql = "update {$table} set deleted = 1 where $condition";
        //echo $sql;
		$this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute();
    }
    
    public function update($table,$data, $condition="1"){
        $i = 0;
		$columnValueSet = "";
		foreach($data as $key=>$value){
			$comma = ($i<count($data)-1 ? ", " : "");
			$columnValueSet .= $key. "='".$value."'".$comma;
			$i++;
		}
		$sql = "update {$table} set {$columnValueSet} where {$condition}";
        echo $sql;
        $this->stmt = $this->pdo->prepare($sql);
        $this->stmt->execute();
        return $this;
    }

    public function exists($table,$data){
        $field = array_keys($data)[0];
        echo "hello";
        $result = $this->readData($table,["*"], "{$field}='{$data[$field]}'");
        if(count($result)>0){
            return true;
        }else{
            return false;
        }
    }

}
// $db = new Database();

//$res = $db->readData("employees",["*"],"1");
//$res2 = $db->delete("employees","first_name='Tanay'");
// $res3 = $db->update("employees",['first_name'=>'Tanay'],"first_name='Tana'");
// echo print_r($res3);