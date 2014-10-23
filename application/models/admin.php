<?php
Class Admin extends CI_Model
{
 function all_users()
 {
   $this -> db -> select('id, email, pwd');
   $this -> db -> from('user');
   
 
   $query = $this -> db -> get();
 
   if($query -> num_rows() > 0)
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