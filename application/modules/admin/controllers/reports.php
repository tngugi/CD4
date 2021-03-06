<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class reports extends MY_Controller {

	public $data 	= 	array();
	public $db_view	=	"v_pima_tests_details";
	
//creates the page
	public function __construct(){
		parent::__construct();

		$this->data['content_view'] = "poc/reports_view";
		$this->data['controller']	=	"nacp/reports";
		$this->data['title'] = "Reports";
		
		//$this->data['sidebar']	= "nacp/nacp_sidebar_view";
		//$this->data['sidebar'] = false;
		$this->data['filter']	=	false;
		$this->data	=array_merge($this->data,$this->load_libraries(array('FusionCharts','poc_reports','jqueryui','dataTables')));

		$this->load->model('admin_model');
//content for the select by criteria		
		$this->data['devices'] = $this->admin_model->db_filtered_view("v_facility_pima_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));
		$this->data['facilities'] = $this->admin_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,null,array("facility_name"));
		$this->data['regions']	= $this->admin_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,array("region_name"),null);
		$this->data['districts'] =	$this->admin_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,array("district_name"),null);		
		$this->data['partners'] = $this->admin_model->db_filtered_view("v_facility_details",$this->session->userdata("user_filter_used"),null,array("partner_name"),null); 
	
		
//content for side bar
		$this->data['devices_not_reported'] = $this->admin_model->devices_not_reported();//devices not yet report		
		$this->data['errors_agg'] = $this->admin_model->errors_reported();//errors reported		
		
		//controls the menu for select criteria for selection 
		$this->data['starting_year'] = $this->config->item("starting_year");
		//sets the menu to the reports page
		$this->data['menus'] = $this->admin_model->menus(5);
	}	
	
	public function index(){
		$this->login_reroute(array(1,2));
		$this->template($this->data);
	}
}