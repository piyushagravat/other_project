<?php // echo '<pre>';
//print_r($_POST);
//print_r($viewdata); 
// print_r($this->db->last_query());
//exit;?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>HiDent Oral Care.</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--<body onLoad="window.print();">-->
  <body>
    <div class="wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> HiDent Oral Care.
              <p class="pull-right">All Report</p>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <p><strong><?php echo $_POST["txtstartdate"]; ?> - <?php echo $_POST["txtenddate"]; ?></strong><br></p>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Doctor Name</th>
                  <th>Paitent Name</th>
				  <th>City</th>
                  <th>Treatement</th>
                  <th>Patient Fees</th>
                  <th>Patient Fees Status</th>
                  
                </tr>
              </thead>
              <tbody>
                <tr>
                <?php  $i = 0;
				foreach ($viewdata as $item) { 
                                $doctors = $this->appointmentsModel->get_doctor_by_id($item->did)->row();
                                $patients = $this->appointmentsModel->get_patient_by_id($item->pid)->row();
                                $treatments = $this->appointmentsModel->get_treatments_list($item->treatment)->row();
				 ?>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $doctors->first_name." ".$doctors->last_name; ?></td>
                  <td><?php if(count($patients) == 0) { ?><?php echo "-------" ?><?php }else { echo $patients->first_name." ".$patients->last_name;}?></td>
                  <td><?php echo $item->city; ?></td>
				  <td><?php echo $treatments->treatment_title; ?></td>
                  <td><?php echo $item->fees; ?></td>
                  <td><?php echo $item->payment_status; ?></td>
                </tr>
                <?php $i++; }  ?>
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
      
    </div><!-- ./wrapper -->
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>dist/js/app.min.js" type="text/javascript"></script>
  </body>
</html>
 <?php $filename = "Hident_" . date('Ymd') . ".xls"; 
 		header("Content-Disposition: attachment; filename=\"$filename\"");
 		header("Content-Type: application/vnd.ms-excel");
  ?>