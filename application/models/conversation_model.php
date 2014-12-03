<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conversation
 *
 * @author nicol_000
 */
Class conversation_model extends CI_Model {

    function get_all_conversation($user_id) {
        //$query = $this->db->query("SELECT * FROM conversation WHERE user_id = " . $user_id . " OR friend_id = " . $user_id . ";");
        //return $query->result_array();
        return $this->db->select('*')
                        ->from('conversation')
                        ->where('user_id = ' . $user_id)
                        ->or_where('friend_id = '. $user_id)
                        ->get()
                        ->result_array();
    }

    function get_all_message_from_conversation($conf_id) {
        //$query = $this->db->query("SELECT * FROM messages WHERE conversation_id = " . $conf_id . " ORDER BY date_creation;");
        //return $query->result_array();
        return $this->db->select('*')
                        ->from('messages')
                        ->where('conversation_id = ' . $conf_id)
                        ->order_by("date_creation", "desc")
                        ->get()
                        ->result_array();
    }

    function get_all_user() {
        //$query = $this->db->query("SELECT * FROM user;");
        //return $query->result_array();
        return $this->db->select('*')
                        ->from('user')
                        ->get()
                        ->result_array();
    }

    function get_last_conf() {
        //$query = $this->db->query("SELECT * FROM conversation ORDER BY date_creation desc LIMIT 1;");
        //return $query->result_array();
        return $this->db->select('*')
                        ->from('conversation')
                        ->order_by("date_creation", "desc")
                        ->limit(1)
                        ->get()
                        ->result_array();
    }

    function get_conversation($id) {
        //$query = $this->db->query("SELECT * FROM conversation where id =" . $id . ";");
        return $this->db->select('*')
                        ->from('conversation')
                        ->where('id = '.$id)
                        ->get()
                        ->result_array();
        
    }

    function get_name_friend($conf_id) {
        $conversation = $this->get_conversation($conf_id);
        $session_data = $this->session->userdata('logged_in');

        if ($conversation[0]['user_id'] == $session_data['id']) {
            $user = $this->user->user_data($conversation[0]['friend_id']);
            return '' . $user['firstname'] . ' ' . $user['name'];
        } else {
            $user = $this->user->user_data($conversation[0]['user_id']);
            return '' . $user['firstname'] . ' ' . $user['name'];
        }
    }

    function get_three_last_message() {
        $session_data = $this->session->userdata('logged_in');
        $all_conf = $this->get_all_conversation($session_data['id']);
        if ($all_conf) {
            $all_id_conf = $all_conf[0]['id'];
            foreach ($all_conf as $conf) {
                $all_id_conf = $all_id_conf.' , '.$conf['id'];
            }
            $query = $this->db->query("SELECT * FROM messages where user_id != " . $session_data['id'] . " and conversation_id in (" . $all_id_conf . " )order by date_creation desc LIMIT 3;");
            return $query->result_array();
            /*return $this->db->select('*')
                        ->from('messages')
                        ->where('user_id != ', $session_data['id'])
                        ->where_in('conversation_id', $all_id_conf)
                        ->order_by("date_creation", "desc")
                        ->limit(3)
                        ->get()
                        ->result_array();*/
        }
        else
        {
            return null;
        }
    }

}
