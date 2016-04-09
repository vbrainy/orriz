<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Members_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->ion_auth->logged_in() == false) {
            redirect(base_url());
        }
        $this->load->model('member_model');
        $this->load->model('ad_model');
        $this->load->helper('tree_helper');
        $this->load->library('pagination');
          $this->config->load('paging', TRUE);
        $this->paging = $this->config->item('paging');// p( $this->paging);
        $user_detail                  = $this->member_model->get_where($this->session->userdata('user_id'));
        $this->data['image']          = $user_detail['0']['image'];
        $this->data['first_name']     = $user_detail['0']['first_name'];
        $this->data['reference_link'] = $user_detail['0']['reference_link'];
        $this->data['points']         = $user_detail['0']['points'];
        $this->data['active']         = $user_detail['0']['active'];
        $this->data['privacy']         = $user_detail['0']['privacy'];
        $id                           = $this->session->userdata('user_id');
        

   // 
        $result              = $this->member_model->ten_level_table($id);
        $this->data['table'] = $result;
        $table               = [];

        foreach ($result as $value) {
            $table[] = $value['child_id_1'];
            $table[] = $value['child_id_2'];
            $table[] = $value['child_id_3'];
            $table[] = $value['child_id_4'];
            $table[] = $value['child_id_5'];
            $table[] = $value['child_id_6'];
            $table[] = $value['child_id_7'];
            $table[] = $value['child_id_8'];
            $table[] = $value['child_id_9'];
            $table[] = $value['child_id_10'];
        }
        $table                       = array_filter($table);
        $table                       = array_unique($table);
        $total_refreal               = count($table);
        $this->data['total_referel'] = $total_refreal;
    }
    public function index()
    {   $this->data['ads'] = $this->ad_model->get_latest_10_ad();
        $this->load->library('pagination');
        $this->load->model('posts_model');
        $friends_list=$this->member_model->friend_list($this->session->userdata('user_id'));

        if($friends_list!=null){
            $friends=[];
            foreach($friends_list as $friend){

              $friends[]=$friend['id'];
            }
        }else $friends=null;

        if($this->data['privacy']==1){
            $friends[]=$this->session->userdata('user_id');

            $this->data['friends']=$friends;
            $this->data['total_records']= $this->posts_model->count_rows_privacy1($friends);
            $this->data['records_per_page']=5;
            $this->data['number_of_pages']=ceil($this->data['total_records']/  $this->data['records_per_page']);
            $this->data['current_page']=1;
            $this->data['start']=($this->data['current_page']*$this->data['records_per_page'])- $this->data['records_per_page'];
            $this->view('members/dashboard',$this->data);
        }elseif($this->data['privacy']==2){

            if($friends==null){
               $friends[]=0;
            }
            $this->data['friends']=$friends;
            $this->data['total_records']= $this->posts_model->count_rows_privacy2($friends);
            $this->data['records_per_page']=5;
            $this->data['number_of_pages']=ceil($this->data['total_records']/  $this->data['records_per_page']);
            $this->data['current_page']=1;
            $this->data['start']=($this->data['current_page']*$this->data['records_per_page'])- $this->data['records_per_page'];

            $this->view('members/dashboard',$this->data);

        }
          elseif($this->data['privacy']==3){

            $friends=$this->session->userdata('user_id');
              $this->data['friends']=$friends;
              $this->data['total_records']= $this->posts_model->count_rows_privacy3($friends);
              $this->data['records_per_page']=5;
              $this->data['number_of_pages']=ceil($this->data['total_records']/  $this->data['records_per_page']);
              $this->data['current_page']=1;
              $this->data['start']=($this->data['current_page']*$this->data['records_per_page'])- $this->data['records_per_page'];

            $this->view('members/dashboard',$this->data);
            }

    }

    public function postad(){

        $this->form_validation->set_rules('ad_title', 'Ad Title', 'required|max_length[25]');
        $this->form_validation->set_rules('ad_description', 'Ad Description', 'required|max_length[70]');
        $this->form_validation->set_rules('ad_url', 'Ad Url', 'required|max_length[25]');
        $this->form_validation->set_rules('points', 'Points', 'greater_than_equal_to[10]');
        function points_error($points)
        {
            if ($points >= 10) {
                return true;
            } else
                return false;
        }


        if ($this->form_validation->run() == True) {
            $data = [
                'ad_title' => $this->input->post('ad_title', True),
                'ad_description' => $this->input->post('ad_description', True),
                'ad_url' => $this->input->post('ad_url', True),
                'member_id' => $this->session->userdata('user_id'),
                'point_used' => 10
            ];

            $this->ad_model->insert_ad($data);
            $this->member_model->debit_points($this->session->userdata('user_id'), 10);

            $this->data['message'] = 'Ad Posted Successfully';
            $this->index();

        } else {

            $this->data['message'] = validation_errors();
           $this->index();
        }

    }


    public function table()
    {
        $this->view('members/table', $this->data);
    }

    public function tree($id = null)
    {
        if ($id == null) {
            $id = $this->session->userdata('user_id');
        }
        $result1 = $this->member_model->get_where($id);
        $child   = $result1[0]['GetFamilyTree(id)'];
        $child   = (explode(",", $child));
        array_unshift($child, $id);
        $result2                 = $this->member_model->total_referel($child);
        $result2[0]['parent_id'] = "0";
        $menu2                   = make_array_for_tree($result2);
        $this->data['child']     = makeTree($menu2);
        $this->view('members/tree', $this->data);

    }
    public function wallet()
    {
        $total_referel                        = $this->member_model->total_indirect_referel($this->session->userdata('user_id'));
        $total_referel                        = $total_referel[0]['GetFamilyTree(id)'];
        $total_referel                        = explode(",", $total_referel);
        $total_referel                        = count($total_referel);
        $total_direct_referel                 = $this->member_model->total_direct_referel($this->session->userdata('user_id'));
        $total_direct_referel                 = $total_direct_referel[0]['count(id)'];
        $total_indirect_referel               = $total_referel - $total_direct_referel;
        $this->data['total_indirect_referel'] = $total_indirect_referel;
        $this->data['total_direct_referel']   = $total_direct_referel;
        $this->view('members/wallet', $this->data);
    }
    public function reference()
    {

        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
        if ($this->form_validation->run() == True) {
            $this->load->library('email');
            $this->email->from($this->session->userdata('email'), $this->session->userdata('first_name'));
            $this->email->to($this->input->post('email'));

            $this->email->subject('Reference Link');
            $reference_link = base_url() . 'index/' . $this->data['reference_link'];
            $this->email->message($reference_link);

            $this->email->send();
            $this->data['message'] = "Invitation sent Successfuly";
            $this->view('members/referfriend', $this->data);
        } elseif (validation_errors()) {
            $this->data['message'] = validation_errors();
        } else
            $this->view('members/referfriend', $this->data);

    }

    public function memberdetail()
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
//            $intereset = [
//                $this->input->post('dating'),
//                $this->input->post('friends'),
//                $this->input->post('serious_relationship'),
//                $this->input->post('networking')
//            ];
           // $intereset = implode(",", $intereset);
            $data      = [
                'city' => $this->input->post('city'),
                'country' => $this->input->post('country'),
                'relationship_status' => $this->input->post('relationship_status'),
              //  'interested_in' => $intereset,
                 "intrest_in_dating" => !empty($this->input->post('dating')) ? trim(1) : 0 ,
                 "intrest_in_friends" => !empty($this->input->post('friends')) ? trim(1) : 0 ,
                 "intrest_in_serious_relationship" => !empty($this->input->post('serious_relationship')) ? trim(1) : 0 ,
                "intrest_in_networking" => !empty($this->input->post('networking')) ? trim(1) : 0 ,
                'religion' => $this->input->post('religion'),
                'school' => $this->input->post('school'),
                'college' => $this->input->post('college'),
                'university' => $this->input->post('university')
            ];
            $id        = $this->session->userdata('user_id');
            $this->member_model->update_members_profile($id, $data);
            redirect(base_url('dashboard/aboutyourself'), 'refresh');
        } else
            $this->view('members/details');
    }
    public function aboutyourself()
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
            $id   = $this->session->userdata('user_id');
            $this->member_model->update_members_profile($id, $data);
            redirect(base_url('dashboard/uploadimage'), 'refresh');
        } else
            $this->view('members/aboutme');
    }
