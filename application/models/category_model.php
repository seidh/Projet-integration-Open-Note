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
    /**
     * Cette fonction retourne les informations d'une catégorie en fonction de l'id de la catégorie
     * @param type $cat_id
     * @return type
     */
    function get_cat($cat_id)
    {
        $query = $this->db->query("SELECT * FROM category WHERE id = ".$cat_id.";");
        return $query->result_array();
    }
    /**
     * Cette fonction retourne toutes les catégories primaires de la base de donnée
     * @return type
     */
    function get_all_cat_mother()
    {
        $query = $this->db->query("SELECT * FROM category WHERE parent_id is null;");   
        
        return $query->result_array();
        
    }
    /**
     * Cette fonction retourne toutes les catégories primaires d'une catégorie
     * @param type $cat_id
     * @return type
     */
    function get_all_cat_daughter($cat_id)
    {
        $query = $this->db->query("SELECT * FROM category WHERE parent_id = ".$cat_id.";");
                        
        return $query -> result_array();
        
    }
    /**
     * Cette fonction retourne vrai si l'utilisateur est abonnée à cette catégorie
     * @param type $cat_id
     * @param type $user_id
     * @return boolean
     */
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
    /**
     * Retourne toutes les notes en fonction de l'id d'une catégorie
     * @param type $cat_id
     * @return type
     */
    function get_note_cat($cat_id)
    {
        $query = $this->db->query("SELECT * FROM note WHERE category = ".$cat_id.";");
                        
        return $query -> result_array();
    }
    /**
     * Retourne toutes les notes d'un utilisateur en fonction de l'id d'un utilisateur
     * @param type $user_id
     * @return type
     */
    function get_my_note($user_id)
    {
        $query = $this->db->query("SELECT * FROM note WHERE author_id = ".$user_id.";");
                        
        return $query -> result_array();
    }
    
}
