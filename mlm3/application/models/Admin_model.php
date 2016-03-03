<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Admin_Model extends CI_Model
{


    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }
    public function get_members($query)
    {
        $query = $this->db->query($query);
        return $query->result_array();
    }
    public function count_members()
    {       $this->db->select('count(id)');
        $query = $this->db->get('members');
        return $query->result_array();
    }
    public function sum_payments()
    {       $this->db->select(' SUM(total_payments)');
        $query = $this->db->get('payments');
        return $query->result_array();
    }
    public function get_member($id)
    {   $this->db->select(['first_name','last_name','country','city','id','email','active']);
        $query=$this->db->get_where('members',['id'=>$id]);
        return $query->result_array();
    }

    public function update_member($id,$data){
        $this->db->where('id', $id);
        $this->db->update('members', $data);
    }
    public function get_paypal_detail()
    {   $this->db->select('*');
        $query=$this->db->get_where('paypal_setting',['id'=>1]);
        return $query->result_array();
    }
    public function update_paypal($data){
        $this->db->where('id', 1);
        $this->db->update('paypal_setting', $data);
    }
    public function get_admin_setting()
    {   $this->db->select('*');
        $query=$this->db->get_where('admin_info',['id'=>1]);
        return $query->result_array();
    }
    public function update_admin_setting($data){
        $this->db->where('id', 1);
        $this->db->update('admin_info', $data);
    }
    public function get_login_info($email){
        $this->db->select('*');
        $query=$this->db->get_where('admin_info',['email'=>$email]);
        return $query->result_array();
    }
}