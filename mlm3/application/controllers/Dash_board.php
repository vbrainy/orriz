<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash_board extends Members_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->library(array(
            'session',
            'form_validation'
        ));
        if ($this->ion_auth->logged_in() == false) {
            redirect(base_url());
        }
    }

    public function member_detail()
    {
        $this->form_validation->set_rules('city', 'City', 'trim');
        $this->form_validation->set_rules('country', 'Country', 'trim');
        $this->form_validation->set_rules('relationship_status', 'Relationship Status', 'trim');
        $this->form_validation->set_rules('dating', 'Dating', 'trim');
        $this->form_validation->set_rules('friends', 'Friends', 'trim');
        $this->form_validation->set_rules('serious_relationship', 'Serious Relationship', 'trim');
        $this->form_validation->set_rules('networking', 'Networking', 'trim');
        $this->form_validation->set_rules('religion', 'Religion', 'trim');
        $this->form_validation->set_rules('school', 'School Name', 'trim');
        $this->form_validation->set_rules('college', 'College Name', 'trim');
        $this->form_validation->set_rules('university', 'University', 'trim');

        if ($this->form_validation->run() == True) {
            $intereset = array(
                $this->input->post('dating'),
                $this->input->post('friends'),
                $this->input->post('serious_relationship'),
                $this->input->post('networking')
            );
            $intereset = implode(",", $intereset);
            $data      = array(
                'city' => $this->input->post('city'),
                'country' => $this->input->post('country'),
                'relationship_status' => $this->input->post('relationship_status'),
                'interested_in' => $intereset,
                'religion' => $this->input->post('religion'),
                'school' => $this->input->post('school'),
                'college' => $this->input->post('college'),
                'university' => $this->input->post('university')
            );
            $id        = $this->session->userdata('user_id');
            $this->member_model->update_members_profile($id, $data);
            redirect(base_url('dash_board/about_yourself'), 'refresh');
        } else
            $this->view('public/details');
    }
    public function about_yourself()
    {

        $this->form_validation->set_rules('music', 'Music', 'trim');
        $this->form_validation->set_rules('movies', 'Movies', 'trim');
        $this->form_validation->set_rules('tv', 'TV Status', 'trim');
        $this->form_validation->set_rules('books', 'Books', 'trim');
        $this->form_validation->set_rules('sports', 'Sports', 'trim');
        $this->form_validation->set_rules('interests', 'Interests Relationship', 'trim');
        $this->form_validation->set_rules('best_feature', 'Best Feature', 'trim');
        $this->form_validation->set_rules('dreams', 'Dreams', 'trim');
        $this->form_validation->set_rules('about_me', 'About Me', 'trim');

        if ($this->form_validation->run() == True) {

            $data = array(
                'music' => $this->input->post('music'),
                'movies' => $this->input->post('movies'),
                'tv' => $this->input->post('tv'),
                'books' => $this->input->post('books'),
                'sports' => $this->input->post('sports'),
                'interests' => $this->input->post('interests'),
                'best_feature' => $this->input->post('best_feature'),
                'dreams' => $this->input->post('dreams'),
                'about_me' => $this->input->post('about_me')
            );
            $id   = $this->session->userdata('user_id');
            $this->member_model->update_members_profile($id, $data);
            redirect(base_url('dash_board/upload_image'), 'refresh');
        } else
            $this->view('public/aboutme');
    }
    public function do_upload()
    {


        $config['upload_path']   = './public/images/pic/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '1024';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image') == false) {
            $this->data['message'] = $this->upload->display_errors();

            $this->view('public/uploadimage', $this->data);

        } else {
            $image                    = $this->upload->data('file_name');
            $config['image_library']  = 'gd2';
            $config['source_image']   = "./public/images/pic/$image";
            $config['create_thumb']   = TRUE;
            $config['new_image']      = './public/images/thumb/';
            $config['thumb_marker']   = '';
            $config['maintain_ratio'] = False;
            $config['width']          = 200;
            $config['height']         = 200;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();

            $data    = array(

                'image' => $this->upload->data('file_name')

            );
            $user_id = $this->session->userdata('user_id');
            $this->member_model->update_members_profile($user_id, $data);
            redirect(base_url('dashboard'), 'refresh');
        }


    }
    public function upload_image()
    {
        $this->view('public/uploadimage');
    }
    public function activation_email()
    {


        $this->view('public/activation_email');
    }
    public function logout()
    {
        session_unset();
        redirect(base_url(), 'refresh');
    }

    public function view($page = 'home', $data = null)
    {
        if (!file_exists(APPPATH . '/views/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->load->view($page, $data);

    }
}