

	
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">			
					<div class="caption">
						<i class="fa fa-gift"></i> Add Cat
					</div>
				</div>
				<div class="portlet-body form">
				<form class="form-horizontal" role="form" action="<?php echo site_url('category/add_cat'); ?>" method="post" >
					<div class="form-body">

								<?php $this->load->view('base_template/base_alert'); ?>
								
							  	
								<?php $error = ''; if(form_error('catname')){ $error = 'has-error'; } ?>

							   	<div class="form-group <?php echo $error; ?>">
							        <label for="" class="col-md-2 control-label">Category Name <span class="f_req">*</span></label>
							        <div class="col-md-5">
										<input type="text" name="catname" id="catname" value="<?php echo set_value('catname'); ?>" class="form-control"  >
										<?php echo form_error('catname', '<span class="help-inline">', '</span>'); ?>
									</div>
							  	</div>
							  	
								
									
							  	
								
					</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-2 col-md-10">
							<button class="btn btn-success" type="submit">Save</button>
							<a class="btn btn-default" href="<?php echo site_url('user/user_list'); ?>">Cancel</a>
						</div>
					</div>	
				</form>
				</div>
				</div>
			</div>
		