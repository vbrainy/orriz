<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends Members_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->helper('tree_helper');
    }
    public function index()
    {
        
        $this->load->view('website/index');
    }
    function login()
    {
        $this->data['title'] = "Login";

        //validate form input
        $this->form_validation->set_rules('identity', 'Email', 'required');
        $this->form_validation->set_rules('login_password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            // check to see if the user is logging in
            // check for "remember me"


            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('login_password'), $remember)) {
                //if the login is successful
                //redirect them back to the Dashboard page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect(base_url('dashboard'), 'refresh');
            } else {
                // if the login was un-successful
                // redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('/', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            // the user is not logging in so display the login page
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');



            $this->view('public/index', $this->data);
        }
    }

    Public function logout()
    {


        // log the user out
        $this->ion_auth->logout();

        // redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect(base_url(), 'refresh');
    }

    Public function register_member()
    {
        $p_id = $this->session->userdata('parent_id');
        if (!empty($p_id)) {
            $p_id      = simple_decrypt($p_id);
            $parent_id = $this->member_model->get_id($p_id);
            if ($parent_id != false) {
                $parent_id = $parent_id[0]['id'];
            } else
                $parent_id = 1;
        } else
            $parent_id = 1;

 $tables                        = $this->config->item('tables', 'ion_auth');
        $identity_column               = $this->config->item('identity', 'ion_auth');
        $this->data['identity_column'] = $identity_column;
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|is_unique[' . $tables['users'] . '.email]');

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');

        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');


        $this->form_validation->set_rules('gender', 'Gender', 'required');

        $this->form_validation->set_rules('birthday[0]', 'birthday', 'required');
        $this->form_validation->set_rules('birthday[1]', 'birthday', 'required');
        $this->form_validation->set_rules('birthday[2]', 'birthday', 'required');
        $this->form_validation->set_message('is_unique', '%s not available.');



        if ($this->form_validation->run() == true) {

            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column === 'email');
            $password = $this->input->post('password');

            $date            = implode("-", $this->input->post('birthday'));
            $reference_link  = simple_encrypt($email);
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'gender' => $this->input->post('gender'),
                'parent_id' => $parent_id,
                'birthday' => $date,
                'reference_link' => $reference_link
            );


            $user_id = $this->ion_auth->register($identity, $password, $email, $additional_data);
            if ($user_id != false) {
                if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'))) {
                    //if the login is successful
                    //redirect them back to the Dashboard page
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect(base_url('dashboard/memberdetail'), 'refresh');
                } else {
                    // if the login was un-successful
                    // redirect them back to the login page
                    $this->session->set_flashdata('message', $this->ion_auth->errors());
                    redirect('/', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
                }


            }
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->view('public/index', $this->data);
        }
    }

    // Activate Account After registration
    public function activate($id, $code = false)
    {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($id, $code);
        }


        if ($activation) {
            // to add point up 10 level of member join
            $parent_hierarchy = $this->member_model->get_parent_hierarchy($id);
            $parent_hierarchy = ($parent_hierarchy[0]['GetAncestry(id)']);


            $count_parent = count($parent_hierarchy);
            if ($count_parent > 10) {
                $parent_hierarchy = array_slice($parent_hierarchy, 0, $count_parent - 10);
            }

            $this->member_model->update_points_parent_hierarchy($parent_hierarchy, 10);
            // redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect(base_url(), 'refresh');
        } else {
            // redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect(base_url('members/forgot_password'), 'refresh');
        }
    }

    // reset password - final step for forgotten password
    public function reset_password($code = NULL)
    {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            // if the code is valid then display the password reset form

            $this->form_validation->set_rules('new_password', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {
                // display the form

                // set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $this->data['user_id']             = $user->id;
                $this->data['code']                = $code;

                // render
                $this->view('public/reset_password', $this->data);
            } else {
                // do we have a valid request?
                if ($user->id != $this->input->post('user_id')) {

                    // something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    // show_error($this->lang->line('error_csrf'));

                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new_password'));

                    if ($change) {
                        // if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect(base_url(), 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect(base_url('members/reset_password/') . $code, 'refresh');
                    }
                }
            }
        } else {
            // if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect(base_url('members/forgot_password'), 'refresh');
        }
    }
        function edit_profile()
    {
           
        $id                  = $this->session->userdata('user_id');
        $this->data['title'] = "Edit User";
$this->data['getStep1ProfileDetails'] = $this->member_model->getStep1ProfileDetails($id);


        $user          = $this->ion_auth->user($id)->row();
        $groups        = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
       // $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
       // $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');
       // $this->form_validation->set_rules('city', $this->lang->line('edit_user_validation_fname_label'), 'required');
       // $this->form_validation->set_rules('country', $this->lang->line('edit_user_validation_lname_label'), 'required');
       
        if (isset($_POST) && !empty($_POST)) {
            
            
            // do we have a valid request?
//            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
//                show_error($this->lang->line('error_csrf'));
//            }
//
//            // update the password if it was posted
//            if ($this->input->post('password')) {
//                $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
//                $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
//            }

            if ($this->form_validation->run() === TRUE) {


                $data = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'city' => !empty($this->input->post('city')) ? $this->input->post('city') : "",
                    'country' => !empty($this->input->post('country')) ? trim($this->input->post('country')) : "" ,
                    'relationship_status' => !empty($this->input->post('relationship_status')) ? trim($this->input->post('relationship_status')) : "",
                    'religion' => !empty($this->input->post('religion')) ? trim($this->input->post('religion')) :"" ,
                    'school'=> !empty($this->input->post('school')) ? trim($this->input->post('school')) : "" ,
                    'college'=>   !empty($this->input->post('college')) ? trim($this->input->post('college')) :"",
                    'university'=> !empty($this->input->post('university')) ? trim($this->input->post('university')) : "",
                    "intrest_in_dating" => !empty($this->input->post('dating')) ? trim(1) : 0 ,
                    "intrest_in_friends" => !empty($this->input->post('friends')) ? trim(1) : 0 ,
                    "intrest_in_serious_relationship" => !empty($this->input->post('serious_relationship')) ? trim(1) : 0 ,
                    "intrest_in_networking" => !empty($this->input->post('networking')) ? trim(1) : 0 ,
                );

                // update the password if it was posted
                if ($this->input->post('password')) {
                    $data['password'] = $this->input->post('password');
                }



                // Only allow updating groups if user is admin
                if ($this->ion_auth->is_admin()) {
                    //Update the groups user belongs to
                    $groupData = $this->input->post('groups');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $id);

                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $id);
                        }

                    }
                }

                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect('members/edit_profile', 'refresh');

                } else {

                    $this->session->set_flashdata('message', $this->ion_auth->errors());

                    redirect('members/edit_profile', 'refresh');


                }

            }
        }


        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        $this->view('members/edit_profile', $this->data);
    }
    
    function edit_about_yourself(){
       
        $id                  = $this->session->userdata('user_id');
        $user          = $this->ion_auth->user($id)->row();
        $this->data['title'] = "Edit User";
$this->data['getStep2ProfileDetails'] = $this->member_model->getStep1ProfileDetails($id);


      $this->form_validation->set_rules('music', 'Music', 'trim');
        $this->form_validation->set_rules('movies', 'Movies', 'trim');
        $this->form_validation->set_rules('tv', 'TV Status', 'trim');
        $this->form_validation->set_rules('books', 'Books', 'trim');
        $this->form_validation->set_rules('sports', 'Sports', 'trim');
        $this->form_validation->set_rules('interests', 'Interests Relationship', 'trim');
        $this->form_validation->set_rules('best_feature', 'Best Feature', 'trim');
        $this->form_validation->set_rules('dreams', 'Dreams', 'trim');
        $this->form_validation->set_rules('about_me', 'About Me', 'trim');

        if (isset($_POST) && !empty($_POST)) {
    
            if ($this->form_validation->run() === TRUE) {


        $data = [
                'music' => $this->input->post('music'),
                'movies' => $this->input->post('movies'),
                'tv' => $this->input->post('tv'),
                'books' => $this->input->post('books'),
                'sports' => $this->input->post('sports'),
                'interests' => $this->input->post('interests'),
                'best_feature' => $this->input->post('best_feature'),
                'dreams' => $this->input->post('dreams'),
                'about_me' => $this->input->post('about_me')
            ];
     
        
                // check to see if we are updating the user
                if ($this->ion_auth->update($user->id, $data)) {
                $this->session->set_flashdata('message', $this->ion_auth->messages());
             
                    redirect('members/edit_about_yourself', 'refresh');

                } else {

                    $this->session->set_flashdata('message', $this->ion_auth->errors());

                    redirect('members/edit_about_yourself', 'refresh');


                }

            }
        }
      $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        $this->view('members/edit_about_yourself', $this->data);
    

    }
    
    // Upload Image
    
     public function upload_profile_image()
    {
        $this->load->view('members/edit_uploadimage');
       // p(51);
    }
    
    
        public function upload_image()
    {   if (isset($_POST["upload_thumbnail"])) {
        $upload_path = "public/images/pic/";
        $thumb_width = "150";
        $thumb_height = "150";
        $filename = $_POST['filename']; 

        $large_image_location = $upload_path.$_POST['filename'];
        $thumb_image_location = "public/images/thumb/".$_POST['filename'];

        $x1 = $_POST["x1"];
        $y1 = $_POST["y1"];
        $x2 = $_POST["x2"];
        $y2 = $_POST["y2"];
        $w = $_POST["w"];
        $h = $_POST["h"];

        $scale = $thumb_width/$w;
        
        
        $cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
        
        $data    = [

            'image' => $filename

        ];
        $user_id = $this->session->userdata('user_id');
        $this->member_model->update_members_profile($user_id, $data);
      
        redirect(base_url('members/upload_profile_image'),'refresh');
        exit();
    }


    }
    
    function forgot_password()
    {
        // setting validation rules by checking wheather identity is username or email
        if ($this->config->item('identity', 'ion_auth') != 'email') {
            $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }


        if ($this->form_validation->run() == false) {
            // setup the input
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email'
            );

            if ($this->config->item('identity', 'ion_auth') != 'email') {
                $this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
            } else {
                $this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            // set any errors and display the form
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->view('public/forgot_password', $this->data);
        } else {
            $identity_column = $this->config->item('identity', 'ion_auth');
            $identity        = $this->ion_auth->where($identity_column, $this->input->post('email'))->users()->row();

            if (empty($identity)) {

                if ($this->config->item('identity', 'ion_auth') != 'email') {
                    $this->ion_auth->set_error('forgot_password_identity_not_found');
                } else {
                    $this->ion_auth->set_error('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('message_forgot_password', $this->ion_auth->errors());
                redirect(base_url('index/forgot_password'), 'refresh');
            }

            // run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                // if there were no errors
                $this->session->set_flashdata('message_forgot_password', $this->ion_auth->messages());
                redirect(base_url('index/forgot_password'), 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message_forgot_password', $this->ion_auth->errors());
                redirect(base_url('index/forgot_password'), 'refresh');
            }
        }
    }

    function view($view, $data = null, $returnhtml = false) //I think this makes more sense
    {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);

        if ($returnhtml)
            return $view_html; //This will return html on 3rd argument being true
    }
    
    function change_passwod(){
         $this->load->view('members/change_password');
    }
}
