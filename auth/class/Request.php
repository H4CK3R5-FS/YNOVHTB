<?php

/**
 * @Author: BOUFALA Yacine
 * @Date:   2022-05-03 18:40:13
 * @Last Modified by:   root
 * @Last Modified time: 2022-05-04 12:10:35
 */


class Request {

	public function isIndexHere($db, $table, $attributes, $values){
		$res = $db->query("SELECT id FROM $table WHERE $attributes", $values)->fetch();
		return ($res)? true : false ;  
	}

	
	public function getAllIndex($db, $table, $attributes='', $values, $getValue='*', $limit=''){
		return $db->query("SELECT $getValue FROM $table ".((!empty($attributes))? "WHERE $attributes" : '')." $limit", $values)->fetchAll();
	}


	public function getAllIndexOrderBy($db, $getValue="*", $table, $Orderby="", $limit='limit 3'){
		return $db->query("SELECT $getValue FROM $table $Orderby $limit", [])->fetchAll();
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
		return $db->query("SELECT count(id) as nb FROM $table WHERE $field", $value)->fetch()->nb;
	}


	public function getLevel($exp=0) {
		return (25 + sqrt(625 + 100 * $exp)) / 50;
	}
}