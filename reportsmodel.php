<?php
Class ReportsModel extends CI_Model
{
	
	private $table = 'tbl_expenses';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
	
	function get_paged_list($start, $end)
	{
		$this->db->where('date >=', $start);
		$this->db->where('date <=', $end);
		$this->db->order_by('date','asc');
		return $this->db->get($this->table);
	}
	
	function get_user_daily_reports($date, $aid)
	{
		$this->db->where('date', $date);
		$this->db->where('aid', $aid);
		$this->db->order_by('aid','asc');
		return $this->db->get($this->table);
	}
	
	function get_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->table);
	}	
	
    function get_reportdata1($start,$end,$did,$pidfrom,$tret,$pay,$city)
	{
			if($pidfrom != ''){	$this->db->where('pid',$pidfrom);}
           // if($pidfrom != '' && $pidto != ''){	$this->db->where("pid BETWEEN '$pidfrom' AND '$pidto'");}
            if($start != '' && $end != ''){	$this->db->where("app_date BETWEEN '$start' AND '$end'");}
			if($did == 'all'){}else {$this->db->where('did', $did);}
			if($pay == 'all'){}else{$this->db->where('payment_status', $pay);}
			if($tret == 'all'){}else{$this->db->where('treatment', $tret);}
			if($city == 'all'){}else{$this->db->where('city', $city);}
            $this->db->order_by('pid','asc');
            return $this->db->get("tbl_appointment");                     
	}
       
        
	function get_report_data()
	{
           	$q = "SELECT * FROM `tbl_appointment` WHERE `did` = '$did' AND `treatment`= '$tret' AND `payment_status` = '$pay' AND `app_date` BETWEEN '$start' AND '$end' OR `pid` BETWEEN '$pidfrom' AND '$pidto' ORDER BY `pid`";
             //SELECT * FROM `tbl_appointment` WHERE `did` = '11' AND `pid` = '50' AND `treatment`= '7' AND `payment_status` = 'Pending' AND `app_date` BETWEEN '2015-07-1' AND '2015-12-31' ORDER BY `pid`
                //SELECT * FROM `tbl_appointment` WHERE `did` = '$did' AND `pid` = '$pid' AND `treatment`= '$tret' AND `payment_status` = '$pay' AND `app_date` BETWEEN '$start' AND '$end' ORDER BY `pid`
		//SELECT * FROM `tbl_appointment` WHERE `did` = '1' AND `treatment`= '11' AND `payment_status` = 'Paid' AND `app_date` BETWEEN '2015-07-1' AND '2015-12-31' OR `pid` BETWEEN '11' AND '50' ORDER BY `pid`  (from and to )
                $sql = $this->db->query($q);
		return $sql->result();
	}
	
	
}
?>