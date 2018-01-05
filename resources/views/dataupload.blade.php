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
          <i class="fa fa-upload"></i>
          <font color="#000000">Data Upload</font> 
       </div>

        <form action="<?php echo url('/'); ?>/csv" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
        <div class="card-body">
            <div class="form-row">
                <div class="col-md-6">
                    <label>Choose a file to upload</label>
                    <label class="custom-file">
                        <input type="hidden" name="action" value="import" />
                        <input type="file" name="csv_file" id="file2" class="custom-file-input" />
                            <span class="custom-file-control"></span>
                    </label>
                </div>
                <div class="col-md-12">
                  </br>
                  <label class="col-md-2">Save as:</label>
                  <input type="checkbox" id="blankCheckbox" value="contact">
                  <label class="col-md-4">Contact</label>
                  <input type="checkbox" id="blankCheckbox" value="organisation">
                  <label class="col-md-4">Organisation</label>
              </div>
            </div>
            <div>
             </br> 
             <button onclick="csv()"  type="button"   class = "btn btn-primary " data-toggle="modal" data-target="#exampleModal2">File Upload</button>
             </br>
             <div id="resTbl" class="table-responsive"></div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                Uploaded Successfully
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        </from>

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
    <script src="js/sb-admin-datatables.min.js"></script>
    <!--<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>-->
    <!--<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <!--<script src="https://cdn.bootcss.com/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>-->
    <script src="js/csv/import/jquery.js"></script>
    <script src="js/csv/import/papaparse.js"></script>
    <script src="js/csv/import/jschardet.js"></script>
    <script src="js/csv/import/csv2arr.js"></script>
    <script>
    function csv(){
        $("input[name=csv_file]").csv2arr(function(arr){
          console.log( arr );
          //something to do here
          var tblStr = "<table class='table table-bordered' width='100%' cellspacing='0'>";
          $.each( arr, function(i, line){
            tblStr += "<tr>";
            $.each( line, function(i, cell){
              tblStr += "<td width='120%'><input type='text' name="+cell+" value="+cell+ "></td>";
            });
            tblStr += "</tr>";
          });
          $("#resTbl").html( tblStr );
        });
      }
    </script>
  </div>
</body>

</html>
