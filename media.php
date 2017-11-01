<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media extends CI_Controller {

	private $limit = 20;
	function __construct()
	{
		parent::__construct();	
	    if($this->session->userdata('logged_in'))
		   {
			 $session_data = $this->session->userdata('logged_in');
			 $data['email'] = $session_data['email'];
			 $data['session_data'] = $session_data;
		   }
		else
		   {
				 redirect(base_url().'login', 'refresh');
		   }		
		$this->load->model("mediaModel");	
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	public function index()
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;

		$uri_segment = 4;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->mediaModel->get_paged_list($this->limit, $offset)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Media';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."admin/media/index/";
		$config['total_rows'] = $this->mediaModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('admin/header',$data);
		$this->load->view('admin/media/all',$data);
		$this->load->view('admin/footer');
		
	}
	
	
	public function add()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Media';
		$data['error'] = "";
		$data['action'] = "Add Record";	
		$this->load->view('admin/header',$data);
		$this->load->view('admin/media/add',$data);
		$this->load->view('admin/footer');
	}
	
	public function addrecord()
	{
		$this->form_validation->set_rules('title', 'Media title', 'required');
		$this->form_validation->set_rules('date', 'Coverage date', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->add();
		}	
		else
		{				
			$this->load->library('upload');				
			$file1 = "";
            $file2 = "";
			
			if (!empty($_FILES['userfile1']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 6);
				$config1['upload_path'] = "./images/media/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '100000';				
				$config1['file_name'] = $code1."_big";		
				$this->upload->initialize($config1);		
				if (!$this->upload->do_upload('userfile1'))
				{	
					$error = $this->upload->display_errors();
					print_r($error);
					$this->add($error);
				}
				else
				{
					$val1 = array('upload_data' => $this->upload->data());				
					$file1 = $val1["upload_data"]["orig_name"];
				}
			}
			
            if (!empty($_FILES['userfile2']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 6);
				$config1['upload_path'] = "./images/media/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '100000';				
				$config1['file_name'] = $code1."_small";		
				$this->upload->initialize($config1);		
				if (!$this->upload->do_upload('userfile2'))
				{	
					$error = $this->upload->display_errors();
					
					$this->add($error);
				}
				else
				{
					$val2 = array('upload_data' => $this->upload->data());				
					$file2 = $val2["upload_data"]["orig_name"];
				}
			}
                       
			$data = array(
					'newspaper_title' => $this->input->post('title'), 
					'details' => $this->input->post('details'), 
					'date' => $this->input->post('date'), 
					'big_img' => $file1,
					'small_img' => $file2); 
						
			//print_r($data);exit;
			$id = $this->mediaModel->save($data);	
			$this->session->set_flashdata("message", "Record Added Successfully..."); 
			
			redirect('admin/media/','refresh');	
		}
	}
	
	public function delete($id)
	{
		$this->mediaModel->delete($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('admin/media/','refresh');
	}
	
	public function edit($id)
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		
		$data['error'] = "";
		$data["editdata"] = $this->mediaModel->get_by_id($id)->row();
									
		$data['title'] = 'Media';
		$data['action'] = "Edit Record";

		$this->load->view('admin/header',$data);
		$this->load->view('admin/media/edit',$data);
		$this->load->view('admin/footer');
	}
        
        
	public function updaterecord()
	{
		$this->form_validation->set_rules('title', 'Media title', 'required');
		$this->form_validation->set_rules('date', 'Coverage date', 'required');
                
		if ($this->form_validation->run() == FALSE)
		{
				$this->edit($this->input->post('aid'));
		}	
		else
		{	                       
			$this->load->library('upload');	
			$file1 = "";
            $file2 = "";
			
			if (!empty($_FILES['userfile1']['name']))
			{	          
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 6);
								
				$config1['upload_path'] = "./images/media/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '10000';				
				$config1['file_name'] = $code1."_big";		
				
				$this->upload->initialize($config1);	
					
				if (!$this->upload->do_upload('userfile1'))
				{	
					$error = $this->upload->display_errors();
					
					$this->add($error);
				}
				else
				{
					$val1 = array('upload_data' => $this->upload->data());				
					$file1 = $val1["upload_data"]["orig_name"];
										
				}
			}
			else
			{
				$file1 = $this->input->post('userfile1old');
			}
			
                        if (!empty($_FILES['userfile2']['name']))
			{	
				$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
				$curenttimestamp = time();
				$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 6);
								
				$config1['upload_path'] = "./images/media/";
				$config1['allowed_types'] = '*';
				$config1['max_size']	= '10000';				
				$config1['file_name'] = $code1."_small";		
				
				$this->upload->initialize($config1);	
					
				if (!$this->upload->do_upload('userfile2'))
				{	
					$error = $this->upload->display_errors();
					
					$this->add($error);
				}
				else
				{
					$val2 = array('upload_data' => $this->upload->data());				
					$file2 = $val2["upload_data"]["orig_name"];										
				}
			}
			else
			{
				$file2 = $this->input->post('userfile2old');
			}                   
                                          
			$data = array(
					'newspaper_title' => $this->input->post('title'), 
					'details' => $this->input->post('details'), 
					'date' => $this->input->post('date'), 
					'big_img' => $file1,
					'small_img' => $file2); 	
			
			$id = $this->input->post('mid');			
			$this->mediaModel->update($id,$data);	
			$this->session->set_flashdata("message", "Record Updated Successfully..."); 									
			redirect('admin/media/','refresh');	
		}				
	}
	
	// Add/delete/update Images
	
	public function viewimages($mid,$editimg="",$id="")
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data["media"] = $this->mediaModel->get_by_id($mid)->row();
		$viewdata = $this->mediaModel->get_images_list($mid)->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Gallery Images';
		$data['action'] = "All Record";
		$data['message'] = $this->session->flashdata('message');		
		$data["editimg"]="editimg"; 
		$data["id"]=$id;
		$this->load->view('admin/header',$data);
		$this->load->view('admin/media/allimages',$data);
		$this->load->view('admin/footer');
	}
	
	public function add_images($mid)
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$data['title'] = 'Gallery';
		$data['action'] = "Add Record";
		$data["media"] = $this->mediaModel->get_by_id($mid)->row();
				
	 	$this->load->view('admin/header',$data);
		$this->load->view('admin/media/addimages',$data);
		$this->load->view('admin/footer');
	}
	
	public function addrecord_images()
	{
		
		$this->load->library('upload');
	
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		for($i=0; $i<$cpt; $i++)
		{           
			$_FILES['userfile']['name']= $files['userfile']['name'][$i];
			$_FILES['userfile']['type']= $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']= $files['userfile']['size'][$i];    
	
			$this->upload->initialize($this->set_upload_options());
			if($this->upload->do_upload()) { 
				$val = array('upload_data' => $this->upload->data());				
				$file = $val["upload_data"]["orig_name"];
							
				$data = array('mid' => $this->input->post('mid'), 'img' => $file);   	
			
				$id = $this->mediaModel->save_image($data);				 					
				
			}
			
		}	
		
		$mid = $this->input->post('mid');
		$this->session->set_flashdata("message", "Images Uploaded Successfully...");
		redirect('admin/media/viewimages/'.$mid,'refresh');		
	}	

	private function set_upload_options()
	{   
		//upload an image options
		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';				
		$curenttimestamp = time();
		$code1 = $curenttimestamp."-".substr(str_shuffle($alpha_numeric), 0, 8);
						
		$config = array();
		$config['upload_path'] = './images/media/';
		$config['allowed_types'] = '*';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;
		$config['file_name'] = $code1;	
	
		return $config;
	}
	
	public function delete_image($id,$mid)
	{
		$this->mediaModel->delete_image($id);		
		$this->session->set_flashdata("message", "Record Deleted Successfully..."); 			
		redirect('admin/media/viewimages/'.$mid,'refresh');
	}
	
	public function update_image()
	{
		$this->form_validation->set_rules('txttitle', 'Image Title', 'trim|required');	
							
		if ($this->form_validation->run() == FALSE)
		{
			$this->edit($this->input->post('id'));
		}	
		else
		{	
			$data = array('img_title' => $this->input->post('txttitle')); 
			
			$id = $this->input->post('id');		
			$mid = $this->input->post('mid');			
			$this->mediaModel->update_image($id,$data);	
			$this->session->set_flashdata("message", "Image Updated Successfully..."); 									
			redirect('admin/media/viewimages/'.$mid,'refresh');	
		}				
	}
}