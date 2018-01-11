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
      <!-- Breadcrumbs-->
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-book"></i> Search Results</div>

       <form action="<?php echo url('/'); ?>/csv" method="post" enctype="multipart/form-data">
       <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
       <input type="hidden" name="action" value="export" />
     
       @if(Session::has('message'))                                            
       <div class="alert alert-success">                                          
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
           {{Session::get('message')}}
       </div>  
       @endif
       <div class="card-body">
            @if(!empty($fieldArr))
            <label class="col-sm-2">
                    QueryCondition
           </label></br>
            <div class="table-responsive">
                    <table class="table table-bordered" id="search-condition" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>QueryMethod</th>
                          <th>QueryField</th>
                          <th>SearchName</th>
                          <th>Event</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php foreach($fieldArr as $f) { ?>
                                <tr>
                                    <td>
                                       <?php echo "select"; ?>
                                    </td>
                                    <td>
                                        <?php echo $f['key']; ?>
                                    </td>
                                    <td>
                                            Entry[<?php echo $f['entry']; ?>]</br>
                                            No Entry[<?php echo $f['noentry']; ?>]
                                     </td>
                                     <td>
                                            <?php echo $f['condition']; ?>
                                     </td>
                                </tr>
                            <?php } ?>
                    </tbody>
                    </table>
            </div>
            <div class="form-row">
                    <div class="col-md-6">
                        </br><button onclick="exportCSV()" type="button" class="btn btn-primary" role="button">Export</a>
                    </div>
            </div></br>
            @endif

            @if(!empty($results))
            <label class="col-sm-2">
                    Contact
           </label></br>
            <div class="table-responsive">
                <table class="table table-bordered" id="search-contact" width="100%" cellspacing="0">
                <thead>
                        <tr>
                                <th>ID</th>
                                <th>RecordType</th>
                                <th>RecordStatus</th>
                                <th>Instruction</th>
                                <th>FirstName</th>
                                <th>LastName</th>
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
                                <th>ProfessionalInterest</th>
                                <th>BiographyText</th>
                                <th>Notes</th>
                                <th>Action</th>
                        </tr>
                </thead>

                <tbody>
                      <?php foreach($results as $res) { ?>
                          <tr>
                              <td><?php echo $res->id; ?></td>
                              <td><?php echo $res->recordType; ?></td>
                              <td><?php echo $res->recordStatus; ?></td>
                              <td><?php echo $res->instruction; ?></td>
                              <td><?php echo $res->fname; ?></td>
                              <td><?php echo $res->lname; ?></td>
                              <td><?php echo $res->title; ?></td>
                              <td><?php echo $res->email; ?></td>
                              <td><?php echo $res->jobtitle; ?></td>
                              <td><?php echo $res->telephone; ?></td>
                              <td><?php echo $res->telephone2; ?></td>
                              <td><?php echo $res->mobile; ?></td>
                           
                              <td><?php echo $res->personType; ?></td>
                              <td><?php echo $res->organisation; ?></td>
                              <td><?php echo $res->departmentLevel1; ?></td>
                              <td><?php echo $res->dapartmentLevel2; ?></td>
                              <td><?php echo $res->postcode; ?></td>
                              <td><?php echo $res->region; ?></td>
                              <td><?php echo $res->country; ?></td>

                              <td><?php echo $res->linkedln; ?></td>
                              <td><?php echo $res->professionalInterest; ?></td>
                              <td><?php echo $res->biographyText; ?></td>
                              <td><?php echo $res->notes; ?></td>
                              <td>
                                  <a id="edit" href="/edit_contact?id=<?php echo $res->id; ?>&fieldStr={{$fieldStr}}" />
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                  <a id="delete" href="/delete_contact?id=<?php echo $res->id; ?>&fieldStr={{$fieldStr}}" />
                                      <i class="fa fa-trash-o offset-md-3" aria-hidden="true"></i></a>
                                  <!-- Modal -->
                                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                              <div class="modal-footer">
                                                  <input type="hidden" id="token" name="_token" value="<?php echo csrf_token(); ?>" >
                                                  <input type="hidden" id="del_id" value="<?php echo $res->id;?>" >
                                                  <button onclick="del_contact()" type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
                                                  <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </td>
                            </tr>
                          <?php } ?>
                      </tbody>
                </table>
            </div>
            <div class="form-row">
                    <div class="col-md-6">
                        <button onclick="exportCSV2()" type="button" class="btn btn-primary" role="button">Export</a>
                    </div>
            </div></br>
           {{ $results->appends(['fieldStr' =>$fieldStr])->links() }}
            @endif

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
    <script type="text/javascript" src="js/csv/tableExport.js"></script>
     <script>
      function exportCSV() {
        $('#search-condition').tableExport({type:'csv'});
      }

      function exportCSV2() {
        $('#search-contact').tableExport({type:'csv'});
      }
     </script>
  </div>
</body>

</html>
