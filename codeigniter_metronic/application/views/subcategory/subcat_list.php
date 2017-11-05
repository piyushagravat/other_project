

	
		<div class="col-md-12">
			
			<div class="portlet box purple">



				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-comments"></i> Subcategory List
					</div>
				</div>
				<div class="portlet-body">

					<?php $this->load->view('base_template/base_alert'); ?>

					<?php if($this->ion_auth->in_group('admin')){ ?>

					<div class="row">
						<div class="col-md-12">
							<a href="<?php echo site_url('subcategory/add_subcat'); ?>" class="btn btn-primary" >Add Subcategory</a>
						</div>
					</div>

					<?php } ?>

					<div class="table-scrollable">

						<table class="table table-striped table-bordered table-hover" id="dt_d">
		                    <thead>
		                        <tr>
		                        	<th>No.</th>
									<th>Subcategory Name</th>
									<th>Category Name</th>
									<th>Status</th>							
									<th>Action</th>
								</tr>
                    	</thead>
                   		<tbody>
	                    <?php
						    $num = 0; if(isset($subcat_records) && !empty($subcat_records)) { foreach($subcat_records as $row){ $num++;
						    	 $catname = $this->cat_model->get_by_id($row->cid)->row();
						    	
						?>
						<tr>
							<td><?php echo $num; ?></td>							
							<td><?php echo $row->sname; ?></td>
							<td><?php echo $catname->cname; ?></td>							
							<td><?php echo $row->status; ?></td>							
							
							<td>
                              
                              <?php if($this->ion_auth->in_group('admin')){ ?>

                              <a href="<?php echo site_url('subcategory/edit_subcat/'.$row->sid); ?>" class="sepV_a" title="Edit"><i class="icon-pencil"></i></a>
                              <a href="<?php echo site_url('subcategory/delete/'.$row->sid); ?>" class="delete" title="Delete"><i class="icon-trash"></i></a>
                          	  
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
 	