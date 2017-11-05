<?php

class Subcat_model extends MY_Model
{
	protected $_table = 'tb_subcat';
	protected $primary_key = 'sid';

	public function list_subcat()
    {                
        $this->db->order_by('sid','desc');
        return $this;
    }    

    function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    } 
    function get_by_id($id)
    {
        $this->db->where('sid', $id);
        return $this->db->get($this->_table);
    }
    function update($id, $data)
    {
        $this->db->where('sid', $id);
        $this->db->update($this->_table, $data);
    }   
    function delete($id)
    {
        $this->db->where('sid', $id);
        $this->db->delete($this->_table);            
    }
    function getcat(){
        $this->db->select('cid,cname');
        $this->db->from('tb_category');
        $this->db->order_by('cname', 'asc'); 
        $query=$this->db->get();
        return $query; 
    

    }
}

?>