//    public function doupload()
//    {
//
//        $config['upload_path']   = './public/images/pic/';
//        $config['allowed_types'] = 'gif|jpg|png|jpeg';
//        $config['max_size']      = '512';
//        $this->load->library('upload', $config);
//        if ($this->upload->do_upload('image') == false) {
//            $this->data['message'] = $this->upload->display_errors();
//
//            $this->view('members/uploadimage', $this->data);
//
//        } else {
//            $image                    = $this->upload->data('file_name');
//            $config['image_library']  = 'gd2';
//            $config['source_image']   = "./public/images/pic/$image";
//            $config['create_thumb']   = TRUE;
//            $config['new_image']      = './public/images/thumb/';
//            $config['thumb_marker']   = '';
//            $config['maintain_ratio'] = False;
//            $config['width']          = 100;
//            $config['height']         = 100;
//
//            $this->load->library('image_lib', $config);
//
//            $this->image_lib->resize();
//
//            $data    = [
//
//                'image' => $this->upload->data('file_name')
//
//            ];
//            $user_id = $this->session->userdata('user_id');
//            $this->member_model->update_members_profile($user_id, $data);
//            redirect(base_url('dashboard'), 'refresh');
//        }
//
//
//    }
    
    
    public function upload(){
        $file_formats = array("jpg", "png", "gif", "bmp");

        $filepath = "public/images/pic/";
        $preview_width = "400";
        $preview_height = "300";

            $name = $_FILES['imagefile']['name']; // filename to get file's extension
            $size = $_FILES['imagefile']['size'];

            if (strlen($name)) {
                $extension = substr($name, strrpos($name, '.')+1);
                if (in_array($extension, $file_formats)) { // check it if it's a valid format or not
                    if ($size < (2048 * 1024)) { // check it if it's bigger than 2 mb or no
                        $imagename = md5(uniqid() . time()) . "." . $extension;

                        $tmp = $_FILES['imagefile']['tmp_name'];
                        if (move_uploaded_file($tmp, $filepath . $imagename)) {
                            echo $imagename;
                        } else {
                            echo "Could not move the file";
                        }
                    } else {
                        echo "Your image size is bigger than 2MB";
                    }
                } else {
                    echo "Invalid file format";
                }
            } else {
                echo "Please select image!";
            }
            exit();

    }
    public function uploadimage()
    {
        $this->view('members/uploadimage');
    }
    public function uploadimage1()
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
      
        redirect(base_url('dashboard'),'refresh');
        exit();
    }


    }
