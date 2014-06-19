<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class equipment extends MY_Controller {

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
		
		$this->load->model('poc_model');

		$data['devices_not_reported'] = $this->poc_model->devices_not_reported();
		$data['errors_agg'] = $this->poc_model->errors_reported();


		$data['menus']	= 	$this->poc_model->menus(4);


		$data['equipments'] = 	$this->poc_model->get_details("equipment_details",$this->session->userdata("user_filter_used"));
		//$data['equipments'] = 	$this->poc_model->equipments($this->session->userdata("user_filter_used"));
		
		$data['device_types']         = $this->poc_model->get_Device_types();//device types for facility registration
		$data['facility_requests']    = $this->poc_model->get_requested($this->session->userdata("id"));//facilities requested for registration
		$data['facilities_requested']    = $this->poc_model->get_requested_facilities($this->session->userdata("id"));//full details of the facilities requested for registration

		$this -> template($data);
	}
}