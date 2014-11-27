<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once '/application/models/Git.php';

class notes_model extends CI_Model
{
    public $table_note = 'note';
    public $table_vote = 'rate';
    public $table_comments = 'comments';
    
    public static $default_path = 'assets/repo.d/';
    
            
    function create_note($author_id, $author_pseudo, $author_email, $path, $note_name, $file_name, $cat_id)
    {
        $git_repo = Git::create($path);
        
        $git_repo->run("config user.name \"$author_pseudo\"");
        $git_repo->run("config user.email \"$author_email\"");
        
        $git_repo->add();
        $git_repo->commit('Première version');
        
        //insert data on database
        $note_array = array('path' => $path,
                            'file_name' => $file_name,
                            'name' => $note_name,
                            'visible' => 1,
                            'category' => $cat_id,
                            'author_id' => $author_id,
                            'creation_date' => date("Y-m-d H:i:s"),
                            'modification_date' => date("Y-m-d H:i:s"));
        
        $this->db->insert('note', $note_array);
        $note_id = $this->db->insert_id();
        return $note_id;
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