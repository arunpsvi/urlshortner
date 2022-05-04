<script>
	function showPluginDetails() {
		var id = $('#pluginslist').val();
		$('.plugin-details').hide();
		$('#' + id).show();
		return;
	}
</script>							
							
    <!-- /#wrapper -->
    <!-- jQuery -->
	<?php if (($this->session->flashdata('flash_message')) != ""): ?>
	<script type="text/javascript">
    $(document).ready(function() {
        $.toast({
           
            text: '<?php echo $this->session->flashdata('flash_message'); ?>',
            position: 'top-right',
            loaderBg: '#5475ed',
            icon: 'info',
            hideAfter: 3500,
            stack: 6
        })
    });
    </script>
	<?php endif; ?>	
	
	<?php if (($this->session->flashdata('error_message')) != ""): ?>
	<script type="text/javascript">
    $(document).ready(function() {
        $.toast({
           
            text: '<?php echo $this->session->flashdata('error_message'); ?>',
            position: 'top-right',
            loaderBg: '#f56954',
            icon: 'warning',
            hideAfter: 3500,
            stack: 6
        })
    });
    </script>
	<?php endif; ?>
	
	<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script> 
	
	


	<!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>svi/bootstrap/dist/js/bootstrap.min.js"></script>   
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>svi/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
	 <!-- icheck -->   
    <script src="<?php echo base_url(); ?>svi/js/jquery.slimscroll.js"></script>    
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>svi/js/custom.min.js"></script>
    <!--<script src="<?php echo base_url(); ?>svi/js/jquery.dataTables.min.js"></script>-->
	<script src="<?php echo base_url(); ?>svi/js/jquery-confirm.min.js"></script>
    
	
    
	
	
	
<script>
    function checkDelete()
    {
        var chk = confirm("Are You Sure To Delete This !");
        if (chk)
        {
            return true;
        } else {
            return false;
        }
    }
	function LTrim( value ) {
		var re = /\s*((\S+\s*)*)/;
		return value.replace(re, "$1");
	}
// Removes ending whitespaces
	function RTrim( value ) {	
		var re = /((\s*\S+)*)\s*/;
		return value.replace(re, "$1");
	}

// Removes leading and ending whitespaces
	function trim( value ) {
		return LTrim(RTrim(value));
	}
</script>


<!-- Load google map data -->
<script type="text/javascript">


function load(latitude,longitude) {
	
	var zoomLevel=15;
	var image='';
	var map = new google.maps.Map(document.getElementById('map'), {
	   center: new google.maps.LatLng(latitude, longitude),
	   zoom: parseInt(zoomLevel)
	});	
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(latitude, longitude),
		map: map,
		draggable:true,
	});
	google.maps.event.addListener(marker, 'dragend', function(evt){
		$("#lat").html(evt.latLng.lat());
		$("#lng").html(evt.latLng.lng());
		$("#latitude").val(evt.latLng.lat());
		$("#longitude").val(evt.latLng.lng());
		$("#latlong_radioUD").prop('checked', true);
	});
}

function loadWithoutDrag(latitude,longitude) {
	
	var zoomLevel=17;
	var image='';
	var map = new google.maps.Map(document.getElementById('map'), {
	   center: new google.maps.LatLng(latitude, longitude),
	   zoom: parseInt(zoomLevel)
	});	
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(latitude, longitude),
		map: map,
		//draggable:true,
	});
	
}

function conflictMap(latCenter,longCenter,qrystring) {

	
	var apiUrl='<?php echo site_url('admin/common/conflictMapjson'); ?>';
	apiUrl=apiUrl+qrystring;
	$.ajax({
		url:apiUrl,
		method: 'get',				
		dataType: 'text',
		success: function(response){
			//$("#postCodeHtml").html(response);
			loadMap(latCenter,longCenter,response);
		},
		fail: function(xhr, textStatus, errorThrown){
			$("#map").html('Some error occured! Please try again.');
		}
	});	
}

