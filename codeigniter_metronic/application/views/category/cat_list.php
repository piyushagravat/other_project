

	
		<div class="col-md-12">
			
			<div class="portlet box purple">



				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-comments"></i> Category List
					</div>
				</div>
				<div class="portlet-body">

					<?php $this->load->view('base_template/base_alert'); ?>

					<?php if($this->ion_auth->in_group('admin')){ ?>

					<div class="row">
						<div class="col-md-12">
							<a href="<?php echo site_url('category/add_cat'); ?>" class="btn btn-primary" >Add Category</a>
						</div>
					</div>

					<?php } ?>

					<div class="table-scrollable">

						<table class="table table-striped table-bordered table-hover" id="dt_d">
		                    <thead>
		                        <tr>
		                        	<th>No.</th>
									<th>Category Name</th>
									<th>Status</th>							
									<th>Action</th>
								</tr>
                    	</thead>
                   		<tbody>
	                    <?php
						    $num = 0; if(isset($cat_records) && !empty($cat_records)) { foreach($cat_records as $row){ $num++;
						?>
						<tr>
							<td><?php echo $num; ?></td>							
							<td><?php echo $row->cname; ?></td>							
							<td><?php echo $row->status; ?></td>							
							
							<td>
                              
                              <?php if($this->ion_auth->in_group('admin')){ ?>

                              <a href="<?php echo site_url('category/edit_cat/'.$row->cid); ?>" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a>
                              <a href="<?php echo site_url('category/delete/'.$row->cid); ?>" class="delete" title="Delete"><i class="icon-trash"></i></a>
                          	  
                          	  <?php } ?>		

                          	</td>
                        </tr>
                        <?php } } else { ?>						
						<tr>
							<td colspan="16">No records</td>
						</tr>
						<?php } ?>
                    </tbody>
            	</table>

            	</div>	

				</div>
			</div>
      	</div>
 	