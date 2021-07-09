<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ctrl_feedback_pr extends CI_Controller {

    function __construct() {
			parent::__construct();
            if(!isset($_SESSION['user_id'])){
                redirect(base_url());
            }
		}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $sid=$this->session->userdata('user_id');
        $this->load_page($sid);
	}
    
    public function load_page($sid)
    {
        if($this->session->userdata('user_type') == "student"){
        $this->load->model('process');
        $check = $this->process->check_q_pr($sid);
        if($check==null)
        $data['counter']= 0;
        else
        $data['counter']= $check;
        $data['Question'] = $this->process->fetch_question_pr();
        $data['loadmat'] = $this->process->fetch_loadmat_pr();
        $this->load->view('feedback_form_pr', $data);
		}else{
			$this->load->view('error', $sid);
		}
    }
    
    public function insert_fb()
    {
        $this->load->model('process');
        $post=$this->input->post();
        $this->process->insert_loadmat_pr($post);
         redirect('ctrl_feedback_pr');
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('ctrl_login');
    }
}
    ?>