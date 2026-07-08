<?php

namespace App\Models;

use mysqli;

class Model
{
    protected $db_host = DB_HOST;
    protected $db_user = DB_USER;
    protected $db_pass = DB_PASS;
    protected $db_name = DB_NAME;

    protected $connection;
    protected $query;

    protected $table;

    public function __construct(){
        $this->connection();
    }

    public function connection(){

        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if($this->connection->connect_error){
            die("Error de conexión: " . $this->connection->connect_error);
        }

    }

    public function query($sql){
        $this->query = $this->connection->query($sql);

        return $this;
    }

    public function first(){
        return $this->query->fetch_assoc();
    }

    public function get(){
        return $this->query->fetch_all(MYSQLI_ASSOC);
    }

    // CONSULTAS 
    public function all(){
        //SELECT * FROM contacts
        $sql = "SELECT * FROM {$this->table}";

        return $this->query(sql)->get();
    }

    public function find($id)
    {
         //SELECT * FROM contacts WHERE id = 1
        $sql = "SELECT * FROM {$this->table} WHERE id = {$id}";
        return $this->query($sql)->first();
    }

    public function where($column, $operator, $value = null){

        if($value === null){
            $value = $operator;
            $operator = '=';
        }

        $sql = "SELECT * FROM {$this->table} WHERE {$column} {$operator} '{$value}'";
        $this->query($sql);

        return $this;
    }

    public function create($data){
        //INSERT INTO contacts (name, email, phone) VALUES ('', '','')
        $columns = array_keys($data);
        $columns = implode(', ', $columns);

        $values = array_values($data);
        $values = "'" . implode("', '", $values) . "'";

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$values})";

        $this->query($sql);

        $insert_id = $this->connection->insert_id;

        return $this->find($insert_id);
    }

    public function update($id, $data){

        $fields = [];

        foreach ($data as $key => $value){
            $fields[] = "{$key} = '{$value}'";
        }

        $fields = implode(', ', $fields);

        $sql = "UPDATE {$this->table} SET {$fields} WHERE id = {$id}";

        $this->query($sql);

        return $this->find($id);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = {$id}";

        $this->query($sql);
    }
}