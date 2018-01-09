<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Grodata Solutions</title>

  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
     @extends('header')

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Example DataTables Card-->
      <div class="card mb-3" >
        <div class="card-header">
          <i class="fa fa-bookmark"></i> Report
        </div>
        <div class="card-body">

        <form action="<?php echo url('/'); ?>/targetreportreturn" method="post">
            <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>" >
            <div class="table">
                <table class="table table-bordered col-md-12" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <td width="40%"rowspan=$rowspan style='vertical-align: middle;text-align: center;'>
                         <br/>user:
                        <div class="form-group ">
                               <select style="height:38px" name="name" aria-controls="dataTable" class="form-control form-control-sm">
                                  <?php foreach($users as $s) {?>
                                        <option value="<?php echo $s->fname; ?>"><?php echo $s->fname; ?></option>
                                  <?php }?>
                            </select>
                        </div>
                        
                        </td>
                        
                        <td width="25%" rowspan=$row_host1 style='vertical-align: middle;'>from:
                            <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input name="start" class="form-control col-md-9" type="text" />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </td>
                        
                        <td width="25%" rowspan=$row_host1 style='vertical-align: middle;'>to  :
                            <div id="datepicker1" class="input-group date" data-date-format="yyyy-mm-dd">
                                <input name="end" class="form-control col-md-9" type="text" />
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </td>
            
                    <td rowspan = $ rowspan style='vertical-align: middle;text-align: center;'>
                    <button type="submit" role= "button" class = "btn btn-primary ">Filter</a>
                </td>
                </tr>
                </table>
             </form>

            </div>
        </div>
    
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="/logout">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <!-- <script src="js/sb-admin-datatables.min.js"></script>-->
    <!-- <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>-->
    <!-- <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <!-- <script src="https://cdn.bootcss.com/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>-->
    
    
    <script>
        $(function () {
          $("#datepicker").datepicker({
                autoclose: true,
                todayHighlight: true
              }).datepicker('update', new Date());
          });
          $(function () {
            $("#datepicker1").datepicker({
               autoclose: true,
               todayHighlight: true
             }).datepicker('update', new Date());
          });
    </script>
    <script>
          
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    
    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

  </div>
</body>

</html>
