<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

	private $limit = 100;
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
		$this->load->model("reportsModel");
                $this->load->model("appointmentsModel");
                
		$this->load->helper(array('form', 'url'));
    	$this->load->library('form_validation');
		
	}
	
	public function index()
	{ 	   
		echo "404 Not Found.";
	}
	
	public function expensereport()
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;				
		$data['title'] = 'Expense Report';
		
		$this->load->view('header',$data);
		$this->load->view('reports/expensereport',$data);
		$this->load->view('footer');
	}
        public function allreport()
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;				
		$data['title'] = 'Expense Report';
		$data["doctors"] = $this->appointmentsModel->get_doctors_list()->result();
		$data["patients"] = $this->appointmentsModel->get_patients_list()->result();
		$data["treatments"] = $this->appointmentsModel->get_treatments_list()->result();
      
		$this->load->view('header',$data);
		$this->load->view('reports/allreports',$data);
		$this->load->view('footer');
	}
        
     public function download_allreports()
	{			
		
                    $session_data = $this->session->userdata('logged_in');		
                    $data['email'] = $session_data['email'];
                    $data['session_data'] = $session_data;				
                    $viewdata = $this->reportsModel->get_reportdata1($_POST['txtstartdate'], $_POST['txtenddate'],$_POST['seldoctor'],$_POST['selpatientfrom'],$_POST['txttreatment'],$_POST['selstatus'],$_POST['selcity'])->result();
                    $data["viewdata"] = $viewdata;
				
                    $data['title'] = 'All Report';
                    $this->load->view('reports/download_allreports',$data);
                
               
	}
        public function download_excel()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
				
		// load data		
		$viewdata = $this->reportsModel->get_reportdata1($_POST['txtstartdate'], $_POST['txtenddate'],$_POST['seldoctor'],$_POST['selpatientfrom'],$_POST['txttreatment'],$_POST['selstatus'],$_POST['selcity'])->result();
		$data["txtstartdate"] = $_POST['txtstartdate'];
		$data["txtenddate"] = $_POST['txtenddate']; 
		$data["seldoctor"] = $_POST['seldoctor'];
		$data["selpatientfrom"] = $_POST['selpatientfrom'];
		$data["selpatientto"] = $_POST['selpatientto'];
		$data["txttreatment"] = $_POST['txttreatment'];
		$data["selstatus"] = $_POST['selstatus'];
		$data["selcity"] = $_POST['selcity'];
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Download All Report';
		$data['action'] = "All Record";
				
		//$this->load->view('header',$data);
		$this->load->view('reports/download_excel',$data);
	}
        
        public function allpatient()
	{			
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;				
		$data['title'] = 'Expense Report';
		$data["patients"] = $this->appointmentsModel->get_patients_list()->result();
		$this->load->view('header',$data);
		$this->load->view('reports/allpatient',$data);
		$this->load->view('footer');
	}
        
        
	public function download_expensereport()
	{			
		if($_POST['txtstartdate'] != '' && $_POST['txtenddate'] != '') { 
		
		$session_data = $this->session->userdata('logged_in');		
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;				
		$viewdata = $this->reportsModel->get_paged_list($_POST['txtstartdate'], $_POST['txtenddate'])->result();
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Expense Report';
		$this->load->view('reports/download_expensereport',$data);
		
		} else { 
			echo "Page Not Found..!";
		}
		
	}
	
	public function test()
	{ 	   
		$session_data = $this->session->userdata('logged_in');
		$data['email'] = $session_data['email'];
		$data['session_data'] = $session_data;
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		// load data		
		$viewdata = $this->appointmentsModel->get_paged_list($this->limit, $offset)->result();
		
		$data["viewdata"] = $viewdata;
		$data['title'] = 'Appointments';
		$data['action'] = "All Record";
				
		// generate pagination		
		$this->load->library('pagination');		
		$config['base_url'] = base_url()."appointments/index/";
		$config['total_rows'] = $this->appointmentsModel->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['message'] = $this->session->flashdata('message');		
				
		$this->load->view('header',$data);
		$this->load->view('reports/test',$data);
		$this->load->view('footer');
	}
	
	
}