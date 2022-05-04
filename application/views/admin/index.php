<?php include 'layout/css.php'; ?>

    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper"> 
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="icon-grid"></i></a>
                <div class="top-left-part "><a class="logo " href="<?php echo site_url('admin/dashboard/') ?>"><b><img src="<?php echo base_url();?>svi/logo.png" height='50' alt="Url Shortner" /></b></a></div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs"><i class="icon-grid"></i></a></li>
                </ul>
				<ul class="nav navbar-top-links navbar-left" style='margin-left:25%;'>
                     <li><a><span style='color:#CC2128;font-weight:bold;'>Welcome to Url Shortners</span></a></li>
                </ul>			
					
					 <ul class="nav navbar-top-links navbar-right pull-right">
                   
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
						
						<b class="hidden-xs"><?php echo $this->session->userdata('name'); ?></b> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">

                            <li><a href="<?php echo site_url('admin/user/changepassword/'.$this->session->userdata('id')); ?>"><i class="ti-settings"></i> Change Password</a></li>
                            <li><a href="<?php echo site_url('auth/logout') ?>"><i class="fa fa-power-off"></i>  Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    	
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                        <!-- input-group -->
                        
                        <!-- /input-group -->
                    </li>
                    <li class="user-pro">
                        <a href="#" class="waves-effect">
						<span class="hide-menu"><?php echo $this->session->userdata('name'); ?><span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level">
                            
                            <li><a href="<?php echo site_url('admin/user/changepassword/'.$this->session->userdata('id')); ?>"><i class="ti-settings"></i> Change Password</a></li>

                        </ul>
                    </li>
                    <li> <a href="<?php echo site_url('admin/dashboard') ?>" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a> </li>
                   

					<li> <a href="javascript:void(0);" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Url Management<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
							<li> <a href="<?php echo site_url('admin/url/add') ?>">Add Url</a></li>
							<li> <a href="<?php echo site_url('admin/url') ?>">List Urls</a></li>
                        </ul>
                    </li>
					
					
                 					
					<?php if(in_array($this->session->userdata('role'), $this->config->item('managerAccess'))){ ?>
					 <li> <a href="forms.html" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Users<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
							<?php if(in_array($this->session->userdata('role'), $this->config->item('adminAccess'))){ ?>
								<li> <a href="<?php echo site_url('admin/user/all_user_list') ?>">User Management</a></li>
							<?php } ?>
                        </ul>
                    </li>
					 <?php } ?>    
                    
					
                    
                    <li><a href="<?php echo site_url('auth/logout') ?>" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                </ul>
            </div>
        </div>
        <!-- Left navbar-header end -->
       
	   
	    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                
			<div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $page_title; ?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
					<?php if($this->router->fetch_class() !='dashboard'){ ?>
                        <ol class="breadcrumb">
                            <li><a href="#" id='backlink'>Back</a></li>
							<?php 
								if(!empty($breadcrumbs)){ 
									foreach ($breadcrumbs as $breadcrumb){ 
										echo $breadcrumb;
									}
								}
							 ?>
                        </ol>
					<?php } ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div> 	
				
				
				
				
				<!--  row    -->
               <?php echo $main_content; ?>
                <!-- /.row -->
			
            </div>
            <!-- /.container-fluid -->
           <?php include 'layout/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
	<script>
	$(document).ready(function(){
		$('.input-class-price').keyup(function(e){
			this.value = this.value.replace(/[^0-9.]/g, '');
		});	
		$(document).on("keyup", ".input-class-price" , function() {
			this.value = this.value.replace(/[^0-9.]/g, '');
		});
		$(document).on("keyup", ".input-class-int" , function() {
			this.value = this.value.replace(/[^0-9]/g, '');
		});
	});
	$('#backlink').click(function(){
			parent.history.back();
			return false;
		});

	</script>
   <?php include 'layout/js.php'; ?>

