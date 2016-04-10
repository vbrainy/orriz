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
        
        $this->data['sentbox_data'] = $this->messages_model->get_sent_messages($this->session->userdata('user_id'));
        $this->data['inbox_data'] = $this->messages_model->get_received_messages($this->session->userdata('user_id'));
        
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
        redirect(base_url('messages/index'));
        }
        else {
            // display the create user form
            // set the flash data error message if there is one
            $this->session->set_flashdata('message', (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'))));
            
            redirect(base_url('messages/index'), 'refresh');
            
        }
        
    }
    
    public function delete($id)
    {
        $this->messages_model->delete($id);
        redirect(base_url('messages/index'));
    }
    
    public function reply($id){
        $threadData = $this->db->query("SELECT msg.* FROM messages msg WHERE msg.thread_id='$id' ORDER BY parent_id")->result_array();
        $this->data['thread_init'] = $threadData;
        $this->data['thread_end'] = end($threadData);
//print_r(end($this->data['thread_init']));exit;
//exit;
       
        //p($_POST);
        if (isset($_POST) && !empty($_POST)) {
            $data= [
                'parent_id'=> $this->input->post('parent_id'),
                'sender_id'=> $this->input->post('sender_id'),
                'subject'=> $this->input->post('subject'),
                'receiver_id'=> $this->input->post('receiver_id'),
                'thread_id' => $this->messages_model->define_thread($this->input->post('sender_id'), $this->input->post('receiver_id')),
                'message'=> $this->input->post('message')
            ];
//print_r($data);        exit;
        $this->messages_model->save_thread($data);
        redirect(base_url('messages/index'));
        }
        $this->data['msgTypeFlag'] = 'reply';
        $this->load->view('messages/index', $this->data);
    }
}