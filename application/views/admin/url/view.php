<div class="panel panel-info">
	<div class="panel-body">
		<fieldset class="proinfo">
			<legend>Assignment Information</legend>
			<div class="row" style='border:1px solid gray;'>
										
				<div class="col-sm-6" style='border:1px solid gray;'>
					<div class="row">
						<div class="col-sm-4">
							<label class='float-left'>Organisation:</label>
						</div>
						<div class="col-sm-8">
							<label class='float-left'><b><?php echo $assignment->organisation; ?></b></label>
						</div>
					</div>
				</div>
				<div class="col-sm-6" style='border:1px solid gray;'>
					<div class="row">
						<div class="col-sm-4">
							<label class='float-left'>Created By:</label>
						</div>
						<div class="col-sm-8">
							<label class='float-left'><b><?php echo $assignment->first_name." ".$assignment->last_name; ?></b> On <i><?php echo svi_uk_date($assignment->date_added); ?></i></label>
						</div>
					</div>
				</div>	
				<div class="col-sm-4" style='border:1px solid gray;'>
					<div class="row">
						<div class="col-sm-4">
							<label class='float-left'>Date:</label>
						</div>
						<div class="col-sm-8">
							<label class='float-left'><b><?php echo svi_uk_date($assignment->date_of_assignment); ?></b></label>
						</div>
					</div>
				</div>
				<div class="col-sm-4" style='border:1px solid gray;'>
					<div class="row">
						<div class="col-sm-4">
							<label class='float-left'>Type of work:</label>
						</div>
						<div class="col-sm-8">
							<label class='float-left'><b><?php echo $assignment->type_of_work; ?></b></label>
						</div>
					</div>
				</div>	
				<div class="col-sm-4" style='border:1px solid gray;'>
					<div class="row">
						<div class="col-sm-8">
							<label class='float-left'>Time Spend (hh:mm):</label>
						</div>
						<div class="col-sm-4">
							<label class='float-left'><b><?php echo $assignment->time_spend; ?></b></label>
						</div>
					</div>
				</div>				
		</fieldset>
		</br>
		<fieldset class="proinfo">
			<legend>Description of work done</legend>			
			<div class="row">
				<div class="col-sm-12">
					<label class='float-left'><?php echo  nl2br($assignment->description_of_work); ?></label>
				</div>
			</div>
				
		</fieldset>
		</br>
		<fieldset class="proinfo">
			<legend>Developer remarks</legend>
			<div class="row">
				<div class="col-sm-12">
					<label class='float-left'><?php echo  nl2br($assignment->developer_remarks); ?></label>
				</div>
			</div>
		</fieldset>
		
	</div>
</div>