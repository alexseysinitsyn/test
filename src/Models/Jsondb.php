<?php 
namespace Models;


class Jsondb 
{ 
    
 public $dataFolder = 'jdb'; 
 /** 
  * Creates database file 
  * 
  * @param string $dbName Name of database file to create 
  * @return void 
  */ 
 public function cDataBase($dbName){ 
  $fileName = $this->dataFolder.'/'.$dbName; 
  file_put_contents($fileName,null,FILE_APPEND); 
 } 
 /** 
  * Retrieves database data 
  * 
  * @param string $dbName Name of database file to retrieve 
  * @return array Data or empty if none 
  */ 
 public function rDataBase($dbName){ 
  
  $fileName = $this->dataFolder.'/'.$dbName; 
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
  $fileName = $this->dataFolder.'/'.$dbName; 
  $jsonData = json_encode($data); 
  file_put_contents($fileName,$jsonData); 
 } 
 /** 
  * Deletes database 
  * 
  * @param string $dbName Name of database file to delete 
  * @return void 
  */ 
 public function dDataBase($dbName){ 
  $fileName = $this->dataFolder.'/'.$dbName; 
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