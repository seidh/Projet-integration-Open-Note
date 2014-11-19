<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class notes_model extends CI_Model
{
    public $table_note = 'note';
    public $table_vote = 'rate';
    public $table_comments = 'comments';
    
    function create_note($name, $description = '')
    {
        /**
         * Here come all git code for creating note returning the repo path and name
         * to put into DB
         */
        
        $gitRepoName = 'temporary name waiting GIT implementation';
        
        $values = array();
        $values['name'] = $name;
        $values['path'] = $gitRepoName;
        $values['visible'] = 0;
        //$values['description'] = $description; // TODO add on DB if OpenNote Team agree
        
        //Add note in DB
        $this->db->insert($this->table_note, $values);
        $note_id = $this->db->insert_id();
        
        //Perm attribution
        
    }
    
    function add_note_perm($note_id, $perm_data)
    {
        //TODO need infos from team
    }
    
    function rate_note($note_id, $user_id, $value)
    {
        if(!is_int($note_id) && !is_int($user_id) && !is_bool($value))
            return false;
        $this->db->insert($this->table_vote, array('note_id' => $note_id, 
                                                   'user_id' => $user_id,
                                                   'vote' => $value));
        return true;
    }
    
    function add_comment($note_id, $user_id, $parent_id, $content)
    {
        //TODO implementation
    }
    
    function get_all_comments($note_id)
    {
        //TODO recursive function to get all comment and return array containing all datas
    }
    
    function get_note_history($note_id)
    {
        //GIT integration
    }
    
    function revert_note($history_point)
    {
        //GIT integration
    }
    
    function push_note($dont_know_which_argument_need)
    {
        //GIT integration
    }
    
    function diff_note($history_point, $now)
    {
        //GIT integration
    }
}