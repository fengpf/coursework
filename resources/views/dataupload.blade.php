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

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
        <div class="card-body">
            @if(Session::has('message'))                                            
            <div class="alert alert-success">                                          
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{Session::get('message')}}
            </div>  
           @endif
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
                  <input type="checkbox" id="con_box" value="contact">
                  <label class="col-md-4">Contact</label>
                  <input type="checkbox" id="org_box" value="organisation">
                  <label class="col-md-4">Organisation</label>
              </div>
            </div>
            <div>
             </br> 
             <button onclick="csv()"  type="button"   class = "btn btn-primary ">File Upload</button>
             </br>

             <div id="con" class="table-responsive">
                <form action="<?php echo url('/'); ?>/batchadd_contact" method="post">
                    <input type="hidden" name="table" value="contact" />
                     <table class='table table-bordered' width='100%' cellspacing='0'>
                         <thead>
                             <tr>
                                <th>RecordType</th>
                                <th>RecordStatus</th>
                                <th>Instruction</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Title</th>
                                <th>Email</th>
                                <th>JobTitle</th>
                                <th>Telephone</th>
                                <th>Telephone2</th>
                                <th>Mobile</th>
                                <th>PersonType</th>
                                <th>Organisation</th>
                                <th>DepartmentLevel1</th>
                                <th>DepartmentLevel2</th>
                                <th>Postcode</th>
                                <th>Region</th>
                                <th>Country</th>
                                <th>Linkedin</th>
                                <th>Professional Interest</th>
                                <th>Biography Text</th>
                                <th>Notes</th>
                             </tr>
                         </thead>
                         <tbody></tbody>
                     </table>
                     <div class="form-row">
                         <div class="col-md-1">
                             </br><button type="submit"  class="btn btn-primary" data-toggle="modal" data-target="#save">
                                 Save
                             </button>
                         </div>
                     </div>
                </form>
               </div>

            <div id="org" class="table-responsive">
             <form action="<?php echo url('/'); ?>/batchadd_organisation" method="post">
                  <input type="hidden" name="table" value="organisation" />
                  <table class='table table-bordered' width='100%' cellspacing='0'>
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>OrganisationType</th>
                              <th>InterestsAndSectorAreas</th>
                              <th>PostCode</th>
                              <th>Region</th>
                              <th>Country</th>
                              <th>Twitter</th>
                              <th>SchoolLowerAge</th>
                              <th>SchoolHigherAge</th>
                              <th>SchoolURNSimilar</th>
                              <th>Notes</th>
                          </tr>
                      </thead>
                      <tbody></tbody>
                  </table>
                  <div class="form-row">
                      <div class="col-md-1">
                          </br><button type="submit"  class="btn btn-primary" data-toggle="modal" data-target="#save">
                              Save
                          </button>
                      </div>
                  </div>
             </form>
            </div>
             
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
    <!--<script src="js/sb-admin-datatables.min.js"></script>-->
    <!--<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>-->
    <!--<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
    <!--<script src="https://cdn.bootcss.com/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>-->
    <script src="js/csv/import/jquery.js"></script>
    <script src="js/csv/import/papaparse.js"></script>
    <script src="js/csv/import/jschardet.js"></script>
    <script src="js/csv/import/csv2arr.js"></script>
    <script>

        $("#con").hide();
        $("#org").hide();
        
        function csv(){
            var org = new Array(
              "name",
              "orgType",
              "interestSectorAreas",
              "postcode",
              "region",
              "country",
              "twitter",
              "schoolLowerAge",
              "schoolHigherAge",
              "schoolURN",
              "notes"
          );

          var con = new Array(
              "recordType",
              "recordStatus",
              "instruction",
              "fname",
              "lname",
              "title",
              "email",
              "jobtitle",
              "telephone",
              "telephone2",
              "mobile",
              "personType",
              "organisation",
              "departmentLevel1",
              "dapartmentLevel2",
              "postcode",
              "region",
              "country",
              "linkedln",
              "professionalInterest",
              "biographyText",
              "notes"
          );

          var con_box =  document.getElementById("con_box").checked;
          var org_box = document.getElementById("org_box").checked;
          console.log(con_box, org_box);

          if (!con_box && !org_box) {
             alert("please select one table to upload!");
             return;
          }
          if (con_box && org_box) {
            alert("only one table select to upload!");
            return;
          }
          var idStr='';
          var name={};
          if (con_box) {
            idStr='con';
            name=con;
          }
          if (org_box) {
            idStr='org';
            name=org;
          }
          $("input[name=csv_file]").csv2arr(function(arr){
                var tblStr = "";
                var tblStr2 = "";
                $.each(arr, function(i, line){
                    console.log(line);
                    tblStr += "<tr id='fd'>";
                    if(i==0){
                        $.each(line, function(j, cell){
                            tblStr += "<td width='100%'><input type='hidden' name="+name[j]+"[]' value="+cell+ "></td>";
                        });
                        tblStr += "</tr>";
                    }
                    tblStr2 += "<tr>";
                    if((i>=1) && (i<11)){
                        $.each(line, function(j, cell){
                            tblStr2 += "<td width='100%'><input type='text' name="+name[j]+"[]' value="+cell+ "></td>";
                        });
                        tblStr2 += "</tr>";
                    }
                });
                $("#"+idStr+" table tbody").append(tblStr);
                $("#"+idStr+" table tbody").append(tblStr2);
                $("#"+idStr).show();
                var fd = document.getElementById("fd");
                fd.style.display = 'none';
         });
      }
    </script>
  </div>
</body>

</html>
