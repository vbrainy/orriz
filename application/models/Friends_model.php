<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Friends_Model extends CI_Model
{


    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }


    public function get()
    {      
        $this->db->select(['id','parent_id','first_name']);
        $query = $this->db->get('members');
        return $query->result_array();
    }
}