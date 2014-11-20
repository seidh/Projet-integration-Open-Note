<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comments_model extends CI_Model
{
    public $table = 'comments';
    
    /**
     * Add comments inside comments table
     * @param string $content text of comment
     * @param int $note_id
     * @param int $user_id
     * @param int $parent_id comment id of parent comment if need ( null by default
     * @return int id of inserted comments
     */
    function add_comment($content, $note_id, $user_id, $parent_id = null)
    {
        $this->db->insert($this->table, array('text' => $content, 
                                              'note_id' => $note_id,
                                              'user_id' => $user_id,
                                              'parent_id' => $parent_id));
        return $this->db->insert_id();
    }
    
    /**
     * Get all comments with given parent_id
     * @param int $parent_id
     * @return object containing comments data
     */
    function get_note_comment_by_parent($parent_id)
    {
        return $this->db->get($this->table)
                        ->where('parent_id', $parent_id)
                        ->result();
    }
}

