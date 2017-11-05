<?php

class Cat_model extends MY_Model
{
	protected $_table = 'tb_category';
	protected $primary_key = 'cid';

	public function list_cat()
    {                
        $this->db->order_by('cid','desc');
        return $this;
    }    

    function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    } 
    function get_by_id($id)
    {
        $this->db->where('cid', $id);
        return $this->db->get($this->_table);
    }
    function update($id, $data)
    {
        $this->db->where('cid', $id);
        $this->db->update($this->_table, $data);
    }   
    function delete($id)
    {
        $this->db->where('cid', $id);
        $this->db->delete($this->_table);            
    }
}

?>