<?php
Class administration_model extends CI_Model {

    private $moderator_perm = 2;
    
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
               !array_key_exists('email', $fields) &&
               !array_key_exists('birthday', $fields) &&
               !array_key_exists('groupe', $fields) &&
               !array_key_exists('sexe', $fields) &&
               !array_key_exists('pseudo', $fields) &&
               !array_key_exists('avatar', $fields)) 
                    return false;

            $this->db->insert('user', $fields);
            $insert_id = $this->db->insert_id();
            
            //create user_perm
            $this->db->insert('user_perm', array('user_id' => $insert_id, 'perm_id' => 3));
            return $insert_id;
        }

    
        
        function is_user_exist($email){
            $result = $this->db->get_where('user', array('email' => $email), 1);
            
            return ($result->num_rows() >= 1) ? true : false;
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
    
    function get_category($catId){
        return $this->db->get_where('category', array('id' => $catId))
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
    
    function get_users_of_cat($cat_id)
    {
        return $this->db->select('u.id, u.name, u.firstname, u.pseudo, u.email')
                                   ->distinct()
                                   ->from('cat_perm')
                                   ->join('user as u', 'u.id = cat_perm.user_id')
                                   ->where('cat_id', $cat_id)
                                   ->get()
                                   ->result_array();
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
    
    
    function is_top_level_cat($cat_id){
        $result = $this->db->get_where('category', array('id' => $cat_id), 1)->result();
        return ($result[0]->parent_id === null)? true : false;
    }
    
    function get_all_top_level_cat(){
        return $this->db->get_where('category', array('parent_id' => null))
                        ->result();
    }
    
    function get_all_child_of_cat($cat_id){
        if(!$this->is_top_level_cat($cat_id)) return;
        return $this->db->get_where('category', array('parent_id' => $cat_id))
                        ->result();
    }
    
    function is_moderator_of($user_id, $cat_id)
    {
        $where_clause = array('user_id' => $user_id, 'cat_id' => $cat_id);
        $result = $this->db->get_where('cat_perm', $where_clause, 1);
        return ($result->num_rows() >= 1) ? true : false;
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
        if($this->is_moderator_of($id_user, $id_cat)) return false;
        
        //TODO descending attribution
        $this->db->insert('cat_perm', array('user_id'=>$id_user, 'cat_id'=>$id_cat, 'perm_id'=> $this->moderator_perm));
        
        
        if(!$this->is_top_level_cat($id_cat)) return true;
        //else we need ton add moderator inside cild cats
        $children_cat = $this->get_all_child_of_cat($id_cat);
        foreach ($children_cat as $child_cat) {
            $this->attribute_moderator($id_user, $child_cat->id);
        }

        return true;
    }

    
    
    
    
    
    
    
    
    
    /**
     * Model functions about moderator
     */
    
    //TODO distinct moderator ( actually, we get few moderator row for one user)
    function get_all_moderator()
    {
        $moderator_array = array();
        //get all moderator data
        $moderator_user_data = $this->db->select('u.id, u.name, u.firstname, u.pseudo, u.email')
                                   ->distinct()
                                   ->from('cat_perm')
                                   ->join('user as u', 'u.id = cat_perm.user_id')
                                   ->where('perm_id', $this->moderator_perm)
                                   ->get()
                                   ->result_array();
        
        foreach($moderator_user_data as $current_mod){
            $binding_mod_data = $current_mod;
            
            //get moderat cat by current user
            $moderate_cat = $this->db->select('category.name, category.id')
                                     ->from('cat_perm')
                                     ->join('category','cat_perm.cat_id = category.id')
                                     ->where('user_id', $binding_mod_data['id'])
                                     ->where('perm_id', $this->moderator_perm)
                                     ->get()
                                     ->result_array();
            
            //add cat_data in moderator_data array
            $binding_mod_data['moderate_cat'] = $moderate_cat;
            
            //add binded array inside global moderator array
            $moderator_array[] = $binding_mod_data;
        }
        
        return $moderator_array;
    }
    
    
    
    
    
    
    
    
    /**
     * Model function about notes
     */
    
    
    function get_all_notes(){
        $this->db->get('note')
                 ->result();
    }
    
    function get_all_notes_from($catId){
        return $this->db->get_where('note', array('category' => $catId))
                        ->result();
    }

}