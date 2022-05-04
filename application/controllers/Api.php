<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		$this->load->model('customer_model');
    }

    public function result($id) {
		
		$userData = $this->customer_model->getCustomerInfoAPI($id);
		if(empty($userData)){
			$userData['message']='No record found';
		}
		$data['customer'] = $userData;
		print json_encode($data);		
    }

}