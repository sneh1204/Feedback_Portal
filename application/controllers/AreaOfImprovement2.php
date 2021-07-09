<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AreaOfImprovement2 extends CI_Controller {

    function __construct() {
			parent::__construct();
            if(!isset($_SESSION['user_id'])){
                redirect(base_url());
            }
		}
    
    public function index()
	{
        $fid=$this->session->userdata('user_id');
        $this->load_page($fid);
	}
    
    public function load_page($fid)
    {
		if($this->session->userdata('user_type') == "admin"){
			$this->load->model('process');
			$data['facl_list'] = $this->process->getfaculty();
			$this->load->view('areaimp2', $data);
		}else{
			$this->load->view('error', $fid);
		}
    }
}