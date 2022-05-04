<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Url extends CI_Controller {

	public function __construct(){
		parent::__construct();
		check_login_user();
		$this->load->model('common_model');
		$this->load->model('url_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('pagination');		
    }

    public function index() {
        $breadcrumbs=array();
		if(in_array($this->session->userdata('role'), $this->config->item('managerAccess'))){
			$breadcrumbs[]='<li><a href="'.site_url('admin/url/add').'">Add new Url</a></li>';
		}
		$config['base_url'] = site_url().'/admin/url/';
		$config['uri_segment'] = 3;
		$config['per_page'] = 50;
		$config['total_rows'] = $this->url_model->getTotalUrls($this->input->get());
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = true;

		$this->pagination->initialize($config);
		//$page = $this->uri->segment(3,0);
		$page= $this->input->get('per_page');
		$data['pagination'] = $this->pagination->create_links();
		/* Pagination */

		$data['urls'] = $this->url_model->getUrls($this->input->get(), $config['per_page'], $page);		
	 	$data['page_title'] = 'Url List';
        
        
		$userList=$this->common_model->get_all_user();
		$userArray=svi_buildArray($userList,'user_id','contact_name','Select');
		$data['userArray']=$userArray;
		
		$data['action']=site_url('admin/url');
		$data['formData']=$this->input->get();
		
		$data['autocomplete']=$this->common_model->autocompleteString();
        $data['main_content'] = $this->load->view('admin/url/list', $data, TRUE);
		$data['breadcrumbs']=$breadcrumbs;
		$this->session->set_userdata('referred_from', current_url()."?".$_SERVER['QUERY_STRING']);
        $this->load->view('admin/index', $data);
    }

	public function add() {	
		
		$this->form_validation->set_rules('name', 'Name', 'required|trim');	
		$this->form_validation->set_rules('long_url', 'Long Url', 'required|trim');	
		if ($this->form_validation->run() == false) {
			$data['userArray']=$userArray;
			$data['breadcrumbs']=$breadcrumbs;
			$data['autocomplete']=$this->common_model->autocompleteString();	
			
			$data['main_content'] = $this->load->view('admin/url/add', $data, TRUE);
			$data['page_title'] = "Add Url";		
			$this->load->view('admin/index', $data);
		}else{
			
			$data = array(
				'long_url' => $this->input->post('long_url'),
				'name' => $this->input->post('name'),
				'short_url' => md5($this->input->post('long_url')),		
				'added_by' => $this->session->userdata('id'),		
				'date_added' => date('Y-m-d h:i:s')
			);
			$data = $this->security->xss_clean($data);
			$this->common_model->insert($data, 'shorturl');
			$this->session->set_flashdata('msg', 'Url added Successfully');
			redirect(site_url('admin/url'),'refresh');
		}		
    }	
}

