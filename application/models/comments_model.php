<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comments_model extends CI_Model
{
    public $table = 'comments';
    public $get_note_select = 'comments.id as id, user_id, name, firstname, parent_id, text, note_id, creation_date';
    
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
    private function _get_comment_by_parent($parent_id = NULL)
    {
        return $this->db->select($this->get_note_select)
                        ->from($this->table)
                        ->join('user', 'user.id = comments.user_id')
                        ->where('parent_id', $parent_id)
                        ->get()
                        ->result();
    }
    
    private function _get_primary_note_comment($note_id)
    {
        return $this->db->select($this->get_note_select)
                        ->from($this->table)
                        ->join('user', 'user.id = comments.user_id')
                        ->where('parent_id', null, FALSE)
                        ->where('note_id', $note_id)
                        ->get()
                        ->result();
    }
    
    private function _get_note_comment_r($parent_id, $primary_level = false, $note_id = NULL)
    {
        $comments_array = array();

        $working_array = ($primary_level) ? $this->_get_primary_note_comment($note_id) : 
                                            $this->_get_comment_by_parent($parent_id);
        if(empty($working_array)) return;
        
        foreach ($working_array as $child) {
            $comments_array[] = $child;
            $comments_array[] = $this->_get_note_comment_r($child->id);
        }
        return $comments_array;
    }
    
    function get_note_comments($note_id)
    {
        return $this->_get_note_comment_r(NULL, true, $note_id);
    }
}

