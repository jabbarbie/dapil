<?php
/**
 * 
 */
class MLogin extends CI_Model
{
	function cek_login($kondisi){
		return $this->db->get_where('tbl_user',$kondisi);
	}
}
?>