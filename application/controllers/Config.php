<?php
/**
 * 
 */
class Config extends CI_Controller
{
	
	function reset()
	{
		$this->load->dbforge();
		$table = array('tbl_pemilihan');
		foreach ($table as $key => $value) {
			$this->dbforge->drop_database($value);
			// echo $value;
		}
	}
}
?>