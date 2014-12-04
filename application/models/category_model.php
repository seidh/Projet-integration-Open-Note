<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category
 *
 * @author nicol_000
 */
Class category_model extends CI_Model  
{
    function get_cat($cat_id)
    {
        $query = $this->db->query("SELECT * FROM category WHERE id = ".$cat_id.";");
        return $query->result_array();
    }
    
    function get_all_cat_mother()
    {
        $query = $this->db->query("SELECT * FROM category WHERE parent_id is null;");   
        
        return $query->result_array();
        
    }
    function get_all_cat_daughter($cat_id)
    {
        $query = $this->db->query("SELECT * FROM category WHERE parent_id = ".$cat_id.";");
                        
        return $query -> result_array();
        
    }
    function check_my_cat($cat_id, $user_id)
    {
        $this -> db -> select('*');
        $this -> db -> from('cat_perm');
        $this -> db -> where('cat_id', $cat_id);
        $this -> db -> where('user_id', $user_id);
        $this -> db -> limit(1);
 
        $query = $this -> db -> get();
 
        if($query -> num_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function get_note_cat($cat_id)
    {
        $query = $this->db->query("SELECT * FROM note WHERE category = ".$cat_id.";");
                        
        return $query -> result_array();
    }
    function get_my_note($user_id)
    {
        $query = $this->db->query("SELECT * FROM note WHERE author_id = ".$user_id.";");
                        
        return $query -> result_array();
    }
    
}
