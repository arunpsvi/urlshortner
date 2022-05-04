<?php
class Common_model extends CI_Model {

    //-- insert function
	public function insert($data,$table){
		$data=my_clear_fields($data);
        $this->db->insert($table,$data);  
        return $this->db->insert_id();
    }

    //-- edit function
    function edit_option($action, $id, $table){
		$data=my_clear_fields($action);
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    //-- update function
    function update($action, $id, $table,$condition){
		$data=my_clear_fields($action);
		$this->db->where($condition);
        $this->db->update($table,$data);
		//print $this->db->last_query();
        return;
    } 

    //-- delete function
    function delete($condition,$table){
        $this->db->delete($table,$condition);
        return;
    }

    //-- user role delete function
    function delete_user_role($id,$table){
        $this->db->delete($table, array('user_id' => $id));
        return;
    }

	


    //-- select function
    function select($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- select by id
    function select_option($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

    //-- check user role power
    function check_power($type){
		return;
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.user_id', $this->session->userdata('id'));
        $this->db->where('ur.action', $type);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    public function check_email($email){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }

	 public function check_username($username){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username); 
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return false;
        }
    }

	function get_options($optionType){
        $this->db->select('*');
        $this->db->from('options o');
		$this->db->where('o.option_type',$optionType);
		$this->db->where('o.status','A');
        $this->db->order_by('o.sort_order','ASC');
        $this->db->order_by('o.option_description','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

	function autocompleteString($length = 5) {
		$characters = '!@#$%^&*';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return "new-password";
		//return $randomString;
	}

    //-- get all power
    function get_all_power($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('power_id','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- get logged user info
    function get_user_info(){
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.id',$this->session->userdata('id'));
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();
        return $query;
    }

    //-- get single user info
    function get_single_user_info($id){
        $this->db->select('u.*');
        $this->db->from('users u');
        $this->db->where('u.user_id',$id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //-- get single user info
    function get_user_role($id){
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
        $this->db->where('ur.role_id',$id);

        $query = $this->db->get();
        $query = $query->result_array(); 
        return $query;
    }

	//-- get all roles
    function get_user_roles(){
        $this->db->select('ur.*');
        $this->db->from('user_role ur');
		 $this->db->order_by('ur.role_name','ASC');
        $query = $this->db->get();
        $query = $query->result_array(); 
        return $query;
    }

	
	


    //-- get all users with type 2
    function get_all_user(){
        $this->db->select('u.*,concat(u.first_name," ",u.last_name) as contact_name');
        $this->db->from('users u');
        $this->db->order_by('u.first_name','ASC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

	 
	

    //-- count active, inactive and total user
    function get_user_total(){
        $this->db->select('*');
        $this->db->select('count(*) as total');

        $this->db->from('users');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //-- image upload function with resize option
    function upload_image($max_size){
            
            //-- set upload path
		$config['upload_path']  = "./assets/images/";
		$config['allowed_types']= 'gif|jpg|png|jpeg';
		$config['max_size']     = '92000';
		$config['max_width']    = '92000';
		$config['max_height']   = '92000';

		$this->load->library('upload', $config);

		if ($this->upload->do_upload("photo")) {

			
			$data = $this->upload->data();

			//-- set upload path
			$source             = "./assets/images/".$data['file_name'] ;
			$destination_thumb  = "./assets/images/thumbnail/" ;
			$destination_medium = "./assets/images/medium/" ;
			$main_img = $data['file_name'];
			// Permission Configuration
			chmod($source, 0777) ;

			/* Resizing Processing */
			// Configuration Of Image Manipulation :: Static
			$this->load->library('image_lib') ;
			$img['image_library'] = 'GD2';
			$img['create_thumb']  = TRUE;
			$img['maintain_ratio']= TRUE;

			/// Limit Width Resize
			$limit_medium   = $max_size ;
			$limit_thumb    = 200 ;

			// Size Image Limit was using (LIMIT TOP)
			$limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

			// Percentase Resize
			if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
				$percent_medium = $limit_medium/$limit_use ;
				$percent_thumb  = $limit_thumb/$limit_use ;
			}

			//// Making THUMBNAIL ///////
			$img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
			$img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

			// Configuration Of Image Manipulation :: Dynamic
			$img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
			$img['quality']      = ' 100%' ;
			$img['source_image'] = $source ;
			$img['new_image']    = $destination_thumb ;

			$thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
			// Do Resizing
			$this->image_lib->initialize($img);
			$this->image_lib->resize();
			$this->image_lib->clear() ;

			////// Making MEDIUM /////////////
			$img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
			$img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

			// Configuration Of Image Manipulation :: Dynamic
			$img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
			$img['quality']      = '100%' ;
			$img['source_image'] = $source ;
			$img['new_image']    = $destination_medium ;

			$mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
			// Do Resizing
			$this->image_lib->initialize($img);
			$this->image_lib->resize();
			$this->image_lib->clear() ;

			//-- set upload path
			$images = 'assets/images/medium/'.$mid;
			$thumb  = 'assets/images/thumbnail/'.$thumb_nail;
			unlink($source) ;

			return array(
				'images' => $images,
				'thumb' => $thumb
			);
		}
		else {
			echo "Failed! to upload image" ;
		}            
    }
}