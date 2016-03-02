<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Ad_Model extends CI_Model
{


    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }
    public function insert_ad($data)
    {
        $this->db->insert('ads', $data);

    }
    public function get_latest_10_ad()
    {
        $this->db->select(['ad_title','ad_description','ad_url']);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(10, 0);
        $query = $this->db->get('ads');
        return $query->result_array();

    }
}
