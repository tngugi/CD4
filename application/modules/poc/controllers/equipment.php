<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class equipment extends MY_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('poc_model');
	}
	public function index(){

		$this->home_page();
	}

	public function home_page() {
		$this->login_reroute(array(3,8,9,4));
		$data['content_view'] = "poc/equipment_view";
		$data['title'] = "Equipment";
		$data['sidebar']	= "poc/sidebar_view";
		$data['filter']	=	false;
		$data	= array_merge($data,$this->load_libraries(array('dataTables','poc_equipment')));

		$data['menus']	= 	$this->poc_model->menus(4);


		$data['equipments'] = 	$this->poc_model->get_details("equipment_details",$this->session->userdata("user_filter_used"));
		
		$data['device_types']         = $this->poc_model->get_Device_types();//device types for facility registration
		$this -> template($data);
	}

	public function ss_dt_devices_not_reported(){

		$devices_not_reported = $this->poc_model->devices_not_reported();

		$data 	=	array();
		$recordsTotal =0;

		foreach ($devices_not_reported as $key => $value) {
			$data[] = 	array(
							($key+1),
							$value["facility_name"],
							$value["equipment_category"],
							'<a href="uploads">Do upload</a>'
						);
			$recordsTotal++;
		}
		$json_req 	=	array(
			"sEcho"						=> 1,
			"iTotalRecords"				=>$recordsTotal,
			"iTotalDisplayRecords"		=>$recordsTotal,
			"aaData"					=>$data
			);

		echo json_encode($json_req);
	}

	public function ss_dt_device_reg_req(){

		$facilities_requested    = $this->poc_model->get_dev_reg_requests($this->session->userdata("id"));//full details of the facilities requested for registration

		$data 	=	array();
		$recordsTotal =0;

		foreach ($facilities_requested as $key => $value) {
			$data[] = 	array(
							($key+1),
							$value["facility_id"],
							$value["Equipment"],
							$value["Serial"],
							$value["CTC"]
						);
			$recordsTotal++;
		}
		$json_req 	=	array(
			"sEcho"						=> 1,
			"iTotalRecords"				=>$recordsTotal,
			"iTotalDisplayRecords"		=>$recordsTotal,
			"aaData"					=>$data
			);

		echo json_encode($json_req);
	}
}