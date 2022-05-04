<!--.row-->

<div class="row">
	<div class="col-md-12">
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
					<form  class="needs-validation" autocomplete="off" name='addUser' id='addUser' method='post' action="<?php echo $action; ?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

						<div class="form-body">
							<h3 class="box-title">Person Info</h3>
							<hr>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label required">First Name</label>
										<input type="text" name="first_name" id="first_name" class="form-control" value="<?php if(!empty($first_name)) { echo $first_name; } ?>" autocomplete="off">
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label class="control-label required">Last Name</label>
										<input type="text" name="last_name" id="last_name" value="<?php if(!empty($last_name)) { echo $last_name; } ?>" class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label required">E-mail Address</label>
										<input type="text" name="email" id="email" value="<?php if(!empty($email)) { echo $email; } ?>" class="form-control" placeholder="">
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label">Mobile</label>
										<input type="text" name="mobile" id="mobile" value="<?php if(!empty($mobile)) { echo $mobile; } ?>" class="form-control" placeholder="">
									</div>
								</div>	
							</div>

							<div class="row">
								
								<?php if(empty($user_id)){ ?>
														
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label required">User Name</label>
											<input type="text" name="username" id="username" value="<?php if(!empty($username)) { echo $username; } ?>" class="form-control" placeholder="">
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label required">Password</label>
											<input type="password" name="password" id="password" class="form-control" placeholder="">
										</div>
									</div>
								
								<?php }else{ ?>
									<input type="hidden" name="password" id="password" value="<?php if(!empty($password)) { echo $password; } ?>">
									<input type="hidden" name="username" id="username" value="<?php if(!empty($username)) { echo $username; } ?>">
								<? } ?>

								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label required">User Role</label>
										<select class="form-control required" name='user_role' id='user_role'>
											<option value="">Select</option>
											<?php  foreach ($user_roles as $key=>$value){  ?>
											<option value="<?php echo $key; ?>" <?php if($role==$key){ echo "selected"; } ?>><?php echo $value; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								

								<div class="col-md-2">
									<div class="form-group">
										<label class="control-label required">Login Status</label>
										<select class="form-control required" name='status' id='status'>
											<option value="0" <?php if($status=="0"){ echo "selected"; } ?> >Inactive</option>
											<option value="1" <?php if($status=="1"){ echo "selected"; } ?> >Active</option>
											
										</select>
										
									</div>
								</div>						
														
														
							
							</div>
							<!--/row-->
							<!--
							<h3 class="box-title m-t-10">Address</h3>
							<hr>
							<div class="row">
								<div class="col-md-6 ">
									<div class="form-group">
										<label>Address 1</label>
										<input type="text" name='address1' value="<?php if(!empty($address1)) { echo $address1; } ?>" class="form-control">
									</div>
								</div>
								<div class="col-md-6 ">
									<div class="form-group">
										<label>Address 2</label>
										<input type="text" name='address2' value="<?php if(!empty($address2)) { echo $address2; } ?>" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>City</label>
										<input type="text" name='city' value="<?php if(!empty($city)) { echo $city; } ?>" class="form-control">
									</div>
								</div>
								
								<div class="col-md-3">
									<div class="form-group">
										<label>Zip Code</label>
										<input type="text" name='zipcode' value="<?php if(!empty($zipcode)) { echo $zipcode; } ?>" class="form-control">
									</div>
								</div>
								
							</div> -->
							
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-rounded btn-sm btn-success"> <i class="fa fa-check"></i>Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!--./row-->
<script>
	$(document).ready(function() {						
		$("#addUser").validate({
			rules: {
				first_name: "required",					
				last_name: "required",					
				email: {
				  required: true,
				  email: true
				},
				username: "required",
				password: "required",
				user_role: "required",
				//tpc: "required",
			},
			messages: {
				first_name: "Please input first name",		
				last_name: "Please input last name",		
				email: "Please input correct email",
				username: "Please input username",
				password: "Please input password",
				user_role: "Please select user role",
			},				
		});
		
		/*$('#saveChallan').click(function() {
			$("#saveChallan").hide();
			$(".processing").show();
			setTimeout(function(){
				$(".processing").hide();
				$("#saveChallan").show();		
			}, 10000);
			$("#saveChallanForm").valid();
		});*/
	});  

</script>