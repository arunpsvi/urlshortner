<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Back extends CI_Controller {

	public function __construct(){
        parent::__construct();
        check_login_user();
    }

    /****************Function Back**********************************
     * @type            : Function
     * @function name   : index
     * @description     : This redirect to back page automatically 
     *                    
     *                       
     * @param           : null 
     * @return          : null 
     * ********************************************************** */
	 
    public function index(){
		
        $referred_from = $this->session->userdata('referred_from');
		redirect($referred_from, 'refresh');
    }

}