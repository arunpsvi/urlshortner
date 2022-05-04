<?php
class Url_model extends CI_Model {
	
	

	function getUrls($data = array(), $limit, $start){

        $this->db->select("s.* ");
        $this->db->from('shorturl s');

		$this->db->join('users u','u.user_id = s.added_by','left'); 
		
		if(!empty($data['user_id'])){
			$this->db->where('s.added_by',$data['user_id']);
		}	
		$this->db->order_by('s.date_added','DESC');
		$this->db->limit( $limit, $start );
        $query = $this->db->get();
        $query = $query->result_array(); 
		
        return $query;
    }

	function getTotalUrls($data = array()){

        $this->db->select("s.* ");
        $this->db->from('shorturl s');

		$this->db->join('users u','u.user_id = s.added_by','left'); 
		
		if(!empty($data['user_id'])){
			$this->db->where('s.added_by',$data['user_id']);
		}	
        $query = $this->db->get();
        return $query->row();
    }
	
	function getLongUrl($shortUrl){
		$this->db->select("s.* ");
        $this->db->from('shorturl s');
		$this->db->where('s.short_url',$shortUrl);	
        $query = $this->db->get();
        return $query->row();
	}
}