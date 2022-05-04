    <!-- Start Page Content -->
    <div class="row">
        <div class="col-lg-12">

            
           <div class="panel panel-info">
              <div class="panel-body table-responsive">		
			  <div class="alert alert-success delete_msg pull d-none" id='close_checkbox' style="width: 100%"> 
			  </div>
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
				
					
					
					
					
				<table class="table-sm table-hover table-bordered" cellspacing="0" width='100%'>
					<thead>
						<tr>    
							<th>S No</th>                       
							<th>Name</th>                                   
							<th>Short Url</th>                
							<th>Long url</th>                                    
							
						</tr>
					</thead>
					<tfoot>
						<tr>
						   
						</tr>
					</tfoot>
                            
                            <tbody>
								
                            <?php $counter=1; foreach ($urls as $url): ?>							
								<tr>						
									<td><?php echo $counter; ?></td>
									<td><?php echo $url['name']; ?></td>
									<td><a target='_blank' href='<?php echo site_url('show/'.$url['short_url']); ?>'><?php echo site_url('show/'.$url['short_url']); ?></a></td>
									
									<td><?php echo $url['long_url']; ?></td>							
								</tr>
                            <?php $counter++; endforeach ?>

                            </tbody>
                        </table>
                    </div>					
				<?php echo $pagination; ?>	
            </div>
        </div>
    </div>

 </div>

    <!-- End Page Content -->
<div id="dialog-confirm" ></div>
	
<script>
	function showPage(id){
		var id=id;
		var url='<?php echo site_url("admin/showpage?uid="); ?>';
		url =url+id;
		location.href=url;
	}
	$(document).ready(function() {
		$("form").attr('autocomplete', 'off');
		$("#clearBtn").click(function(){ 
			location.href='<?php echo site_url("admin/url"); ?>';			
		});	
			
	});
</script>