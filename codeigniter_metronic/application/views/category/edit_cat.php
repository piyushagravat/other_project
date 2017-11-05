
	
		<div class="col-md-12">
			<div class="portlet box blue">
				


				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-gift"></i> Edit Category
					</div>
				</div>
				<div class="portlet-body form">				
						


						<form class="form-horizontal" role="form" action="<?php echo site_url('category/edit_cat'); ?>" method="post" >
							<div class="form-body">

								<?php $this->load->view('base_template/base_alert'); ?>		
															  	
								<?php $error = ''; if(form_error('catname')){ $error = 'has-error'; } ?>

							   	<div class="form-group <?php echo $error; ?>">
							        <label for="" class="col-md-2 control-label">Category Name <span class="f_req">*</span></label>
							        <div class="col-md-5">
										<input type="text" name="catname" id="catname" value="<?php echo set_value('catname',$cat_info_records->cname); ?>" class="form-control"  >
										<?php echo form_error('catname', '<span class="help-block">', '</span>'); ?>
									</div>
							  	</div>
							  	<div class="form-group">
										<label class="col-md-2 control-label">Status <span class="required">

										* </span>
										</label>
										<div class="col-md-5">
											<select class="form-control select2me" name="status">
												<option value="">Select...</option>

												<option value="Active"  <?php if($cat_info_records->status == 'Active') { ?>selected="selected"<?php }  ?>>Active</option>

												<option value="Inactive	"  <?php if($cat_info_records->status == 'Inactive') { ?>selected="selected"<?php }  ?>>Inactive</option>

											</select>

										</div>

									</div>
							  	
				
					</div>
					<div class="form-actions fluid">
						<div class="col-md-offset-2 col-md-10">							
							<input type="hidden" name="cid" value="<?php echo $cat_info_records->cid; ?>" />
							
							<button class="btn btn-success" type="submit">Save Changes</button>
							<a class="btn btn-default" href="<?php echo site_url('category/cat_list'); ?>">Cancel</a>
						</div>
					</div>			
				</form>
				</div>
				</div>
			</div>
			