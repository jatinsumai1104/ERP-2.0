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
            $this->config_db_details = parse_ini_file("http://localhost/oop-php-erp/config.ini");
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

    public function query($sql){
        return $this->pdo->query($sql);
    }

    /**
     * Runs a prepared statement and returns an associative array,
     * @param $sql
     * @return array
     */
    public function fetchAll($sql){
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function table($table){
        $this->table = $table;
        return $this;
    }

    public function insert($data){
        $keys = array_keys($data);

        $fields = "`" . implode("`, `", $keys). "`";

        $placeholders = ":" . implode(", :", $keys);

        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES({$placeholders})";
        
        $this->stmt = $this->pdo->prepare($sql);

        return $this->stmt->execute($data);
    }

    // public function where($field, $operator, $value){
	// 	$this->stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE {$field} {$operator} :value");
		
	// 	$this->stmt->execute(['value' => $value]);

	// 	return $this;
    // }
    
    public function count(){
		return $this->stmt->rowCount();
    }
    
    public function exists($data){
		$field = array_keys($data)[0];

		return $this->where($field, '=', $data[$field])->count() ? true : false;
    }
    
    public function get(){
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	public function first(){
		return $this->get()[0];
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
    
    public function readData($fields=["*"], $condition="1"){
        $columnNameString = $this->prepareColumnString($fields);
        
         $sql = "SELECT {$columnNameString} from {$this->table} where {$condition}";
        // echo $sql;
        $this->stmt = $this->pdo->prepare($sql);
         $this->stmt->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($condition="1"){
        $sql = "update {$this->table} set deleted = 1 where $condition";
        //echo $sql;
		$this->stmt = $this->pdo->prepare($sql);
         $this->stmt->execute();
         return $this;
    }
    
    public function update($data, $condition="1"){
        $i = 0;
		$columnValueSet = "";
		foreach($data as $key=>$value){
			$comma = ($i<count($data)-1 ? ", " : "");
			$columnValueSet .= $key. "='".$value."'".$comma;
			$i++;
		}
		$sql = "update {$this->table} set {$columnValueSet} where {$condition}";
        echo $sql;
        $this->stmt = $this->pdo->prepare($sql);
         $this->stmt->execute();
         return $this;
    }

}
// $db = new Database();

//$res = $db->readData("employees",["*"],"1");
//$res2 = $db->delete("employees","first_name='Tanay'");
// $res3 = $db->update("employees",['first_name'=>'Tanay'],"first_name='Tana'");
// echo print_r($res3);