<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Messages_model extends CI_Model
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    public function add_message($data)
    {
        $query = "INSERT INTO messages (sender_id, receiver_id, subject, message, thread_id) values(".$data['sender_id'].",".$data['receiver_id'].",'".$data['subject']."','".$data['message']."','".$data['thread_id']."')";
        $this->db->query($query);
    }
    
    public function get_sent_messages($id)
    {
        //$this->db->select('*');
        $query = $this->db->query('SELECT msg.*, mem.first_name, mem.last_name, mem.image FROM messages msg LEFT JOIN members mem ON mem.id = msg.sender_id WHERE msg.sender_id='.$id ." AND msg.is_archieved=0 GROUP BY thread_id LIMIT 0,1");
        return $query->result_array();
    }
    
    public function get_received_messages($id)
    {
        //$this->db->select('*');
        $query = $this->db->query('SELECT msg.*, mem.first_name, mem.last_name, mem.image FROM messages msg LEFT JOIN members mem ON mem.id = msg.receiver_id WHERE msg.receiver_id='.$id." AND msg.is_archieved=0 GROUP BY thread_id LIMIT 0,1");
        return $query->result_array();
    }
    
    public function define_thread($sen_id, $rec_id)
    {
        $threadArr = [$sen_id, $rec_id];
        sort($threadArr);
        return implode('-', $threadArr);
    }
    
    public function delete($id)
    {
        $this->db->query("UPDATE messages SET is_archieved=1 WHERE id=".$id);
    }
    
    public function save_thread($data)
    {
        $query = "INSERT INTO messages (parent_id, sender_id, receiver_id, subject, message, thread_id) values(".$data['parent_id'].",".$data['sender_id'].",".$data['receiver_id'].",'".$data['subject']."','".$data['message']."','".$data['thread_id']."')";
        $this->db->query($query);
    }
    
    public function get_thread($threadId)
    {
        $this->db->select('*');
        $query = $this->db->query('SELECT * FROM messages msg WHERE msg.thread_id='.$threadId);
        return $query->result_array();
    }
}
