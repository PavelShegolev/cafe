<?php
	
  class RouteException extends Exception implements Iterator,ArrayAccess{
    protected $_list= array();
    protected $position= 0;
    
    public function rewind(){
      $this->position= 0;
    }
    
    public function current(){
      return $this->_list[$this->position];
    }
    
    public function key(){
      return $this->position;
    }
    
    public function next(){
      $this->position++;
    }
    
    public function valid(){
      return isset($this->_list[$this->position]);
    }
    
    public function offsetExists($index){
      return isset($this->_list[$index]);
    }
    
    public function offsetGet($index){
      return $this->_list[$index];
    }
    
    public function offsetSet($index, $value){
      if(is_null($index))
        $this->_list[]= $value;
      else
        $this->_list[$index]= $value;
    }
    
    public function offsetUnset($index){
      unset($this->_list[$index]);
    }
 }
 
  class DBException extends Exception implements Iterator,ArrayAccess{
    protected $_list= array();
    protected $position= 0;
    
    public function rewind(){
      $this->position= 0;
    }
    
    public function current(){
      return $this->_list[$this->position];
    }
    
    public function key(){
      return $this->_list[$this->position];
    }
    
    public function next(){
      $this->position++;
    }
    
    public function valid(){
      return isset($this->_list[$this->position]);
    }
    
    public function offsetExists($index){
      return isset($this->_list[$index]);
    }
    
    public function offsetGet($index){
      return $this->_list[$index];
    }
    
    public function offsetSet($index, $value){
      if(is_null($index))
        $this->_list[]= $value;
      else
        $this->_list[$index]= $value;
    }
    
    public function offsetUnset($index){
      unset($this->_list[$index]);
    }
 }

  class FileException extends Exception implements Iterator,ArrayAccess{
    protected $_list= array();
    protected $position= 0;
    
    public function rewind(){
      $this->position= 0;
    }
    
    public function current(){
      return $this->_list[$this->position];
    }
    
    public function key(){
      return $this->_list[$this->position];
    }
    
    public function next(){
      $this->position++;
    }
    
    public function valid(){
      return isset($this->_list[$this->position]);
    }
    
    public function offsetExists($index){
      return isset($this->_list[$index]);
    }
    
    public function offsetGet($index){
      return $this->_list[$index];
    }
    
    public function offsetSet($index, $value){
      if(is_null($index))
        $this->_list[]= $value;
      else
        $this->_list[$index]= $value;
    }
    
    public function offsetUnset($index){
      unset($this->_list[$index]);
    }
 }
 
 
	class Error{
		static public function catchException(Exception $exeption){
      $message= $exeption->getMessage();
      $line_error= $exeption->getLine();
      $name_file= $exeption->getFile();
     // var_dump($name_file);
		}
	}
	
?>