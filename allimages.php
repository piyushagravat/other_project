<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1><?php echo $media->newspaper_title; ?></h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url(); ?>admin/media">Manage Media Coverage</a></li>
            <li class="active">List of Images</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- /.row -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">List of Images</h3>
                  &nbsp;<?php if($message != ''){ echo "<span class='btn btn-danger btn-xs'>".$message."</span>"; } ?>
                  <div class="box-tools">
                    <div class="input-group">
                     <a href="<?php echo base_url(); ?>admin/media/add_images/<?php echo $media->mid; ?>"> <button class="btn btn-block btn-primary btn-sm">Add New Images</button></a>
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Images</th>
                      <th>Title</th>
                      <th>Action</th>
                    </tr>
                    <?php foreach($viewdata as $item) { ?>
                    <tr>
                      <td><?php echo $item->id; ?></td>
                      <th><img src="<?php echo base_url(); ?>images/media/<?php echo $item->img; ?>" width="50px"  /></th>
                      <td>
					  <?php if($editimg != "" && $editimg == "editimg" && $id != "" && $id ==  $item->id) { ?>
                      <form role="form" method="post" action="<?php echo base_url()."admin/media/update_image"; ?>" >
                      <input type="hidden" name="id" value="<?php echo $item->id; ?>"  />
                      <input type="hidden" name="mid" value="<?php echo $media->mid; ?>"  />
                      <input class="form-control" type="text" name="txttitle" value="<?php echo $item->img_title; ?>"   />
                      <input class="btn btn-block btn-primary btn-sm"  type="submit" name="submit" value="Update" />
                      </form>
					  <?php } else { echo $item->img_title; } ?>
                      </td>
                      <th><a href="<?php echo base_url(); ?>admin/media/viewimages/<?php echo $media->mid; ?>/editimg/<?php echo $item->id; ?>"><span class="label label-warning">Edit</span></a> &nbsp; <a href="<?php echo base_url(); ?>admin/media/delete_image/<?php echo $item->id; ?>/<?php echo $media->mid; ?>" onclick="return confirm('Are you sure you want to delete?')"><span class="label label-danger">Delete</span></a></th>
                      
                    </tr>
                    <?php } ?>
                   
                    <tr>
                    
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>