<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends Members_Controller {

    function __construct()
    {
        parent::__construct();
        if ($this->ion_auth->logged_in() == false) {
            redirect(base_url());
        }
        $this->load->database();
        $this->load->model('messages_model');
        $this->load->model('member_model');
        $this->load->library('pagination');
        $user_detail                  = $this->member_model->get_where($this->session->userdata('user_id'));
        $this->data['image']          = $user_detail['0']['image'];
        $this->data['first_name']     = $user_detail['0']['first_name'];
        $this->data['reference_link'] = $user_detail['0']['reference_link'];
        $this->data['points']         = $user_detail['0']['points'];
        $this->data['active']         = $user_detail['0']['active'];
        $this->data['privacy']         = $user_detail['0']['privacy'];
        $this->data['friends_list'] = $this->member_model->friend_list($this->session->userdata('user_id'));
        $id                           = $this->session->userdata('user_id');
   $data      = [
                'last_activity_timestamp' => date('Y-m-d h:i:s', time()),
                'is_login' => 1
               
            ];
        
            $this->member_model->update_members_profile($id, $data);      
        $this->data['sentbox_data'] = $this->messages_model->get_sent_messages($this->session->userdata('user_id'));
        $this->data['inbox_data'] = $this->messages_model->get_received_messages($this->session->userdata('user_id'));
        
        $this->data['reply_page_data'] = [];
        foreach($this->data['inbox_data'] as $key=> $value)
        {
            array_push($this->data['reply_page_data'], $value['thread_id']);    
        }
        //print_r($this->data['reply_page_data']);
    }
        
    public function index()
    {

//        echo "<pre>";
//        print_r($this->data);exit;
        $this->load->view('messages/index', $this->data);
    }
    
    public function compose()
    {
        
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        if ($this->form_validation->run() == true) {
        
        $data = [
            'sender_id'=> $this->input->post('sender_id'),
            'receiver_id'=> $this->input->post('receiver_id'),
            'subject'=> $this->input->post('subject'),
            'message'=> $this->input->post('message'),
            'thread_id' => $this->messages_model->define_thread($this->input->post('sender_id'), $this->input->post('receiver_id'))
        ];
        $this->messages_model->add_message($data);
        $this->session->set_flashdata('message', 'Message sent successfully');
        redirect(base_url('messages/index'));
        }
        else {
            // display the create user form
            // set the flash data error message if there is one
            $this->session->set_flashdata('validation_errors', (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))));
            
            redirect(base_url('messages/index'), 'refresh');
            
        }
        
    }
    
    public function delete($id, $flagId)
    {
        $flagId = base64_decode($flagId);
        $this->messages_model->delete($id, $flagId);
        $this->session->set_flashdata('message', 'Message deleted successfully');
        redirect(base_url('messages/index'), 'refresh');
    }
    
    public function reply($id){
        $threadData = $this->db->query("SELECT msg.*, mem.id as rec_id, mem.first_name as rec_first_name, mem1.id as sen_id, mem1.first_name as sen_first_name FROM messages msg INNER JOIN members mem ON mem.id = msg.receiver_id INNER JOIN members mem1 ON mem1.id = msg.sender_id WHERE msg.thread_id='$id' ORDER BY msg.parent_id, msg.id")->result_array();
        $this->data['thread_init'] = $threadData;
        $this->data['thread_end'] = end($threadData);
//print_r($threadData);exit;
//exit;
       
        $this->form_validation->set_rules('message', 'Message', 'required');
        $this->data['msgTypeFlag'] = 'reply';
        if ($this->form_validation->run() == true) {
        if (isset($_POST) && !empty($_POST)) {
            $data= [
                'parent_id'=> $this->input->post('parent_id'),
                'sender_id'=> $this->input->post('sender_id'),
                'subject'=> $this->input->post('subject'),
                'receiver_id'=> $this->input->post('receiver_id'),
                'thread_id' => $this->input->post('thread_id'),
                'message'=> $this->input->post('message')
            ];
//print_r($data);        exit;
        $this->messages_model->save_thread($data);
        redirect(base_url('messages/index'));
        }
        }
        else
        {
            // set the flash data error message if there is one
            $this->session->set_flashdata('validation_errors', (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))));
            //redirect(base_url('messages/index'), 'refresh');
            $this->load->view('messages/index', $this->data);
        }
        
    }
}