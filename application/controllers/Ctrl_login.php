<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ctrl_login extends CI_Controller {
    function __construct() {
			parent::__construct();
            if(isset($_SESSION['user_id'])){
                if($_SESSION['user_type']=='student')
                    redirect('Ctrl_feedback');
                else if($_SESSION['user_type']=='faculty')
                    redirect('Ctrl_faculty_chart');
                else if($_SESSION['user_type']=='admin')
                    redirect('Ctrl_admin');
            }
		}
    public function index()
	{
        $this->load_page();
	}

     public function load_page()
    {
         $data1['error']="";
        $this->load->view('new_login',$data1);
    }

    public function check()
    {
        $post = $this->input->post();
        $this->load->model('process');
        $data=$this->process->chk_login($post);
        $this->load->helper('url');
        $logintype=$post['per'];

        if($data==null)
        {
//           echo '<script>window.alert("Invalid Username/Password");window.location.href="'.base_url().'";</script>';
            $data1['error']="Wrong UserId/Password!";
            $this->load->view('new_login',$data1);
        }
        else{
            if ($logintype=="student") {
                $arr = array('user_id'=> $data['0']->Sid ,'fname'=> $data['0']->Fname,'lname'=> $data['0']->Lname,'user_type'=>'student', 'sem'=>$data['0']->Sem ,'divi'=>$data['0']->div ,'batch'=>$data['0']->batch);
                $this->session->set_userdata($arr);
                redirect('Ctrl_feedback');
                   }
            else if ($logintype=="faculty") {
                $arr = array('user_id'=> $data['0']->Fid ,'fname'=> $data['0']->F_name,'lname'=> " ",'user_type'=>'faculty');
                $this->session->set_userdata($arr);
                redirect('Ctrl_faculty_chart');
            }
            else if($logintype=='admin'){
                $arr = array('user_id'=> $data['0']->UserId ,'fname'=> $data['0']->AName,'lname'=> " ",'user_type'=>'admin');
                $this->session->set_userdata($arr);
                redirect('Ctrl_admin');
            }

       }
    }
}

?>
