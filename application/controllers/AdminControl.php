<?php 
defined("BASEPATH")or exit("No Direct Access Allowed");

/**
 *  ADMIN CLASS
 */

class AdminControl extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('AdminModel');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('email');
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
	    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
	    $this->output->set_header('Pragma: no-cache');
	    $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
	}



	function index(){
		if ($this->session->userdata('status') == 'logged_in') {
			$this->template->load('mainpage/index.php','mainpage/administrator.php');
		}else{
			redirect('AdminControl/auth');
		}
	}

	function load_recent(){
		$data['result'] = $this->AdminModel->loadRecent();
		$data['total'] = $this->AdminModel->countTotal();
		$data['t_visitor'] = $this->db->query("SELECT * FROM mardizu_guest WHERE DATE(NOW()) =  DATE(created_at)")->num_rows();
		echo json_encode($data);
	}

	function auth(){
		if ($this->session->userdata('status') != 'logged_in') {
			$this->template->load('mainpage/index.php','mainpage/auth.php');
		}else{
			redirect('AdminControl');
		}
	}

	function showPict(){
		$id = $this->uri->segment(3);
		$result = $this->AdminModel->searchWhereId($id);

		echo "<img src='data:image/jpeg;base64, ".$result['foto_64']."' style='width:430px;display:block;margin:auto;'>";
	}

	function auth_verify(){
		$uname = $this->input->post('username');
		$pass = $this->input->post('password');

		$cek = $this->AdminModel->auth_login($uname,$pass);

		if ($cek) {
			foreach ($cek as $data) {
				$id = $data->id_user;
				$nama = $data->nama_user;
			}
			$sess_data = array(
				'status' => 'logged_in',
				'nama' => $nama,
				'id' => $id
			);
			$this->session->set_userdata($sess_data);
			redirect('AdminControl');
		}else{
			$this->session->set_flashdata('status', 'fail');
			redirect('AdminControl/auth');
		}
	}

	function datacenter(){
		$this->template->load('mainpage/index.php','mainpage/datacenter.php');
	}

	public function load_all($rowno=0){
    
            // Get Search
            $search_text                = "";
            $search_from                = "";
            $search_to                  = "";
        
            if($this->input->get('search_key') != NULL ){
              $search_text  = $this->input->get('search_key');
            }

            if($this->input->get('search_from') != NULL && $this->input->get('search_to') != NULL){
              $search_from  = $this->input->get('search_from');
              $search_to  = $this->input->get('search_to');
            }
            
            // Row per page
            $rowperpage = 10;
        
            // Row position
            if($rowno != 0){
              $rowno = ($rowno-1) * $rowperpage;
            }
        
            // Customize Pagging
            $cfg['first_link']       = 'First';
            $cfg['last_link']        = 'Last';
            $cfg['next_link']        = 'Next';
            $cfg['prev_link']        = 'Prev';
            $cfg['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
            $cfg['full_tag_close']   = '</ul></nav></div>';
            $cfg['num_tag_open']     = '<li class="page-item"><span class="page-link">';
            $cfg['num_tag_close']    = '</span></li>';
            $cfg['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
            $cfg['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
            $cfg['next_tag_open']    = '<li class="page-item"><span class="page-link">';
            $cfg['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
            $cfg['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
            $cfg['prev_tagl_close']  = '</span>Next</li>';
            $cfg['first_tag_open']   = '<li class="page-item"><span class="page-link">';
            $cfg['first_tagl_close'] = '</span></li>';
            $cfg['last_tag_open']    = '<li class="page-item"><span class="page-link">';
            $cfg['last_tagl_close']  = '</span></li>';
         
            // All records count
            $allcount = $this->AdminModel->countAll($search_text,$search_from,$search_to);
        
            // Get records
            $users_record = $this->AdminModel->GetData($rowno,$rowperpage,$search_text,$search_from,$search_to);
         
            // Pagination cfguration
            $cfg['base_url'] = 'AdminControl/load_all';
            $cfg['use_page_numbers'] = TRUE;
            $cfg['total_rows'] = $allcount;
            $cfg['per_page'] = $rowperpage;
        
            // Initialize
            $this->pagination->initialize($cfg);
        
            // Initialize $data Array
            $data['pagination'] = $this->pagination->create_links();
            $data['result'] = $users_record;
            $data['row'] = $rowno;
        
            echo json_encode($data);
    }

     

	function logout(){
		$this->session->sess_destroy();
        $this->session->set_flashdata('log_notify', 'logout');
        redirect(site_url('AdminControl'));
	}
}

?>