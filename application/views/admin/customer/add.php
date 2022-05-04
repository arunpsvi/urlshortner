<!--.row-->
<div class="row">
	<div class="col-md-12">
		<?php if (validation_errors()) : ?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">x</span> </button>
				<?php echo validation_errors(); ?>
			</div>
    
		<?php elseif (!empty($errorMsg)) : ?>    
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">x</span> </button>
				<?php echo $errorMsg; ?>
			</div>    
		<?php endif; ?>
		<?php $msg = $this->session->flashdata('msg'); ?>
		<?php if (isset($msg)): ?>
			<div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">x</span> </button>
			</div>
		<?php endif ?>

		<?php $error_msg = $this->session->flashdata('error_msg'); ?>
		<?php if (isset($error_msg)): ?>
			<div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">x</span> </button>
			</div>
		<?php endif ?>
	</div>
	<div class="col-md-12">
		<div class="panel panel-info">
			
			<div class="panel-wrapper collapse in" aria-expanded="true">
				<div class="panel-body">
					<form autocomplete="off" class="needs-validation" name='addUser' id='addUser' method='post' action="<?php echo $action; ?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<input type="hidden" name="customer_id" id="customer_id" value="<?php if(!empty($customer_id)){ echo $customer_id;} ?>">
					<input style="display:none" type="text" name="fakeusernameremembered"/>

						<div class="form-body">
							<h3 class="box-title">Contact Info</h3>
							<hr>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label required">Customer Name (Organisation)</label>
										<input type="text" name="organisation" id="organisation" class="form-control" value="<?php if(!empty($organisation)) { echo $organisation; } else { echo set_value('organisation'); } ?>" autocomplete="<?php echo $autocomplete; ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label required">Customer Nick Name</label>
										<input type="text" name="nick_name" id="nick_name" value="<?php if(!empty($nick_name)) { echo $nick_name; } else { echo set_value('nick_name'); } ?>" class="form-control" placeholder="" autocomplete="<?php echo $autocomplete; ?>">
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label required">Location</label>
										<input type="text" name='location' id='location' value="<?php if(!empty($location)) { echo $location; } ?>" class="form-control " autocomplete="<?php echo $autocomplete; ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">City</label>
										<input type="text" name='city' id='city' value="<?php if(!empty($city)) { echo $city; } ?>" class="form-control " autocomplete="<?php echo $autocomplete; ?>">
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label required">Phone Number</label>
										<input type="text" name="phone" id="phone" value="<?php if(!empty($phone)) { echo $phone; } else { echo set_value('phone'); } ?>" class="form-control input-class-mobile" placeholder="" autocomplete="<?php echo $autocomplete; ?>">
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label required">E-mail Address</label>
										<input type="text" name="email" id="email" value="<?php if(!empty($email)) { echo $email; }else { echo set_value('email'); } ?>" class="form-control" placeholder="" autocomplete="<?php echo $autocomplete; ?>">
									</div>
								</div>								
								
												
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label required">Contact Person</label>
										<input type="text" name="contact_person" id="contact_person" value="<?php if(!empty($contact_person)) { echo $contact_person; }else { echo set_value('contact_person'); } ?>" class="form-control" placeholder="" autocomplete="<?php echo $autocomplete; ?>">
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<label class="control-label">Remarks</label>
										<input type="text" name='remarks' id='remarks' value="<?php if(!empty($remarks)) { echo $remarks; } ?>" class="form-control " autocomplete="<?php echo $autocomplete; ?>">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label required">Country</label>
										<?php echo form_dropdown('country', $countryArray, $country,'class="form-control" id="country"'); ?>
									</div>
								</div>
							
							</div>												
						</div>
						

						<button type="submit" class="btn btn-rounded btn-sm btn-success"> <i class="fa fa-check"></i>Save</button>
						<button type="button" class="btn btn-rounded btn-sm btn-danger" id='clearBtn'><i class="fa fa-remove"></i>&nbsp;Cancel</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--./row-->
<script>
	$(document).ready(function() {	
		$("#reset").click(function(){
			$("#postCodeHtml").html('');
		});
		$("#clearBtn").click(function(){ 
			location.href='<?php echo site_url("admin/assignment"); ?>';			
		});
		$(document).on("click", ".marker-map" , function() {
			$("#map").html('');
			if(this.id=='markerPosition'){
				if($("#latitude").val() !='' && $("#longitude").val() !=''){
					$("#map").html('<?php echo $this->config->item("spinner_code") ?>');
					load($("#latitude").val(),$("#longitude").val());
				}
			}else if(this.id=='markerConflictCheck'){
				if($("#latitude").val() !='' && $("#longitude").val() !=''){
					$("#map").html('<?php echo $this->config->item("spinner_code") ?>');
					conflictMap($("#latitude").val(),$("#longitude").val(),'');
				}
			}
		});

		var uniqueEmailUrl="<?php echo site_url('admin/customer/checkEmailUnique'); ?>";
		uniqueEmailUrl = uniqueEmailUrl+"?customer_id="+ $("#customer_id").val();
		
		$("#addUser").validate({
			rules: {				
				email: {
					email:true,
					required:true,
					"remote":uniqueEmailUrl
				},
				organisation: {
					required: true
				},
				nick_name: {
					required: true
				},	
				location: {
					required: true
				},	
				contact_person: {
					required: true
				},				
				phone: {
					required: true
				}				
			},
			messages: {
				email: {
					"remote":"Email already exists"
				}
			},
		});
		
		
	}); 
</script>
