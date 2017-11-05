

	
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">			
					<div class="caption">
						<i class="fa fa-gift"></i> Add SubCat
					</div>
				</div>
				<div class="portlet-body form">
				<form class="form-horizontal" role="form" action="<?php echo site_url('subcategory/add_cat'); ?>" method="post" >
					<div class="form-body">

								<?php $this->load->view('base_template/base_alert'); ?>
								
							  	
								<?php $error = ''; if(form_error('sname')){ $error = 'has-error'; } ?>

							   	<div class="form-group <?php echo $error; ?>">
							        <label for="" class="col-md-2 control-label">Category Name <span class="f_req">*</span></label>
							        <div class="col-md-5">
										<input type="text" name="sname" id="sname" value="<?php echo set_value('sname'); ?>" class="form-control"  >
										<?php echo form_error('sname', '<span class="help-inline">', '</span>'); ?>
									</div>
							  	</div>
							  	<div class="form-group">
										<label class="col-md-2 control-label">Select Category <span class="required">

										* </span>
										</label>
										<div class="col-md-5 ">
											<select class="form-control select2me" name="cid">
												<option value="">Select...</option>

												 <?php
            									 	  foreach($list->result() as $listElement){
                    								   ?>
                      								<option value="<?php echo $listElement->cid?>"><?php echo $listElement->cname;?></option>
                      								<?php
             									 }
              									?>

											</select>

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
		