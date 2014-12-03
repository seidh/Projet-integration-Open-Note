<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class comments_model extends CI_Model {

    public $table = 'comments';
    public $get_note_select = 'comments.id as id, user_id, name, firstname, parent_id, text, note_id, creation_date, avatar';

    /**
     * Add comments inside comments table
     * @param string $content text of comment
     * @param int $note_id
     * @param int $user_id
     * @param int $parent_id comment id of parent comment if need ( null by default
     * @return int id of inserted comments
     */
    function add_comment($content, $note_id, $user_id, $parent_id = null) {
        $this->db->insert($this->table, array('text' => $content,
            'note_id' => $note_id,
            'user_id' => $user_id,
            'parent_id' => $parent_id,
            'creation_date' => date("Y-m-d H:i:s")));

        return $this->db->insert_id();
    }

    /**
     * Get all comments with given parent_id
     * @param int $parent_id
     * @return object containing comments data
     */
    private function _get_comment_by_parent($parent_id = NULL) {
        return $this->db->select($this->get_note_select)
                        ->from($this->table)
                        ->join('user', 'user.id = comments.user_id')
                        ->where('parent_id', $parent_id)
                        ->get()
                        ->result();
    }

    private function _get_primary_note_comment($note_id) {
        return $this->db->select($this->get_note_select)
                        ->from($this->table)
                        ->join('user', 'user.id = comments.user_id')
                        ->where('parent_id', null, FALSE)
                        ->where('note_id', $note_id)
                        ->get()
                        ->result();
    }

    private function _get_note_comment_r($parent_id, $primary_level = false, $note_id = NULL) {
        $comments_array = array();

        $working_array = ($primary_level) ? $this->_get_primary_note_comment($note_id) :
                $this->_get_comment_by_parent($parent_id);
        if (empty($working_array))
            return;

        foreach ($working_array as $child) {
            $comments_array[] = $child;
            $comments_array[] = $this->_get_note_comment_r($child->id);
        }
        return $comments_array;
    }

    function get_note_comments($note_id) {
        return $this->_get_note_comment_r(NULL, true, $note_id);
    }

    function write_comments_r($comments) {

        if (is_array($comments)) {
            foreach ($comments as $probably_comment) {

                echo '<div style="padding-left:30px;">';
                $this->write_comments_r($probably_comment);
                echo '</div>';
            }
        } elseif (is_object($comments)) {
            /*
             *  [id] => 10
              [user_id] => 4
              [name] => Beersaerts
              [firstname] => Jonathan
              [parent_id] => 9
              [text] => Troisième lvl
              [note_id] => 18
              [creation_date] => 2014-12-01 16:51:45
             */
            /*
              echo '<div class="form-control row">';
              echo '<div class="col-sm-4">';
              echo $comments->name." ".$comments->firstname;
              echo '</div>';
              echo $comments->creation_date."<br />";
              echo $comments->text."</div><br/>";
             */
            echo'<div class="panel-body">';
            echo'<ul class="chat">';
            echo'<li class="left clearfix">';
            echo'<span class="chat-img pull-left">';
            if ($comments->avatar == null) {
                echo '<img src="';
                echo base_url('assets/image/avatarDefault.png');
                echo '" alt="Avatar par défaut" class="img-circle" style="width:50px; height:50px;"/>';
            } else {
                echo '<img src="';
                echo base_url('assets/image');
                echo '/' . $comments->avatar . '" alt="Mon Avatar" class="img-circle" style="width:50px; height:50px;"/>';
            }
            echo'</span>';
            echo'<div class="chat-body clearfix">';
            echo'<div class="header">';
            echo'<strong class="primary-font">' . $comments->name . ' ' . $comments->firstname . '</strong> ';
            echo'<small class="pull-right text-muted">';
            echo'<i class="fa fa-clock-o fa-fw"></i>' . $comments->creation_date . '<br />';
            echo'<div id="comment_list">';
            echo'<button type="button" id="' . $comments->id . '" class="btn btn-outline btn-info btn-xs">Commenter ce commentaire</button>';
            echo'</div>';
            echo'</small>';
            echo'</div>';
            echo'<p>';
            echo $comments->text;
            echo'</p>';
            echo'</div>';
            echo'<div id="textComment' . $comments->id . '" style="display: none" class="form-group row">';
            echo form_open('note/sendComment/' . $comments->id);
            echo'<input class="form-control"  name="note_id" id="note_id" type="text" style="display: none" value="' . $comments->note_id . '" />';
            echo'<div class="panel-footer">';
            echo'<div class="input-group">';
            echo'<input id="btn-input" type="text" name="comment" class="form-control input-sm" placeholder="Ecrivez votre message ici...">';
            echo'<span class="input-group-btn">';
            echo'<button type="submit" class="btn btn-warning btn-sm" id="btn-chat">';
            echo'Commenter';
            echo'</button>';
            echo'</span>';
            echo'</div>';
            echo'</div>';
            echo form_close();
            echo'</div>';
            echo'</li>';
            echo'</ul>';
            echo'</div>';
        }
    }
    function get_number_comments($note_id)
    {
        return $this->db->select('*')
                        ->from($this->table)
                        ->where('note_id', $note_id)
                        ->get()
                        ->num_rows();
    }

}