function loadMap(latCenter,longCenter,jsonData){
	
	var image= "";
	var character= "";
	markerData = JSON.parse(jsonData);
	var latitude = '';
	var longitude = '';
	var name = '';
	var zoomLevel=16;
	var map = new google.maps.Map(document.getElementById('map'), {
	   center: new google.maps.LatLng(latCenter, longCenter),
	   zoom: parseInt(zoomLevel)
	});

	for (var latlong in markerData) {
		var allData=new Array();
		allData=markerData[latlong].split('<SEPT>');
		var image='';
		var message='';
		var character='';
		for (var keyData in allData) {
			//alert(keyData+"--->"+allData[keyData]);
			var finalData=allData[keyData].split('##');
			var i=0;
			var type='';
			var name='';
			var character='';
			var id='';
				for (var key in finalData) {
					//alert(key+"--->"+finalData[key]);
					if(i==0){
						type=finalData[key];
					}else if(i==1){
						name=finalData[key];
					}else if(i==2){
						id=finalData[key];
					}
					i++;
				}
				var latLongArr=latlong.split(',');
				var latitude  = latLongArr[0]
				var longitude = latLongArr[1]
				//alert(latitude+"-->"+longitude+"-->"+type+"-->"+name+"-->"+id);
				var letter='';
				name=decodeURIComponent(name);
				name=name.split('+').join(' ');
				if(type=='P'){
					var url="<?php echo site_url('admin/project/update');?>/"+id;
					message += "<a target='_blank' href='"+url+"'><b>P: "+name+"</b></a><br>";
					character=type;
				}
				if(type=='C'){
					var url="<?php echo site_url('admin/customer/update');?>/"+id;
					message += "<a target='_blank' href='"+url+"'><b>C: "+name+"</b></a><br>";

					if(character==''){
						character=type;
					}
				}
				if(type=='Q'){
					var url="<?php echo site_url('admin/quotation/update');?>/"+id;
					message += "<a target='_blank' href='"+url+"'><b>Q: "+name+"</b></a><br>";
					if(character==''){
						character=type;
					}
				}			
			}
			image="<?php echo base_url(); ?>images/marker" + character + ".png";	
			//alert(character);
			 var marker = new google.maps.Marker({
				position: new google.maps.LatLng(latitude, longitude),
				map: map,
				icon: image			
			  });
			  attachSecretMessage(marker, message);
		
	}
}


  function attachSecretMessage(marker, secretMessage) {
	var infowindow = new google.maps.InfoWindow({
	  content: secretMessage
	});

	marker.addListener('click', function() {
	  infowindow.open(marker.get('map'), marker);
	});
  }

	
function findAddressAdj(addressId){
	var apiUrl='<?php echo site_url('admin/common/getAddressData'); ?>';
	apiUrl=apiUrl+"/"+addressId;

	$.ajax({
		url:apiUrl,
		method: 'get',				
		dataType: 'JSON',
		success: function(response){
			$("#adj_company").val(response.organisation_name);
			$("#adj_address1").val(response.address1);
			$("#adj_address2").val(response.address2);
			$("#adj_address3").val(response.address3);
			if(trim(response.town.toLowerCase())=='london'){
				$("#adj_town").val("");
				$("#adj_county").val(response.town);
			}else{
				$("#adj_town").val(response.town);
				$("#adj_county").val(response.county);
			}
		}
	});			
}

function findAddress(addressId){
	var apiUrl='<?php echo site_url('admin/common/getAddressData'); ?>';
	apiUrl=apiUrl+"/"+addressId;
	$("#map").html('');
	$.ajax({
		url:apiUrl,
		method: 'get',				
		dataType: 'JSON',
		success: function(response){
			$("#company").val(response.organisation_name);
			$("#address1").val(response.address1);
			$("#address2").val(response.address2);
			$("#address3").val(response.address3);
			if(trim(response.town.toLowerCase())=='london'){
				$("#town").val("");
				$("#county").val(response.town);
			}else{
				$("#town").val(response.town);
				$("#county").val(response.county);
			}
			var postcode=response.postcode;
			if(postcode!=''){
				var apiUrl='<?php echo site_url('admin/common/getLatLongByPostCode'); ?>';
				apiUrl=apiUrl+"/"+postcode;

				$.ajax({
					url:apiUrl,
					method: 'get',				
					dataType: 'json',
					beforeSend: function() {
						$("#map").addClass('text-center');
						$("#map").html('<?php echo $this->config->item("spinner_code") ?>');
					},
					success: function(response){
						$("#latlong_radioBO").attr('checked', true);
						$("#markerPosition").attr('checked', true);
						load(response.lat,response.long);
					}
				});
			}
		}
	});			
}

</script>
 
	
</body>

</html>
