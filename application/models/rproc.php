<?php
	class rproc extends CI_Model {

		function __construct() {
			parent::__construct();
		}
    function checkfeedback(){
      $id = $this->session->user_id;
      $sql = "Select * from counter_th where sid='$id'";
      $res = $this->db->query($sql);
      $sql = "Select * from counter_pr where sid='$id'";
      $res2 = $this->db->query($sql);
			try {
				if($res->result()[0]->count1 != 0 && $res2->result()[0]->count1 != 0){
					return 1;
	      }
	      else return 0;
			} catch (Exception $e) {
				return 0;
			}
    }
		function checkip($id){
			$sql = "Select * from rtable where sid='$id'";
			$raw = $this->db->query($sql);
			return $raw->num_rows();
		}
		function getlist($id){
			$sql = "select tmp.sid,tmp.fid,list_faculty.NameOfFaculty from (select * from feedback_pr union select * from feedback_th) as tmp join list_faculty on list_faculty.fid=tmp.fid where sid='$id' group by sid,tmp.fid";
			$raw = $this->db->query($sql);
			return $raw->result();
		}
		function insertrw($fid,$sid,$text){
			$sql = "INSERT INTO `rtable`(`sid`, `fid`, `review`) VALUES ('$sid','$fid','$text')";
			try {
				$this->db->query($sql);
			} catch (Exception $e) {
				echo "Error Occured While inserting";
			}
		}
  }
//Query = select tmp.sid,tmp.fid,list_faculty.NameOfFaculty from (select * from feedback_pr union select * from feedback_th) as tmp join list_faculty on list_faculty.fid=tmp.fid group by sid,tmp.fid
