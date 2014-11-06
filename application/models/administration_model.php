<?php
Class administration_model extends CI_Model {

    /**
     * Model functions about users
     */
        /**
         * 
         * @return type
         */
        function get_all_user(){
            return $this->db->get('user')
                            ->result();
        }

        /**
         * 
         * @return type return array containing all user_perm rows
         */
        function get_all_user_perm(){
            return $this->db->get('user_perm')
                            ->result();
        }
        /**
         * 
         * @param type $fields associativ array containing columns and values to update
         * @param type $where_clauses string or array containing where clause
         * @return boolean 
         */
        function modify_user($fields,$where_clauses){
            if(!isset($where_clauses) && !isset($fields) && (!is_string($where_clauses) || !is_array($where_clauses)))
                return false;
            $this->db->update('user', $fields, $where_clauses);
                return true;
        }

        /**
         * 
         * @param type $fields associative array containing rows data for user creation.
         * @return boolean
         */
        function create_user($fields){
            if(!isset($fields) && !is_array($fields)) 
                return false;
            
            if(!array_key_exists('name', $fields) && 
               !array_key_exists('firstname', $fields) &&
               !array_key_exists('pwd', $fields) &&
               !array_key_exists('birthday', $fields) &&
               !array_key_exists('groupe', $fields) &&
               !array_key_exists('sexe', $fields) &&
               !array_key_exists('pseudo', $fields) &&
               !array_key_exists('avatar', $fields)) 
                    return false;

            $this->db->insert('user', $fields);
                    return true;
        }
        
        
    /**
     * Model functions about category
     */
    function get_all_category(){
        return $this->db->get('category')
                        ->result();
    }
    
    function get_all_category_perm(){
        return $this->db->get('cat_perm')
                        ->result();
    }
    
    function modify_category($fields,$where_clauses){
        if(!isset($where_clauses) && !isset($fields) && (!is_string($where_clauses) || !is_array($where_clauses)))
                return false;
        $this->db->update('category', $fields, $where_clauses);
        return true;
    }
    
    function create_category($fields){
        if(!isset($fields) && !is_array($fields)) 
            return false;
        if(!array_key_exists('name', $fields) && !array_key_exists('parent_id', $fields))
            return false;
        
        $this->db->insert('category', $fields);
        return $this->db->insert_id();
    }
    
    function attribute_moderator($id_user,$id_cat){
        
    }

    /**
     * Model functions about moderator
     */
    function get_all_moderator(){
        
    }

    /**
     * Model function about moderator
     */
    function get_all_notes(){
        
    }

}