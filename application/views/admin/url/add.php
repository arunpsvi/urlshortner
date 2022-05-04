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
					<form autocomplete="off" class="needs-validation" name='addProject' id='addProject' method='post' action="<?php echo $action; ?>">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<input style="display:none" type="text" name="fakeusernameremembered" id='fakeuser'/>
					
						<div class="form-body">
							<!--<input type='hidden' name='customer_id' id='customer_id' value='' >-->
							<div class="row">
								
								<div class="col-md-3">						  
									<div class="form-group">
										<label class="control-label required">Name</label>
										<input type="text" id="name" name="name" class="form-control" placeholder='Name' value="<?php if(!empty($formData['name'])){ echo $formData['name'];} ?>" required>								
									 </div>
								</div>
							</div>

							<div class='row'>							
								<div class="col-md-12">						  
									<div class="form-group">
										<label class="control-label required">Log Url</label>
										<textarea class="form-control" maxlength="500" rows="6" name='long_url' id='long_url'><?php if(!empty($formData['long_url'])){ echo $formData['long_url'];} ?></textarea>
									</div>
								</div>
								
							</div>
						</div>
						<div class="form-actions m-t-10">
							<button type="submit" class="btn btn-rounded btn-sm btn-success"> <i class="fa fa-check"></i>Save</button>
							<button type="button" class="btn btn-rounded btn-sm btn-danger" id='clearBtn'><i class="fa fa-remove"></i>&nbsp;Cancel</button>
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
		$("form").attr('autocomplete', 'off');
		$("#clearBtn").click(function(){ 
			location.href='<?php echo site_url("admin/url"); ?>';			
		});
		$("#addProject").validate({	
			rules: {				
				name: "required",
				long_url: "required"	
			}
		});		
	});
</script>
