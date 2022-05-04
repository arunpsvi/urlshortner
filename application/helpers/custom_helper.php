<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	
	//-- check logged user
	if (!function_exists('check_login_user')) {
	    function check_login_user() {
	        $ci = get_instance();
	        if ($ci->session->userdata('is_login') != TRUE) {
	            $ci->session->sess_destroy();
	            redirect(site_url('auth'));
	        }
	    }
	}

	if(!function_exists('check_power')){
	    function check_power($type){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->check_power($type);        
	        
	        return $option;
	    }
    } 

	//-- current date time function
	if(!function_exists('current_datetime')){
	    function current_datetime(){        
	        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	        $date_time = $dt->format('Y-m-d H:i:s');      
	        return $date_time;
	    }
	}

	//-- show current date & time with custom format
	if(!function_exists('my_date_show_time')){
	    function my_date_show_time($date){       
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y h:i A");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	//-- show current date with custom format
	if(!function_exists('my_date_show')){
	    function my_date_show($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}


	if(!function_exists('svi_remove_blank_date')){
	    function svi_remove_blank_date($date){    

			if($date =='0000-00-00' || $date =='1970-01-01' || $date =='--' || $date ==''){
				return "";
			}else{
				return $date;
			}
	    }
	}

	if(!function_exists('my_clear_fields')){
	    function my_clear_fields($data){      
			$newData=Array();
	        foreach ($data as $key=>$value){
				//print "$key=>$value <br>";
				$value=preg_replace('/\s+$/im', '', $value); 
				$value=preg_replace('/^\s+/im', '', $value); 
				$value=preg_replace('/\s+/im', ' ', $value);
				$newData[$key]=$value;
			}
	        return $newData;
	    }
	}
	
	

	
		
	

	if(!function_exists('svi_buildArray')){
	    function svi_buildArray($mdArray,$key,$value,$default=''){   
			$array=Array();
			if($default != ''){
				$array['']=$default;
			}			
			foreach($mdArray as $sdArray){
				$array[$sdArray[$key]]=$sdArray[$value];
			}
	        return $array;
	    }
	}