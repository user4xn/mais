<?php 

/**
 * 
 */
class AdminModel extends CI_Model
{
	function auth_login($uname,$pass){
		$where = array(
			'nama_user' => $uname,
			'password_user' => md5($pass),
		);
		return $this->db->get_where('user',$where)->result();
	}
	
	function loadRecent(){
		return $this->db->query("SELECT id,nama,TO_BASE64(foto) as foto_64,no_telp,ket,created_at FROM mardizu_guest ORDER BY created_at DESC LIMIT 1")->result_array();
	}

	function searchWhereId($a){
		return $this->db->query("SELECT nama,TO_BASE64(foto) as foto_64,no_telp,ket,created_at FROM mardizu_guest WHERE id ='".$a."' ORDER BY created_at DESC LIMIT 1")->row_array();
	}	

	function countTotal(){
		return $this->db->get('mardizu_guest')->num_rows();
	}

	function getData($offset,$limit,$search="",$search_from="",$search_to="") {

	    $this->db->select('id,nama,TO_BASE64(foto) as foto_64,no_telp,ket,created_at');
	    $this->db->order_by('created_at', 'DESC');
	    $this->db->from('mardizu_guest');

	    if($search != ''){
	      $this->db->like('nama', $search);
	      $this->db->or_like('created_at', $search);
	    }

	    if($search_from != '' && $search_to != '') {
	    	$this->db->where('created_at >=', $search_from);
			$this->db->where('created_at <=', $search_to);
	    }

		$this->db->limit($limit,$offset);
		return $this->db->get()->result_array();
	}

	    // Select total records
	function countAll($search="",$search_from="",$search_to="") {

	      $this->db->select('count(*) as allcount');
	      $this->db->from('mardizu_guest');
	      if($search != ''){
		      $this->db->like('nama', $search);
		      $this->db->or_like('created_at', $search);
		  }

		  if($search_from != '' && $search_to != '') {
	    	$this->db->where('created_at >=', $search_from);
			$this->db->where('created_at <=', $search_to);
	      }
	    
	      $query = $this->db->get();
	      $result = $query->result_array();
	 
	      return $result[0]['allcount'];
    }
}

 ?>