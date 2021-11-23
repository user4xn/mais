<?php 
defined("BASEPATH")or exit("NO DIRECT ACCESS ALLOWED");

	class MainControl extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('MainModel');
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
			$this->template->load('mainpage/index.php','mainpage/guest.php');
		}
		
		function input_guest(){
			$nama 		= 	$this->input->post('nama');
			$no_telp 	= 	$this->input->post('telp');
			$foto 		= 	file_get_contents($this->do_upload_foto());
			$ket 		= 	$this->input->post('ket');


			$data 	=	array(
				'id'			=>	'',
				'nama'			=>	$nama,
				'no_telp'		=>	$no_telp,
				'ket'			=>	$ket,
				'foto'			=>	$foto,
				'created_at'	=>	null,
				'updated_at'	=>	null,
			);

			$this->MainModel->input_guest($data);
			$this->session->set_flashdata('status', 'ok');
			$this->deleteFiles();
			redirect('MainControl');
		}

		public function do_upload_foto(){
            $config['upload_path']          = './assets/uploads/';
            $config['allowed_types']        = 'jpg|png|jpeg';
            $config['overwrite']            = TRUE;
            $config['encrypt_name']         = TRUE;
            $this->load->library('upload');
            $this->upload->initialize($config);
            if ($this->upload->do_upload('foto')){
                if($this->upload->data('file_size') > 800){
                    return $this->compressimg($this->upload->data(),$config['upload_path']);
                } else {
                    return $this->upload->data('full_path');
                }
            }else{
                return 'error file doesnt send';
            }
		}
		function deleteFiles($path='./assets/uploads/'){
		    $files = glob($path.'*'); // get all file names
		    foreach($files as $file){ // iterate files
		      if(is_file($file))
		        unlink($file); // delete file
		        echo $file.'file deleted';
		    }   
		}
		
		function compressimg($gbr,$path){
            $wd =$gbr['image_width']*0.4; //0.4 mean compress to 40% image_size
            $hh =$gbr['image_height']*0.4; //modify yours
            //Compress Image
            $config['image_library']    = 'gd2';
            $config['source_image']     = $path.$gbr['file_name'];
            $config['create_thumb']     = FALSE;
            $config['maintain_ratio']   = FALSE;
            $config['quality']          = '50%';
            $config['width']            = round($wd);
            $config['height']           = round($hh);
            $config['new_image']        = $path.$gbr['file_name'];

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            
            return $gbr['full_path'];

            // Put This On Uploader , by user4xn
            // return $this->compressimg($this->upload->data(),$config['upload_path']);
        }
	}

?>