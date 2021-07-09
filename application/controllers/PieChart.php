<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PieChart extends CI_Controller {

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
			$mix = $this->input->get('value');
			$data['mix'] = $mix;
			$fac = substr($mix,0,4);
			$sem = substr($mix,4,1);
			$div = substr($mix,5);
			$list = [1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D'];
			$opt = [];
			for($i = 1; $i <= 4; $i++){
				$opt[$list[$i]] = $this->process->getChartValues2($fac,$sem,$div,$list[$i]);
			}
			$data['A'] = $opt['A'];
			$data['B'] = $opt['B'];
			$data['C'] = $opt['C'];
			$data['D'] = $opt['D'];
			$this->load->view('piechart', $data);
		}else{
			$this->load->view('error', $fid);
		}
       
    }
}