<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
		$this->load->model('common_model');
		$this->load->model('login_model');
		$this->load->library('form_validation');
    }

    public function index() {
        if($this->session->userdata('role')=='ADMIN'){
			$breadcrumbs[]='<li><a href="'.site_url('admin/user/all_user_list').'">Users List</a></li>';
		}else{
			 redirect(site_url('admin/dashboard'));
		}
		$data = array();
        $data['page_title'] = 'User Management';
		
		$roles = $this->common_model->get_user_roles();
		$userRoles=Array();
		foreach ($roles as $role){
			$userRoles[$role['role_id']]=$role['role_display'];
		}

		$data['user_roles']=$userRoles;
		$data['breadcrumbs']=$breadcrumbs;
		$data['action']=site_url('admin/user/add');
        $data['main_content'] = $this->load->view('admin/user/add', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //-- add new user by admin
    public function add() {   
		if($this->session->userdata('role')=='ADMIN'){
			$breadcrumbs[]='<li><a href="'.site_url('admin/user/all_user_list').'">Users List</a></li>';
		}else{
			 redirect(site_url('admin/dashboard'));
		}

        if ($this->input->post()) {
			
			$dataToInsert = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'mobile' => $this->input->post('mobile'),
                'username' => $this->input->post('username'),
                'role' => $this->input->post('user_role'),               
                'status' => '1',
                'date_created' => current_datetime()
            );

            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'password' => md5($this->input->post('password')),
                'mobile' => $this->input->post('mobile'),
                'username' => $this->input->post('username'),
                'role' => $this->input->post('user_role'),               
                'status' => '1',
                'date_created' => current_datetime()
            );

			$data['page_title'] = 'User Management';
			
			$roles = $this->common_model->get_user_roles();
			$userRoles=Array();
			foreach ($roles as $role){
				$userRoles[$role['role_id']]=$role['role_display'];
			}
			$data['user_roles']=$userRoles;
			$data['breadcrumbs']=$breadcrumbs;
			$data['action']=site_url('admin/user/add');

            $dataToInsert = $this->security->xss_clean($dataToInsert);
            
            //-- check duplicate email
            $email = $this->common_model->check_email($this->input->post('email'));

            if (empty($email)) {
				
				//-- check duplicate user name
				$userName = $this->common_model->check_username($this->input->post('username'));
				if (empty($userName)) {

					$user_id = $this->common_model->insert($dataToInsert, 'users');
					
					$this->session->set_flashdata('msg', 'User added Successfully');
					redirect(site_url('admin/user/all_user_list'));
				}else {
					$this->session->set_flashdata('error_msg', 'User name already exist.');
					$data['main_content'] = $this->load->view('admin/user/add', $data, TRUE);
					$this->load->view('admin/index', $data);
				} 
            } else {
                $this->session->set_flashdata('error_msg', 'Email already exist, try another email');
                $data['main_content'] = $this->load->view('admin/user/add', $data, TRUE);
				$this->load->view('admin/index', $data);
            }
        }
    }

    public function all_user_list(){	
		if(!in_array($this->session->userdata('role'), $this->config->item('adminAccess'))){
			redirect(site_url('admin/dashboard'));
		}
		$breadcrumbs=array();
		
		if($this->session->userdata('role')=='ADMIN'){
			$breadcrumbs[]='<li><a href="'.site_url('admin/user').'">New User</a></li>';
			$data['users'] = $this->common_model->get_all_user();
			
		}else{
			$data['users'] = $this->common_model->get_single_user_info($this->session->userdata('id'));
		}
		
	 	$data['page_title'] = 'All Registered Users';
        
        $roles = $this->common_model->get_user_roles();
		$userRoles=Array();
		foreach ($roles as $role){
			$userRoles[$role['role_id']]=$role['role_display'];
		}

		$data['user_roles']=$userRoles;
        //$data['country'] = $this->common_model->select('country');
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/user/users', $data, TRUE);

		$data['breadcrumbs']=$breadcrumbs;
        $this->load->view('admin/index', $data);
    }
	

    //-- update users info
    public function update($id) {
		if($this->session->userdata('role')=='ADMIN'){
			$breadcrumbs[]='<li><a href="'.site_url('admin/user/all_user_list').'">Users List</a></li>';
		}
        if ($_POST) {

            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'role' => $this->input->post('user_role'),              
                'status' => $this->input->post('status')
                /*'status' => '1',*/
            );
            $data = $this->security->xss_clean($data);
			
            //$data['action']=site_url('admin/user/update/'.$id);
			$condition=array(
				"user_id" =>$id
				);
            $this->common_model->update($data, $id, 'users',$condition);
            $this->session->set_flashdata('msg', 'Information Updated Successfully');
            redirect(site_url('admin/user/all_user_list'));

        }
		$roles = $this->common_model->get_user_roles();
		$userRoles=Array();
		foreach ($roles as $role){
			$userRoles[$role['role_id']]=$role['role_display'];
		}
		$userData = $this->common_model->get_single_user_info($id);
		$data = array(
			'user_id' => $userData->user_id,
			'first_name' => $userData->first_name,
			'last_name' => $userData->last_name,
			'email' => $userData->email,
			/*'password' => md5($userData->password')),*/
			'mobile' => $userData->mobile,

			'username' => $userData->username,

			'role' => $userData->role,
		
			'status' => $userData->status
        );
		$data['action']=site_url('admin/user/update/'.$id);
		$data['user_roles']=$userRoles;	
        //$data['user_role'] = $this->common_model->get_user_role($id);
        $data['main_content'] = $this->load->view('admin/user/add', $data, TRUE);
		$data['page_title'] = 'Update User - '.$userData->first_name." ".$userData->last_name;
		$data['breadcrumbs']=$breadcrumbs;
        $this->load->view('admin/index', $data);
        
    }

    
    //-- active user
    public function active($id) 
    {
		if($this->session->userdata('role')!='ADMIN'){
			$this->session->set_flashdata('error_msg', 'You are not authorised to access this page.');
			 redirect(site_url('admin/user/all_user_list'));
		}
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'User active Successfully');
        redirect(site_url('admin/user/all_user_list'));
    }

    //-- deactive user
    public function deactive($id) 
    {
		if($this->session->userdata('role')!='ADMIN'){
			$this->session->set_flashdata('error_msg', 'You are not authorised to access this page.');
			 redirect(site_url('admin/user/all_user_list'));
		}else{
			$data = array(
				'status' => 0
			);
			$data = $this->security->xss_clean($data);
			$this->common_model->update($data, $id,'user');
			$this->session->set_flashdata('msg', 'User deactive Successfully');
			redirect(site_url('admin/user/all_user_list'));
		}
    }

    //-- delete user
    public function delete($id)
    {
		redirect(site_url('admin/user/all_user_list'));
		exit;
		if($this->session->userdata('role')!='ADMIN'){
			$this->session->set_flashdata('error_msg', 'You are not authorised to access this page.');
			 redirect(site_url('admin/user/all_user_list'));
		}else{
			$this->common_model->delete($id,'user'); 
			$this->session->set_flashdata('msg', 'User deleted Successfully');
			redirect(site_url('admin/user/all_user_list'));
		}
    }
	public function changepassword($id){
		if($this->session->userdata('role')!='ADMIN'){
			if($_SESSION['id'] != $id){
				redirect(site_url('admin/user/changepassword/'.$_SESSION['id']));exit;
			}
			
		}
		
		$userData = $this->common_model->get_single_user_info($id);		
		$this->form_validation->set_rules('new_password', 'New Password','required|matches[retype_password]');	
		$this->form_validation->set_rules('retype_password', 'Retyped Password', 'required|trim');	
		
		if ($this->form_validation->run() == false) {
			$data = array(
					'first_name' => $userData->first_name,
					'last_name' => $userData->last_name
				);
			$data['page_title'] = "Reset Password";
			$data['main_content'] = $this->load->view('admin/user/changepassword', $data, TRUE);
			$data['breadcrumbs']=$breadcrumbs;
			$this->load->view('admin/index', $data);
		}else{	
			if(!empty($this->input->post('round_vat'))){
				$roundVat='Y';
			}
			$data = array(				
				'password' => md5($this->input->post('new_password'))
				//'password_reset_date' => current_datetime()
			);
			$data = $this->security->xss_clean($data);	
			//echo "<pre>";
			//print_r($data);exit;
			$condition=array(
				"user_id" =>$id
				);
			$this->common_model->update($data,$id,'users',$condition);			
			//$query = $this->common_model->saveNewPass(sha1($this->input->post('new_password')));
			
					
			$this->session->set_flashdata('msg', 'Information Updated Successfully');
			redirect(site_url('admin/user/changepassword/'.$id),'refresh');		
		}		  
	}
}