//    public function buypoints()
//    {
//        $this->view('members/uploadimage');
//    }
    public function buy()
    {  $this->load->model('paypal_model');
        $point_price=$this->paypal_model->get_point_price();
        $this->data['point_price']=    $point_price;
        $this->form_validation->set_rules('Amount', 'Amount', 'required|is_natural_no_zero');
        if ($this->form_validation->run() == True) {
            $setting=$this->paypal_model->get_setting();
            $setting=$setting[0];
            $this->data['setting']=$setting;
            $price_point=$this->paypal_model->get_point_price_by_id($this->input->post('Amount'));
            $this->data['quantity']=$price_point[0]['quantity'];
            $this->session->set_userdata('quantity',$this->data['quantity']);
            $this->data['item_number'] = $this->input->post('amount');
            $this->data['amount']=$price_point[0]['price'];
            $this->session->set_userdata('total_price',$this->data['amount']);
            $this->view('members/buy',$this->data);
        }else {
          $this->data['message']= validation_errors();

        $this->view('members/buy',$this->data);}
    }
    public function status()
    {

        $this->view('members/status',$this->data);


    }
    public function check()
    {
        $total_price= $this->session->userdata('total_price');
        if($total_price==$_GET['amt']){
            $data=['member_id'=>$this->session->userdata('user_id'),
                        'email'=>$this->session->userdata('email'),
                        'total_payments'=>$_GET['amt'],
                        'currency'=>$_GET['cc'],
                        'transaction_id'=>$_GET['tx'],
                        'quantity'=> $this->session->userdata('quantity'),
                                  ];
            $this->load->model('paypal_model');
          $insert_id=$this->paypal_model->insert_payments($data);
              if($insert_id!==false){
                  $this->paypal_model->update_points($this->session->userdata('user_id'),$this->session->userdata('quantity'));
                  $this->session->set_flashdata('status','Transaction Successfully Completed');
                  redirect('dashboard/status','refresh');
              } else

            $this->session->set_flashdata('status','Something went wrong Please Contact administrator');
            redirect('dashboard/status','refresh');

        }else { $this->session->set_flashdata('status','Transaction Failed, Please try again');
        redirect('dashboard/status','refresh');  }



    }
   
    public function search() {

        $this->form_validation->set_rules('typeahead', 'Search', 'required|trim');
        if ($this->form_validation->run() == True) {
      $string= $this->input->post('typeahead',TRUE);
        $array= explode(' ', $string);
       $query_parts = [];
        foreach ($array as $val) {
            $query_parts[] = "'%".($val)."'";
        }
        $string1 = implode(' OR first_name LIKE ', $query_parts);
        $string2 = implode(' AND last_name LIKE ', $query_parts);
           $this->session->Set_userdata('string1',$string1);
           $this->session->Set_userdata('string2',$string2);
            $this->load->library('pagination');
            $this->load->model('posts_model');
            $config['base_url'] = 'http://orriz.com/dashboard/search/';
            $config['total_rows'] = $this->member_model->count_search_friend($string1,$string2);
            $config['per_page'] = 10;

            $this->pagination->initialize($config);
            if($this->uri->segment(3)==null){
                $start=0;
            }else $start=$this->uri->segment(3);
            $this->data['result']=$this->member_model->search_friend($string1,$string2,$start,$config['per_page'],$this->session->userdata('user_id'));
            if( $this->data['result']!=false){
             $this->view('members/browse',$this->data);
             }else{
             $this->data['messages']="No Record Found";
             $this->view('members/browse',$this->data);
         }
         }else{


            $this->load->model('posts_model');
            $config['base_url'] = 'http://orriz.com/dashboard/search/';
            $config['total_rows'] = $this->member_model->count_search_friend($this->session->userdata('string1'), $this->session->userdata('string2'),$this->session->userdata('user_id'));
            $config['per_page'] = 10;

            $this->pagination->initialize($config);
            if($this->uri->segment(3)==null){
                $start=0;
            }else $start=$this->uri->segment(3);
            $this->data['result']=$this->member_model->search_friend( $this->session->userdata('string1'), $this->session->userdata('string2'),$start,$config['per_page'],$this->session->userdata('user_id'));

            if( $this->data['result']!=false){
                $this->view('members/browse',$this->data);
            }else{
                $this->data['messages']="No Record Found";
                $this->view('members/browse',$this->data);
            }

        }
    }
    public function suggestions(){
        $key=$_GET['key'];
        $array= explode(' ', $key);
        $query_parts = [];
        foreach ($array as $val) {
            $query_parts[] = "'%".($val)."%'";
        }
        $string1 = implode(' OR first_name LIKE ', $query_parts);
        $string2 = implode(' OR last_name LIKE ', $query_parts);
        $result=[];
        $query=$this->member_model->search_friends($string1,$string2);

        foreach($query as $row)
        {
            $result[] = $row['first_name'].' '.$row['last_name'];
        }
        echo json_encode($result);
    }
    public function request(){
       $friend_two=$_GET['friend_id'];
        $friend_one=$this->session->userdata('user_id');
        $data=['friend_one'=>$friend_one,
        'friend_two'=>$friend_two];
        $this->member_model->friend_requests($data);
          redirect('dashboard/search');

    }
    public function friends(){
        $friend_requests= $this->member_model->friend_request_recieved($this->session->userdata('user_id'));
        if($friend_requests!=null){
            $this->data['friend_requests']=$friend_requests;

        }else{
            $this->data['messages1']="No friend requests";

        }
      $friend_list=  $this->member_model->friend_list($this->session->userdata('user_id'));
        if($friend_list!=null){
            $this->data['friend_list']=$friend_list;
            $this->view('members/friends',$this->data);
        }else{
            $this->data['messages']="No friend";
            $this->view('members/friends',$this->data);
        }


    }
    public function friendrequests(){
        $friend_requests= $this->member_model->friend_request_recieved($this->session->userdata('user_id'));
        if($friend_requests!=null){
            $this->data['friend_requests']=$friend_requests;

        }else{
            $this->data['messages1']="No friend requests";

        }
        $this->view('members/friend_requests',$this->data);
    }
    public function onlinefriends(){
        $this->view('members/online_friends',$this->data);
    }
    public function requestaccept(){
      $friend_id=$_GET['friend_id'];
        $this->member_model->acceptfriendrequest($friend_id,$this->session->userdata('user_id'));
        redirect(base_url('dashboard/friends'),'refresh');

    }
    public function requestdelete(){
        $friend_id=$_GET['friend_id'];
        $this->member_model->deletefriendrequest($friend_id,$this->session->userdata('user_id'));
        redirect(base_url('dashboard/friends'),'refresh');
    }
    public function unfriend(){
        $friend_id=$_GET['friend_id'];
        $this->member_model->deletefriend($friend_id,$this->session->userdata('user_id')) or customDie('dashboard/friends');
        redirect(base_url('dashboard/friends'),'refresh');
    }
    public function view($page = 'home', $data = null)
    {
        if (!file_exists(APPPATH . '/views/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $this->load->view($page, $data);

    }
    public function invitefriends()
    {
      if ($this->input->is_ajax_request()) {
     
        if (!empty($_POST)) {
            
            $this->load->library('email');
            $this->email->from($this->session->userdata('email'), $this->session->userdata('first_name'));
            $this->email->to($this->input->post('email'));

            $this->email->subject('Invitation From Orriz');
            $reference_link = "";
            $this->email->message("testing email for invitation");

            $this->email->send();
            $this->data['message'] = "Invitation sent Successfuly";
           
           echo  1;
           exit();
        } else{
            return 0;
             exit();
        }
       

    }

 $this->load->view('members/invite_friends',$this->data);
}

// By New Code 
 public function browse()
{
                $limit = $this->paging['per_page'];
               
                $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

                //Addingg Setting Result to variable
                $this->data['users'] = $this->member_model->get_all_users($limit, $offset);
                $this->paging['base_url'] = site_url("dashboard/browse");
                $this->paging['uri_segment'] = 3;
                $this->paging['total_rows'] = count($this->member_model->get_all_users());
                $this->pagination->initialize($this->paging);
                 $this->load->view('members/browse', $this->data);
                
}
}