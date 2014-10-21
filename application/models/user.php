<?php
Class User extends CI_Model
{
 function login($email, $password)
 {
   $this -> db -> select('id, email, pwd');
   $this -> db -> from('user');
   $this -> db -> where('email', $email);
   $this -> db -> where('pwd', SHA1($password));
   $this -> db -> limit(1);
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
}
?>