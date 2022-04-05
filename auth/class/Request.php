<?php

/**
 * @Author: Mockingbird
 * @Date:   2021-10-20 15:03:28
 * @Last Modified by:   yacine.B
 * @Last Modified time: 2021-11-24 11:04:09
 */

class Request{

	private $options = ['restriction_msg' => "You can't access this page !",];
	private $session;

	/**
	 * @param $session : Session [Object]
	 * @return $options : array
	*/
	public function __construct($session, $options = []){
		$this->options = array_merge($this->options, $options);
		$this->session = $session;
	}

	public function isIndexHere($db, $table, $attributes, $values){
		$res = $db->query("SELECT id FROM $table WHERE $attributes", $values)->fetch();
		return ($res)? true : false ;  
	}

	public function getAllIndex($db, $table, $attributes='', $values, $getValue='*', $limit=''){
		return $db->query("SELECT $getValue FROM $table ".((!empty($attributes))? "WHERE $attributes" : '')." $limit", $values)->fetchAll();
	}

	public function getThis($db, $table, $attributes, $values, $getValue="*"){
		return $db->query("SELECT $getValue FROM $table WHERE $attributes", $values)->fetch();
	}

	public function deleteIndex($db, $table, $attributes, $values){
		$db->query("DELETE FROM $table WHERE $attributes", $values);
	}

	public function addIndex($db, $table, $attributes, $values){
		return $db->query("INSERT INTO $table SET $attributes", $values);
	}

	public function editIndex($db, $table, $attributes, $attributes2, $values){
		return $db->query("UPDATE $table SET $attributes WHERE $attributes2", $values);
	}

	public function getCount($db, $table, $field, $value){
		return $db->query("SELECT count(id) as nb FROM $table WHERE $field", $value)->fetch();
	}
}