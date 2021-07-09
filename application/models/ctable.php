<?php
	class ctable extends CI_Model {

		function __construct() {
			parent::__construct();
		}
		function insertcomment($fid, $comment){
			$fid = $this->db->escape($fid);
			$comment = $this->db->escape($comment);
			$sql = "INSERT INTO `comment_table`(`fid`, `comment`) VALUES ($fid,$comment)";
			try {
				$this->db->query($sql);
			} catch (Exception $e) {
				echo "Error Occured While inserting";
			}
		}
		
		function updatecomment($fid, $comment){
			$fid = $this->db->escape($fid);
			$comment = $this->db->escape($comment);
			$sql = "UPDATE comment_table SET comment=$comment WHERE fid=$fid";
			try {
				$this->db->query($sql);
			} catch (Exception $e) {
				echo "Error Occured While inserting";
			}
		}
		
		function hasresponded($fid)
	{
		$query = $this->db->query("SELECT * FROM comment_table where fid='$fid'");
		if ($query->num_rows()>0) {
			return true;
		}
		else
		{
			return false;
		}

	}
	
	function getcomment($fid)
	{
		$query = $this->db->query("SELECT * FROM comment_table where fid='$fid'");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return false;
		}

	}
   
  }
