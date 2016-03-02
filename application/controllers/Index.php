<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends Members_Controller {

    public function __construct(){
        parent::__construct();

    }
    public function index($parent_id=false) {
        //check for reference id if there it is and store this in session.
        if ($parent_id !== false)
        {
            $this->session->set_userdata('parent_id',$parent_id);
        }

        if ($this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect(base_url('dashboard'), 'refresh');
        } else {
            $this->load->view('public/index');
        }


    }
    public function forgotpassword(){
        if ($this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect(base_url('dashboard'), 'refresh');
        } else {
            $this->load->view('public/forgot_password');
        }

    }
    public function view($page = 'home',$data=null)
    {
        if ( ! file_exists(APPPATH.'/views/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->load->view($page, $data);

    }
}
