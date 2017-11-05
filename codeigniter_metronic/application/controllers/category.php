<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('cat_model');        
               
    }

    public function index()
    {
    	$this->cat_list();
    }

    function cat_list()
	{
		$data = array();

		$user_records = $this->cat_model->list_cat()->get_all();

		$data['cat_records'] = $user_records;
		
	    $data['main'] = 'category/cat_list';
	   // $data['js_function'] = array('user_list');

		$this->load->view('base_template/base',$data);
	}
	
	function add_cat()
	{
		
		if(!$this->ion_auth->in_group('admin')){

			echo "permission denied";
			exit;
		}

		

		$this->load->library('form_validation');

		$this->form_validation->set_rules('catname', $this->lang->line('catname'), 'catname');

		if($this->form_validation->run() == TRUE)
	    {
			
				$data = array(
				    			'cname'=>$this->input->post('catname'),				    		
				    			'status'=>'Active'
				    			);

				$this->cat_model->insert($data);

				$this->session->set_flashdata('success', "category successfully add");
				redirect("category/add_cat");
		

	    }
	    else 
	    {
	    	$data = array();

	    	$data['main'] = 'category/add_cat';

			$this->load->view('base_template/base',$data);
	    }
	}

	function edit_cat()
	{
		

		if(!$this->ion_auth->in_group('admin')){

			echo "permission denied";
			exit;
		}

			$this->load->library('form_validation');
			$this->form_validation->set_rules('catname', $this->lang->line('catname'), 'catname');
			if($this->form_validation->run() == TRUE)
	    {
	    	
	 		 $data = array('cname'=>$this->input->post('catname'),
	 		 				'status'=>$this->input->post('status')				    		
				    		);
			$id = $this->input->post('cid');
			
			$this->cat_model->update($id,$data);
			
			$this->session->set_flashdata('success', "User successfully updated");				
			redirect('category/cat_list');
	    }
	    else 
	    {
	    	$user_id = $this->uri->segment(3);
	    	
	    	$data = array();

	    	$cat_info_records = $this->cat_model->get_by_id($user_id)->row();
	    	
	    	$data['cat_info_records'] = $cat_info_records;

	    	$data['main'] = 'category/edit_cat';

			$this->load->view('base_template/base',$data);
	    }
	}
	public function delete($id)
	{
		$this->cat_model->delete($id);		
		$this->session->set_flashdata('success', "Record Deleted Successfully..."); 			
		redirect('category/cat_list','refresh');
	}	

}

