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
					<form  class="needs-validation" autocomplete="off" name='changeViewRole' method='post' action="<?php echo $action; ?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

						<div class="form-body">
							<div class="row">							
								<div class="col-md-4">
									<div class="form-group">
										<label class="control-label required">Users</label>
										<select class="form-control " name='controller' id='controller'>
											<option value="">Select</option>
											<?php  foreach ($controllers as $controllerOption){
											if($this->session->userdata('RoleForAdmin')!='ADMIN' && $controllerOption['role']==2){
												continue;# Don't show list of admin in drop down for DEVELOPER
											}
											?>
											<option value="<?php echo $controllerOption['user_id']; ?>" <?php if($controllerOption['user_id']==$this->session->userdata('id')){ echo "selected"; } ?>><?php echo $controllerOption['first_name']." ".$controllerOption['last_name']. " - ".$user_roles[$controllerOption['role']]; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
								

								
								
														
							</div>							
							
							
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-rounded btn-sm btn-success"> <i class="fa fa-check"></i>View</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
