<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Posts_model extends CI_Model
{


    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }
    public function insert_post($data){
    $this->db->insert('posts',$data);
        return $this->db->insert_id();

    }

    public function count_rows_privacy1($friend_list=array()){


        $friend_list = join(', ', $friend_list);

        $query=$this->db->query("SELECT posts.id,posts.status,posts.photos , posts.time ,members.first_name,members.last_name, members.image, COUNT(posts_like.id) as likes, GROUP_CONCAT(members.first_name SEPARATOR '|') AS liked_by from posts left JOIN posts_like ON posts.id=posts_like.post_id left join members on members.id=posts.member_id where posts.member_id in($friend_list) and (posts.privacy in (1, 2, 3)) Group by posts.id order by posts.id DESC");
        return $query->num_rows();

    }
    public function count_rows_privacy2($friend_list=array()){
        $friend_list = join(', ', $friend_list);

        $query="SELECT posts.id,posts.status,posts.photos , posts.time ,members.first_name,members.last_name, members.image, COUNT(posts_like.id) as likes, GROUP_CONCAT(members.first_name SEPARATOR '|') AS liked_by from posts left JOIN posts_like ON posts.id=posts_like.post_id left join members on members.id=posts.member_id where posts.member_id in($friend_list) and posts.privacy=2  Group by posts.id order by posts.id DESC";

        $query=$this->db->query($query);


        return $query->num_rows();

    }
    public function count_rows_privacy3($friend_list){
        $query=$this->db->query("SELECT posts.id,posts.status,posts.photos , posts.time ,members.first_name,members.last_name, members.image, COUNT(posts_like.id) as likes, GROUP_CONCAT(members.first_name SEPARATOR '|') AS liked_by from posts left JOIN posts_like ON posts.id=posts_like.post_id left join members on members.id=posts.member_id where posts.member_id = $friend_list and posts.privacy=3 Group by posts.id order by posts.id DESC");
        return $query->num_rows();

    }
    public function count_search_rows(){

    $query=$this->db->get('posts');
    return $query->num_rows();

    }
    public function select_rows_privacy1($start,$limit,$friend_list){
        //$friend_list = join(', ', $friend_list);
        $q = "SELECT posts.id,posts.status,posts.photos , posts.time ,members.first_name,members.last_name, members.image, COUNT(posts_like.id) as likes, GROUP_CONCAT(members.first_name SEPARATOR '|') AS liked_by from posts left JOIN posts_like ON posts.id=posts_like.post_id left join members on members.id=posts.member_id where posts.privacy =1  Group by posts.id order by posts.id DESC Limit $start, $limit";
        $query= $this->db->query($q);
        //print_R($query->result_array());
        return $query->result_array();

    }
    public function select_rows_privacy2($start,$limit,$friend_list){
        //$friend_list = join(', ', $friend_list);
        //echo $q = "SELECT posts.id,posts.status,posts.photos , posts.time ,members.first_name,members.last_name, members.image, COUNT(posts_like.id) as likes, GROUP_CONCAT(members.first_name SEPARATOR '|') AS liked_by from posts left JOIN posts_like ON posts.id=posts_like.post_id left join members on members.id=posts.member_id where posts.member_id in($friend_list) and posts.privacy=2  Group by posts.id order by posts.id DESC Limit $start,$limit";
        $q = "SELECT posts.id,posts.status,posts.photos , posts.time ,members.first_name,members.last_name, members.image, COUNT(posts_like.id) as likes, GROUP_CONCAT(members.first_name SEPARATOR '|') AS liked_by from posts left JOIN posts_like ON posts.id=posts_like.post_id left join members on members.id=posts.member_id where posts.privacy=2  Group by posts.id order by posts.id DESC Limit $start,$limit";
        $query= $this->db->query($q);
        //print_R($query->result_array());exit;
        return $query->result_array();

    }
    public function select_rows_privacy3($start,$limit,$friend_list){
       //$friend_list = join(', ', $friend_list);
       $q = "SELECT posts.id,posts.status,posts.photos , posts.time ,members.first_name,members.last_name, members.image, COUNT(posts_like.id) as likes, GROUP_CONCAT(members.first_name SEPARATOR '|') AS liked_by from posts left JOIN posts_like ON posts.id=posts_like.post_id left join members on members.id=posts.member_id where posts.privacy=3 Group by posts.id order by posts.id DESC Limit $start, $limit";
       $query= $this->db->query($q);
       // print_R($query->result_array());exit;
        return $query->result_array();

    }
    public function posts_like($user_id,$posts_id){
        $query=$this->db->query("insert into posts_like (member_id,post_id) select $user_id,$posts_id from posts where exists (select id from posts where id = $posts_id) and not exists (select id from posts_like where member_id=$user_id and post_id=$posts_id) LIMIT 1 ");
        return $this->db->insert_id();
    }
    public function get_posts_like($posts_id){
        $query=$this->db->query("select COUNT(id) as likes from posts_like WHERE post_id = $posts_id");
        return $query->result_array();
    }
    public function get_posts_comments($posts_id){
        $query=$this->db->query("select members.first_name,members.last_name,members.image,posts_comment.member_id,posts_comment.comment,posts_comment.timestamp from posts_comment LEFT JOIN members on posts_comment.member_id = members.id WHERE posts_comment.post_id = $posts_id ORDER by posts_comment.id desc");
        return $query->result_array();
    }
    public function count_posts_comments($posts_id,$start,$limit){
        $query=$this->db->query("select members.first_name,members.last_name,members.image,posts_comment.member_id,posts_comment.comment,posts_comment.timestamp from posts_comment LEFT JOIN members on posts_comment.member_id = members.id WHERE posts_comment.post_id = $posts_id Limit $start,$limit");
       return $query->num_rows();
    }
    public function posts_comment($user_id,$posts_id,$comment){

        $this->db->query("insert into posts_comment (member_id,post_id,comment) select $user_id,$posts_id,'$comment' from posts where exists (select id from posts where id = $posts_id)  LIMIT 1 ");
        return $this->db->insert_id();
    }
    public function get_one_post($post_id){
        $query= $this->db->query("SELECT posts.id,posts.status,posts.photos , posts.time ,members.first_name,members.last_name, members.image, COUNT(posts_like.id) as likes, GROUP_CONCAT(members.first_name SEPARATOR '|') AS liked_by from posts left JOIN posts_like ON posts.id=posts_like.post_id left join members on members.id=posts.member_id where posts.id=$post_id   Group by posts.id ");

        return $query->result_array();
    }
}