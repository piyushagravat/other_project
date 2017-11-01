<?php
Class MediaModel extends CI_Model
{
	
	private $table = 'tbl_mediaroom';
			
	function __construct()
	{  	
		parent::__construct(); 
	}	
		
	function get_paged_list($limit = 8, $offset = 0)
	{
		$this->db->order_by('date','desc');
		return $this->db->get($this->table, $limit, $offset);
	}
		
	function count_all()
	{
		$this->db->order_by('date','desc');
		return $this->db->count_all($this->table);
	}
	
	function get_by_id($mid)
	{
		$this->db->where('mid', $mid);
		return $this->db->get($this->table);
	}
		
	function save($data)
	{
		$this->db->insert($this->table, $data);		
		return $this->db->insert_id();
	}	
			
	function update($mid, $data)
	{
		$this->db->where('mid', $mid);
		$this->db->update($this->table, $data);
	}	
		
	function delete($mid)
	{
		
		$this->db->where('mid', $mid);
		$this->db->delete($this->table);			
	}
	
	// For upload Images
	
	function get_images_list($id)
	{
		$this->db->order_by('id','asc');
		$this->db->where('mid', $id);
		return $this->db->get('tbl_media_photos');
	}
	
	function get_image_by_id($id)
	{
		$this->db->where('id', $id);
		return $this->db->get("tbl_media_photos");
	}	
	function save_image($data)
	{	
		$this->db->insert('tbl_media_photos', $data);
		return $this->db->insert_id();
	}			
	function update_image($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_media_photos', $data);
	}		
	function delete_image($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tbl_media_photos');			
	}
	
	function count_photos($mid)
	{
		$this->db->where('mid', $mid);
		return $this->db->count_all_results('tbl_media_photos');
	}	
	
	function get_image_by_mid($id)
	{
		$this->db->order_by('id','asc');
		$this->db->where('mid', $id);
		return $this->db->get('tbl_media_photos');
	}
	
	
}


?>