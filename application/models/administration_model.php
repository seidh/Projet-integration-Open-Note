<?php
Class administration_model extends CI_Model {

    /**
     * Model functions about users
     */
        /**
         * 
         * 
         * @return type array containing all users data
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
         * @return boolean true on success, false on failure
         */
        function modify_user($fields,$where_clauses){
            if(!isset($where_clauses) && !isset($fields) && (!is_string($where_clauses) || !is_array($where_clauses)))
                return false;
            $this->db->update('user', $fields, $where_clauses);
                return true;
        }

    
    
    
    
    
    
    
    
        /**
         * 
         * @param type $fields associative array containing user data
         * @return boolean false on failure and id of created lign.
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
            return $this->db->insert_id();
        }

    
    
    
    
    
    
    
    

    /**
     * Model functions about category
     */

    /**
     * 
     * @return type associative array containing data of all categories
     */
    function get_all_category(){
        return $this->db->get('category')
                        ->result();
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    /**
     * 
     * @return type array containing category perm
     */
    function get_all_category_perm(){
        return $this->db->get('cat_perm')
                        ->result();
    }

    
    
    
    
    
    
    
    
    /**
     * Get number of elements inside specified table
     * @param string $table_name containing table name
     * @return integer containing elements number of spécified table
     */
    function total_number_of($table_name = '')
    {
        return $this->db->count_all($table_name);
    }
    
    
    
    
    
    
    
    
    
    /**
     * 
     * @param type $cat_id
     * @return type
     */
    function get_number_user_in_cat($cat_id)
    {
        return $this->db->where('cat_id', $cat_id)
                        ->count_all_results('cat_perm');
    }
    
    
    
    
    
    
    
    
    
    /**
     * 
     * @param type $cat_id
     * @return type
     */
    function get_note_number_in_cat($cat_id)
    {
        return $this->db->where('category', $cat_id)
                        ->count_all_results('note');
    }
    
    
    
    
    
    
    
    
    
    /**
     * 
     * @param type $fields associative array containing row/data to be update
     * @param type $where_clauses string containing where clauses exemple : "id = 2"
     * @return boolean false on error true on success
     */
    function modify_category($fields,$where_clauses){
        if(!isset($where_clauses) && !isset($fields) && (!is_string($where_clauses) || !is_array($where_clauses)))
                return false;
        $this->db->update('category', $fields, $where_clauses);
        return true;
    }
    
    
    
    
    
    
    
    
    
    
    /**
     * 
     * @param type $fields associative array containing 'name' and 'parent_id' ('parent_id' can be null)
     * @return boolean false on error and id of created cat if success !
     */
    function create_category($fields, $admin_user_id){
        if(!isset($fields) && !is_array($fields)) 
            return false;
        if(!array_key_exists('name', $fields) && !array_key_exists('parent_id', $fields))
            return false;
        
        // create category
        $this->db->insert('category', $fields);
        $cat_id = $this->db->insert_id();
        
        //add admin as cat moderator
        return $this->attribute_moderator($admin_user_id, $cat_id);
        
    }
    
    
    
    
    
    
    
    
    
    
    /**
     * 
     * @param type $cat_id
     */
    function delete_category($cat_id)
    {
        //first we need to delete all perm for this category 
        $this->db->delete('cat_perm', "id = $cat_id");
        
        //then we can delete all note linked to this cat
        // for this, we should delete every note_perm linked to dying notes.
        $dying_notes_id = $this->db->select('id')
                                   ->from('note')
                                   ->where('category', $cat_id)
                                   ->result();
        if(!empty($dying_notes_id))
        {
            //deletion of note_perm elements linked to dying note
            foreach ($dying_notes_id as $note) {
                $this->db->delete('note_perm', "note_id = $note->note_id");
            }
            
            //remove note
            $this->db->delete('note', "category = $cat_id");
        }
        return true;
    }
    
    
    
    
    
    
    
    
    
    
    /**
     * 
     * @param type $id_user database user id of futur moderator
     * @param type $id_cat  database cat id of cat that moderator will moderate
     * @return boolean
     */
    function attribute_moderator($id_user,$id_cat){
        if(!is_int($id_user) && !is_int($id_user)){
            return false;
        }
        $this->db->insert('cat_perm', array('user_id'=>$id_user, 'cat_id'=>$id_cat, 'perm_id'=>2));
        return true;
    }

    
    
    
    
    
    
    
    
    
    /**
     * Model functions about moderator
     */
    function get_all_moderator(){
        //get cat_perm where perm_id = moderator_perm
        $cat_perm_result = $this->db->where('perm_id', 2) // 2 = moderator
                                    ->get('cat_perm')
                                    ->result();
        //foreach cat_perm element, get user data
        $all_moderator_tab = array();

        foreach ($cat_perm_result as $cat_perm_element) {
            $tmp_array = array();

            //get category data by cat_id from cat_perm
            $category_data = $this->db->where('id', $cat_perm_element->cat_id)
                                      ->select('id, name')
                                      ->get('category')
                                      ->result();

            //get moderator data by user_id from cat_perm
            $moderator_data = $this->db->where('id', $cat_perm_element->user_id)
                                       ->select('id, name, firstname, pseudo, email')
                                       ->get('user')
                                       ->result();
            
            //bind array
            $tmp_array['user_id'] = $moderator_data[0]->id;
            $tmp_array['pseudo'] = $moderator_data[0]->pseudo;
            $tmp_array['name'] = $moderator_data[0]->name;
            $tmp_array['firstname'] = $moderator_data[0]->firstname;
            $tmp_array['email'] = $moderator_data[0]->email;
            $tmp_array['cat_id'] = $category_data[0]->id;
            $tmp_array['cat_name'] = $category_data[0]->name;

            $all_moderator_tab[] = $tmp_array;
        }

        return $all_moderator_tab;
    }

    
    
    
    
    
    
    
    
    
    /**
     * Model function about notes
     */
    
    
    function get_all_notes(){
        $this->db->get('note')
                 ->result();
    }

}