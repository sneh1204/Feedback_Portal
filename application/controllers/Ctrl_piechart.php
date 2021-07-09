<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ctrl_piechart extends CI_Controller {

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
		if($this->session->userdata('user_type') == "faculty"){
			$this->load->model('process');
			$result['Question'] = $this->process->fetch_question();
			for($i=1;$i<=count($result['Question']);$i++)
			{
				$A = "A".$i;
				$B = "B".$i;
				$C = "C".$i;
				$D = "D".$i;
				$result[$A] = $this->process->getChartValues($fid,'A',$i);
				$result[$B] = $this->process->getChartValues($fid,'B',$i);
				$result[$C] = $this->process->getChartValues($fid,'C',$i);
				$result[$D] = $this->process->getChartValues($fid,'D',$i);
			}
			$result['Question_PR'] = $this->process->fetch_question_pr();
			$result['year'] = $this->process->getsemyear();
			for($i=1;$i<=count($result['Question_PR']);$i++)
			{
				$A = "A1".$i;
				$B = "B1".$i;
				$C = "C1".$i;
				$D = "D1".$i;
				$result[$A] = $this->process->getChartValues3($fid,'A',$i);
				$result[$B] = $this->process->getChartValues3($fid,'B',$i);
				$result[$C] = $this->process->getChartValues3($fid,'C',$i);
				$result[$D] = $this->process->getChartValues3($fid,'D',$i);
			}
			$this->load->view('charts', $result);
		}else{
			$this->load->view('error', $fid);
		}
    }
}