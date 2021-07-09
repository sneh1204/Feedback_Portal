<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class review extends CI_Controller{
  function __construct(){
    parent::__construct();
    if(!isset($_SESSION['user_id'])){
      redirect(base_url());
    }
  }
  public function index(){
	$data['filled'] = false;
	$data['thprfilled'] = true;
	if($this->session->userdata('user_type') == "student"){
	$this->load->model('rproc');
    if($this->rproc->checkfeedback() == 0)	$data['thprfilled'] = false; 
    else if($this->rproc->checkip($this->session->user_id) != 0)	$data['filled'] = true;
    $data['rows'] = $this->rproc->getlist($this->session->user_id);
    $this->load->view('review',$data);
	}else	$this->load->view('error', $fid);
  }
  public function savereview(){
    try {
      $this->load->model('rproc');
      $rows = $this->rproc->getlist($this->session->user_id);
      foreach ($rows as $data) {
        $this->rproc->insertrw($data->fid,$this->session->user_id,$_POST[$data->fid]);
      }
	  redirect('Review');
    } catch (Exception $e) {
      echo "Error occured";
    }
  }
}
