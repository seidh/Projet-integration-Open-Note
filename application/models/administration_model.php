<?php
Class Admin extends CI_Model {

    /**
     * Model functions about users
     */
    function get_all_user(){
        $query_result = $this->db->get('user');
        return $query_result;
        
    }
    
    function modify_users($fields,$id){
        
    }
    
    function create_users($fields){
        
    }

    /**
     * Model functions about category
     */
    function get_all_category(){
        
    }
    
    function modify_category($fields,$id){
        
    }
    
    function create_category($fields){
        
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