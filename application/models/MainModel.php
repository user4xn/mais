<?php 

/**
 * MODEL MAIN
 */
class MainModel extends CI_Model
{
	function input_guest($data){
		$this->db->insert('mardizu_guest', $data);
	}
	
}		

?>