<?php

namespace App;

use \PDO;
use \PDOException;
use \Migration\Migration;
use \Interfaces\DatabaseInterface;

class Database implements DatabaseInterface
{

	private $db_name;
	private $db_user;
	private $db_pass;
	private $db_host;

	public $datass = [];
	private $columss = [];

	private $pdo;
    
	public function __construct($db_name, $db_user="root", $db_pass="", $db_host="localhost"){

		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;
		$this->db_host = $db_host;

	}


	public function db(){

		if(is_null($this->pdo)){
			try{

				$this->pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name","$this->db_user","$this->db_pass");
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}catch(PDOException $e){

				$migration = new Migration();
				$migration->up();
				$migration->seed();

			}

		}


		return $this->pdo;

	}

	public function query($statement, $one=false){

		$request = $this->db()->query($statement);
		$request->setFetchMode(PDO::FETCH_ASSOC);


		if($one){
			
			$datas = $request->fetch();
			return $datas;

		}else{

			$datas = $request->fetchAll();
			return $datas;
		}

	}


	public function prepareQuery($statement, $datas=[], $one=false){

		$re = $this->db()->prepare($statement);

		$re->execute($datas);


		if($one){

			$datas = $re->fetch();

		}else {

			$datas = $re->fetchAll();

		}

		return $datas;

	}

	public function getAll($table)
	{
		$statement = "SELECT * FROM $table";
		return $this->query($statement);
	}


	public function save($statement, $datas){
		$re = $this->db()->prepare($statement);

		return $re->execute($datas);
	}

	public function update($statement, $datas){
		return $this->save($statement, $datas);
	}

	public function delete($statement, $datas)
	{
		$request = $this->db()->prepare($statement);
		return $request->execute($datas);
	}

}
