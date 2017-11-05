<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subcategory extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('cat_model');  
        $this->load->model('subcat_model');        
               
    }

    public function index()
    {
    	$this->subcat_list();
    }

    function subcat_list()
	{
		$data = array();

		$user_records = $this->subcat_model->list_subcat()->get_all();

		$data['subcat_records'] = $user_records;
		
	    $data['main'] = 'subcategory/subcat_list';
	   // $data['js_function'] = array('user_list');

		$this->load->view('base_template/base',$data);
	}
	
	function add_subcat()
	{
		
		if(!$this->ion_auth->in_group('admin')){

			echo "permission denied";
			exit;
		}

		

		$this->load->library('form_validation');

		$this->form_validation->set_rules('sname', $this->lang->line('sname'), 'sname');

		if($this->form_validation->run() == TRUE)
	    {
			
				$data = array(
				    			'cid'=>$this->input->post('cid'),
				    			'sname'=>$this->input->post('sname'),				    		
				    			'status'=>'Active'
				    			);

				$this->cat_model->insert($data);

				$this->session->set_flashdata('success', "category successfully add");
				redirect("subcategory/add_subcat");
		

	    }
	    else 
	    {
	    	$data = array();
	    	$data['list']=$this->subcat_model->getcat();
	    	
	    	$data['main'] = 'subcategory/add_subcat';

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

