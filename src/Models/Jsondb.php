<?php 
namespace Models;


class Jsondb 
{ 
    
    
 /** 
  * Creates database file 
  * 
  * @param string $dbName Name of database file to create 
  * @return void 
  */ 
 public function cDataBase($dbName){ 
    $upOne = dirname( __FILE__, 4 );
    $dataFolder = $upOne.'/jdb';
  $fileName = $dataFolder.'/'.$dbName; 
  file_put_contents($fileName,null,FILE_APPEND); 
 } 
 /** 
  * Retrieves database data 
  * 
  * @param string $dbName Name of database file to retrieve 
  * @return array Data or empty if none 
  */ 
 public function rDataBase($dbName){ 
    $upOne = dirname( __FILE__, 4 );
    $dataFolder = $upOne.'/jdb';
  $fileName = $dataFolder.'/'.$dbName; 
  $data = file($fileName); 
  if( is_array($data) ){ 
   ksort($data); 
   return $data; 
  }else{ 
   return array(); 
  } 
 } 
 /** 
  * Updates database data 
  * 
  * @param string $dbName Name of database file to update 
  * @param array $data Data to update 
  * @return void 
  */ 
 public function uDataBase($dbName,$data){ 
    $upOne = dirname( __FILE__, 4 );
    $dataFolder = $upOne.'/jdb';
  $fileName = $dataFolder.'/'.$dbName; 
  $jsonData = json_encode($data); 
  file_put_contents($fileName,$jsonData, FILE_APPEND | LOCK_EX); 
 } 
 /** 
  * Deletes database 
  * 
  * @param string $dbName Name of database file to delete 
  * @return void 
  */ 
 public function dDataBase($dbName){
    $upOne = dirname( __FILE__, 4 );
    $dataFolder = $upOne.'/jdb'; 
  $fileName = $dataFolder.'/'.$dbName; 
  unlink($fileName); 
 } 
 /** 
  * Gets next record id 
  * 
  * @param array $data Database data 
  * @return int Id of next record 
  */ 
 public function nextRecord($data){ 
  
  if( is_array($data) ){ 
   ksort($data); 
   end($data); 
   $id = key($data)+1; 
  }else{ 
   $id = 1; 
  } 
  return $id; 
 } 
} 
?> 