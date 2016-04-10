<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends Members_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->ion_auth->logged_in() == false) {
            redirect(base_url());
        }
        $this->load->model('member_model');
        $this->load->model('posts_model');
    }

    public function status_insert()
    {
        $this->form_validation->set_rules('status', 'Status', 'trim');
        if ($_FILES['image']['name'] != null && $this->input->post('status') != null) {
            $config['upload_path'] = './public/images/pic/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '1024';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image') == false) {
                $this->data['message'] = $this->upload->display_errors();

              /*  redirect(base_url('dashboard'), 'refresh');*/

            } else {
                $image = $this->upload->data('file_name');
                $config['image_library'] = 'gd2';
                $config['source_image'] = "./public/images/pic/$image";
                $config['create_thumb'] = TRUE;
                $config['new_image'] = './public/images/thumb/';
                $config['thumb_marker'] = '';
                $config['maintain_ratio'] = False;
                $config['width'] = 200;
                $config['height'] = 200;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                $data = [
                    'member_id'  => $this->session->userdata('user_id'),
                    'status'     => $this->input->post('status', True),
                    'photos'     => $this->upload->data('file_name'),
                    'privacy' => $this->input->post('privacy', True),

                ];

               $insert_id= $this->posts_model->insert_post($data);
                $this->data['posts']=$this->posts_model->get_one_post($insert_id);
                $this->view('members/posts',$this->data);

//                redirect(base_url('dashboard'), 'refresh');
            }
        } elseif ($this->input->post('status') != null && $_FILES['image']['name'] == null) {
            $data = [
                'member_id'  => $this->session->userdata('user_id'),
                'status'     => $this->input->post('status', True),
                'privacy' => $this->input->post('privacy', True),

            ];

            $insert_id= $this->posts_model->insert_post($data);
            $this->data['posts']=$this->posts_model->get_one_post($insert_id);
            $this->view('members/posts',$this->data);


        } elseif ($this->input->post('status') == null && $_FILES['image']['name'] != null) {
            $config['upload_path'] = './public/images/pic/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '1024';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image') == false) {
                $this->data['message'] = $this->upload->display_errors();

            //    redirect(base_url('dashboard'), 'refresh');

            } else {
                $image = $this->upload->data('file_name');
                $config['image_library'] = 'gd2';
                $config['source_image'] = "./public/images/pic/$image";
                $config['create_thumb'] = TRUE;
                $config['new_image'] = './public/images/thumb/';
                $config['thumb_marker'] = '';
                $config['maintain_ratio'] = False;
                $config['width'] = 200;
                $config['height'] = 200;

                $this->load->library('image_lib', $config);

                $this->image_lib->resize();

                $data = [
                    'member_id'  => $this->session->userdata('user_id'),
                    'photos'     => $this->upload->data('file_name'),
                    'privacy' => $this->input->post('privacy', True),

                ];

                $insert_id= $this->posts_model->insert_post($data);
                $this->data['posts']=$this->posts_model->get_one_post($insert_id);
                $this->view('members/posts',$this->data);
            }
        }
        // redirect(base_url('dashboard'), 'refresh');

    }
    public function luv(){
        if(isset($_GET['type']) && isset($_GET['postid'])){
            $type=$_GET['type'];
            $post_id=(int)$_GET['postid'];
            switch($type){
                case 'posts':
                    $this->posts_model->posts_like($this->session->userdata('user_id'),$post_id);
                    break;
            }
            redirect(base_url('dashboard'));

        }
    }
    public function like_post() {
        if (isset($_POST['post_id'])) {

// Find Like 
            $post_id = (int) $_POST['post_id'];
            $model = $this->posts_model->find_like_on_post($this->session->userdata('user_id'), $post_id);
            if ($model == 0) {
                $this->posts_model->posts_like($this->session->userdata('user_id'), $post_id);
                echo "1" ;
            } else {
                $this->posts_model->remove_post_like($this->session->userdata('user_id'), $post_id);
                echo "0" ;
            }
        }
    }

    public function get_like(){

        if(isset($_POST['post_id'])){
            $post_id=(int)$_POST['post_id'];
            $result=$this->posts_model->get_posts_like($post_id);

            echo $result[0]['likes'];

        }

    }
    public function privacy(){
        $this->form_validation->set_rules('privacy', 'Privacy', 'required|trim');
        if ($this->form_validation->run() == True) {
            $data=['privacy'=>$this->input->post('privacy')];
            $id        = $this->session->userdata('user_id');
            $this->member_model->update_members_profile($id, $data);
            redirect(base_url('dashboard'), 'refresh');
        }else
        redirect(base_url('dashboard'), 'refresh');
    }
    public function add_comment(){
        $this->form_validation->set_rules('comment', 'Comment', 'required|trim');
        $this->form_validation->set_rules('post_id', 'Post ID', 'required|trim');
        if ($this->form_validation->run() == True) {

            $user_id        = $this->session->userdata('user_id');
            $post_id        =  $this->input->post('post_id', True);
            $comment        =  $this->input->post('comment', True);
            if($this->posts_model->posts_comment($user_id,$post_id,$comment)!=false){
                echo "success";
            }
        }else
            echo "Please enter your comment";
    }
    public function get_comments(){
        if(isset($_POST['post_id'])){
            $post_id=(int)$_POST['post_id'];
            $this->data['comments']=$this->posts_model->get_posts_comments($post_id);
            if($this->data['comments']!=false){
                $this->view('members/comments',$this->data);
            }else echo "No comment found";



        }
    }
    public function ajex_load_posts(){

        
       
        
        $this->load->model('posts_model');
        $start=$_POST['start'];
        $records_per_page=$_POST['records_per_page'];
        $privacy=$_POST['privacy'];
        $friends=($_POST['friends']);

        if($privacy==1){
            $this->data['posts']=$this->posts_model->select_rows_privacy1($start, $records_per_page,$friends);
        //    $this->data['is_my_posts'] =  
            $this->view('members/posts',$this->data);
        }elseif($privacy==2){
            $this->data['posts']=$this->posts_model->select_rows_privacy2($start, $records_per_page,$friends);
            $this->view('members/posts',$this->data);
        }elseif($privacy==3){
            $this->data['posts']=$this->posts_model->select_rows_privacy3($start, $records_per_page,$friends);
            $this->view('members/posts',$this->data);
        }



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