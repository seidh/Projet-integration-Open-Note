<?php
Class User extends CI_Model
{
 function login($email, $password)
 {
   $this -> db -> select('id, email, pwd');
   $this -> db -> from('user');
   $this -> db -> where('email', $email);
   $this -> db -> where('pwd', hash("sha512",$password.$email));
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
 function user_data($id)
 {
    $this -> db -> select('*');
    $this -> db -> from('user');
    $this -> db -> where('id', $id);
    $this -> db -> limit(1);
 
    $query = $this -> db -> get();
    $result = $query->result();
    if($result)
    {
        $data = array();
        foreach($result as $row)
        {
            $data = array(
                'id' => $row->id,
                'username' => $row->email,
                'name' => $row->name,
                'firstname' => $row->firstname,
                'pwd' => $row->pwd,
                'sexe' => $row->sexe,
                'birthday' => $row->birthday,
                'groupe' => $row->groupe,
                'avatar' => $row->avatar,
                'pseudo' => $row->pseudo,
                'error' => ' ',
                'message' => ' '   
                );
        }
        return $data;
    }
 }
 
 function is_moderator($id)
 {
    return $this->db->get_where('cat_perm', array('user_id' => $id))
                ->result();
 }
 
 function is_admin($id)
 {
    $result = $this->db->select('*')
                 ->from('user_perm')
                 ->where('user_id = ',$id)
                 ->where('perm_id = 1')
                 ->limit(1)
                 ->get()
                 ->result();
    
    return (empty($result))? false : true;
 }
}
?>
