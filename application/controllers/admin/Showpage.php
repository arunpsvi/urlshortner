<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Showpage extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		$this->load->model('url_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('pagination');		
    }

    public function index() {
		
		$this->load->view('admin/index', $data);		
    }

	public function url($url) {
		$urlData = $this->url_model->getLongUrl($url);	
		
		redirect($urlData->long_url,'refresh');	
    }

	
}

