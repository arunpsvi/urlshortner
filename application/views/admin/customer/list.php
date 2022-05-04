
    <!-- Start Page Content -->

    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
              <div class="panel-body table-responsive">				
				 <?php $msg = $this->session->flashdata('msg'); ?>
            <?php if (isset($msg)): ?>
                <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>

            <?php $error_msg = $this->session->flashdata('error_msg'); ?>
            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                </div>
            <?php endif ?>
			<form autocomplete="off" class="needs-validation" name='addProject' id='addProject' method='get' action="<?php echo $action; ?>">
					<input type="hidden" name="customer_id" value="<?php echo set_value('customer_id'); ?>" id="customer_id">
					<div class="row">
						<div class="col-md-3 col-sm-4 col-xs-6">					  
						  <div class="form-group">
							 <label class="control-label">Customer Name (organisation)</label>
							 <input type="search" name="organisation" value="<?php if(!empty($formData['organisation'])){ echo $formData['organisation']; } else{ echo set_value('organisation'); } ?>" id="organisation" class="form-control" autocomplete="<?php echo $autocomplete; ?>" placeholder='Type minimum 3 chars'>								
						  </div>
						</div>												
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label">&nbsp;</label>
								<button type="submit" class="btn btn-rounded btn-sm btn-info"> <i class="fa fa-search"></i> Search</button>
								<button type="button" class="btn btn-rounded btn-sm btn-danger" id='clearBtn'> <i class="fa fa-remove"></i> Clear Search</button>
							</div>
						</div>
					</div>
				</form>
							<table class="table-sm table-hover table-bordered" cellspacing="0" width='100%'>
                            <thead>
                                <tr>
                                   
                                    <th>Organisation</th>
                                    <th>Contact Person</th>
									<th>Nick name</th>
                                    <th>E-mail</th>                                    
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                   	
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                   
                                </tr>
                            </tfoot>
                            
                            <tbody>
                            <?php  foreach ($users as $user): ?>
                                <?php 
									$ci = get_instance();
									$country=$ci->db->get_where('country',array('country_id'=>$user['country']))->row()->name;
								?>
                                <tr>                                  
                                    <td><?php echo $user['organisation']; ?></td>
                                    <td><?php echo $user['contact_person']; ?></td>
                                    <td><?php echo $user['nick_name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td><?php echo $user['phone']; ?></td>
                                    <td><?php echo $user['location']; ?></td>
                                    <td><?php echo $user['city']; ?></td>
                                    <td><?php echo $country; ?></td>                                   
                                    

		<td class="text-nowrap">                                 
			<a href="<?php echo site_url('admin/customer/update/'.$user['customer_id']) ?>" title="Update Contact"><i class="fa fa-pencil icon-blue m-r-5"></i></a>
			<?php if(!empty($user['total_assignments']) && $user['total_assignments']>0){ ?>
			<a href='#' id="<?php echo $user['customer_id']; ?>" class='delete_contact' title="Update Contact"><i class="fa fa-trash icon-blue m-r-5"></i></a>
			<?php } ?>
			
		</td> 
	</tr>

                            <?php endforeach ?>

                            </tbody>
						</table>
                    </div>
				
				<?php echo $pagination; ?>
				

            </div>
        </div>
    </div>
 </div>
<!-- End Page Content -->
<script>
	$(document).ready(function() {
		$("form").attr('autocomplete', 'off');
		$("#clearBtn").click(function(){ 
			location.href='<?php echo site_url("admin/customer"); ?>';			
		});
		
		$('#contact_name').autocomplete({
			'source': function(request, response) {
				$('#customer_id').val('');
				var apiUrl='<?php echo site_url('admin/common/searchCustomer'); ?>';
				apiUrl=apiUrl+"/"+$('#contact_name').val();

				$.ajax({
					url:apiUrl,
					type: "GET",
					dataType: 'json',
					success: function(json) {
						response($.map(json, function(item) {	
							return {
								//label: item['first_name'] + " " +  item['last_name'] + " | " + item['company'],
								label: item['first_name'] + " " +  item['last_name'],
								id:item['customer_id']
							}
						}));
					}
				});
			},
			'select': function(event , ui) {	
				$('#customer_id').val(ui.item.id);
			},
			minLength : 3			
		});
		$('#company_name').autocomplete({
			'source': function(request, response) {
				var apiUrl='<?php echo site_url('admin/common/searchCustomer'); ?>';
				apiUrl=apiUrl+"/"+$('#company_name').val();

				$.ajax({
					url:apiUrl,
					type: "GET",
					dataType: 'json',
					success: function(json) {
						response($.map(json, function(item) {	
							return {
								//label: item['first_name'] + " " +  item['last_name'] + " | " + item['company'],
								label: item['first_name'] + " " +  item['last_name'],
								id:item['customer_id']
							}
						}));
					}
				});
			},
			'select': function(event , ui) {	
				$('#customer_id').val(ui.item.id);
			},
			minLength : 3			
		});
		$('#organization').autocomplete({
			'source': function(request, response) {
				var apiUrl='<?php echo site_url('admin/common/searchOrganization'); ?>';
				apiUrl=apiUrl+"/"+$('#organization').val();

				$.ajax({
					url:apiUrl,
					type: "GET",
					dataType: 'json',
					success: function(json) {
						response($.map(json, function(item) {	
							return {
								//label: item['first_name'] + " " +  item['last_name'] + " | " + item['company'],
								label: item['email_domain'],
								//id:item['customer_id']
							}
						}));
					}
				});
			},
			'select': function(event , ui) {	
				$('#organization').val(ui.item.email_domain);
			},
			minLength : 3			
		});
		
	});
	$(".delete_contact").click(function(){
		var deleteId = this.id;
		var siteUrl = '<?php echo site_url("admin/customer/delete/"); ?>';
		siteUrl = siteUrl+deleteId;
		$.confirm({
			title: 'Please Confirm!',
			content: 'Once deleted, you will not be able to recover this Customer.',
			type: 'red',
			buttons: {					
				 confirm: function () {
					location.href=siteUrl;
				},
				cancel: function () {
					
				}					
			}
		});
	});
</script>