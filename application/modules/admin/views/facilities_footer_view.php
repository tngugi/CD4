<script>
	$().ready(function() {
    	$("#dis_div").hide();


	$('#facilities_table').dataTable({
		"bJQueryUI":true, 
		"sAjaxSource": "<?php echo base_url("admin/facilities/ss_dt_facilities");?>" ,
		"aoColumnDefs": [
		{ "bSortable": false, "aTargets": [ 0 ] }
		],
		"aaSorting": [[1, 'asc']]

	});	

	});

	<?php
		$dis = str_replace("'","",json_encode($districts));
	?>

	var json_dis 	= '<?php echo $dis; ?>';
	var dis 		=	JSON.parse(json_dis);	
	

	$("#reg").change(function(){ 

		var reg 	= $("#reg").val();
    	var options ='<option value="">*Select a District*</option>';

    	for (i = 0; i < dis.length; ++i) {  		
    		if(dis[i]["region_id"]==reg){
    			options += '<option value="'+dis[i]["district_id"]+'">'+dis[i]["district_name"]+'</option>';
    		}
		}

		$("#dis").html(options);
		
		if(!$("#reg").val()){			
			$("#dis_div").hide();
		}else{
			$("#dis_div").show();
		}

    });



	$("#editreg").change(function(){ 

		var reg 	= $("#editreg").val();
    	var options ='<option value="">*Select a District*</option>';

    	for (i = 0; i < dis.length; ++i) {  		
    		if(dis[i]["region_id"]==reg){
    			options += '<option value="'+dis[i]["district_id"]+'">'+dis[i]["district_name"]+'</option>';
    		}
		}

		$("#editdis").html(options);

    });

	function edit_facility(id,facility_name,district_id,district_name,region_id,region_name,partner_id,partner_name,email,phone,rollout_status_id){

		//initialize districts given the region

    	var options ='<option value="">*Select a District*</option>';

    	for (i = 0; i < dis.length; ++i) {  		
    		if(dis[i]["region_id"]==region_id){
    			options += '<option value="'+dis[i]["district_id"]+'">'+dis[i]["district_name"]+'</option>';
    		}
		}

		$("#editdis").html(options);

		$("#ed_dt_fac_name").html(facility_name);
		$("#ed_dt_dis_name").html(district_name);
		$("#ed_dt_reg_name").html(region_name);
		$("#ed_dt_par_name").html(partner_name);
		$("#ed_dt_phone").html(phone);
		$("#ed_dt_email").html(email);


		$("#editfacilityid").val(id);
		$("#editfacname").val(facility_name);
		$("#editdis").val(district_id);
		$("#editreg").val(region_id);
		$("#editpar").val(partner_id);


		$('input[name=editstatus][value=1]').prop('checked', false);
		$('input[name=editstatus][value=2]').prop('checked', false);
		$('input[name=editstatus][value=3]').prop('checked', false);

		$('input[name=editstatus][value='+rollout_status_id+']').prop('checked', true);

		$("#editemail").val(email);
		$("#editphone").val(phone);
			
		$("#editdetailsdiv").modal("show");

	}
	function hide_edit(){
		$("#editdetailsdiv").modal("hide");
	}

</script>