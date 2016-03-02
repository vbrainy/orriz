<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members_Controller extends MY_Controller {

    public function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->library(array('ion_auth','form_validation','breadcrumbs'));
            $this->load->helper(array('url','language','form'));

            $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

            $this->lang->load('auth');
//            $exception_url  =array(
//                 'index',
//                'members/logout',
//
//            );
//            if(in_array(uri_string(),$exception_url)== false){
//                if($this->ion_auth->logged_in()==false){
//                    redirect('index/index');
//                }
//            }
        }




}
