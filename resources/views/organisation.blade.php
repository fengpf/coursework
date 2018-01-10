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
  <link href="css/chosen.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
 @extends('header')
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Data Entry</div>
        
        
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="/dataentry">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/organisation">Organisation</a>
            </li>
        </ul>

      <form action="<?php echo url('/'); ?>/add_organisation" method="post">
       <?php echo method_field('POST'); ?>
        <?php echo csrf_field(); ?>

        @if(Session::has('message'))                                            
        <div class="alert alert-success">                                          
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('message')}}
        </div>  
        @endif

        <div class="card-body">
          <div class="table-responsive">
              <div class="form-row">
                  <div class="col-sm-6">
                      <label for="InputName"></br>Name</label>
                      <input name="name" class="form-control form-control-sm" id="InputName" type="text" aria-describedby="nameHelp" >
                 </div>
              </div>
              <div class="form-row">
                  <div class="col-sm-6">
                      <label for="InputName"></br>Category</label>
                      <select name="category" aria-controls="dataTable" class="form-control form-control-sm chosen-select" multiple>
                          <option>1</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                          <option>6</option>
                          <option>7</option>
                      </select>
                 </div>
              </div>
              <div class="form-row">
              <div class="col-sm-6">
                  <label ></br>Organisation type</label>
                  <select name="orgType" aria-controls="dataTable" class="form-control form-control-sm">
                      <option value="banks">Banks</option>
                      <option value="central government">Central Government</option>
                      <option value="charity/voluntary(philanthropic)">Charity/Voluntary(Philanthropic)</option>
                      <option value="courts of justice">Courts of Justice</option>
                      <option value="education-FE college">Education-FE College</option>
                      <option value="education-school">Education-School</option>
                      <option value="education-university">Education-University</option>
                      <option value="embassies and high commissions">Embassies and High Commissions</option>
                      <option value="fire service">Fire Service</option>
                      <option value="learned societies/worshipful guilds">Learned Societies/Worshipful Guilds</option>
                      <option value="local government">Local Government</option>
                      <option value="NHS body">NHS Body</option>
                      <option value="non education research institute">Non Education Research Institute</option>
                      <option value="other nonprofit">Other Nonprofit</option>
                      <option value="police">Police</option>
                      <option value="prisons">Prisons</option>
                      <option value="private(for profit)">Private(For Profit)</option>
                      <option value="probation and offender management">Probation and Offender Management</option>
                      <option value="regulator">Regulator</option>
                      <option value="social housing(associations)">Social Housing(Associations)</option>
                      <option value="trade association">Trade Association</option>
                      <option value="trade union">Trade Union</option>
                      <option value="utility company">Utility Company</option>
                  </select>
              </div>
              
          </div>

            <div class="form-row">
                <div class="col-sm-6">
                    <label for="InputName"></br>Interests and Sector Areas</label>
                    <input name="interestSectorAreas" class="form-control form-control-sm" id="InputName" type="text" aria-describedby="nameHelp" >
                </div>
            </div>
              
            <div class="form-row">
                  <div class="col-sm-4">
                      <label for="InputName"></br>Post Code</label>
                      <input name="postcode" class="form-control form-control-sm" id="postcode" type="text" />
                  </div>
                  <div class="col-sm-4">
                      <label ></br>Region</label>
                      <input name="region" class="form-control form-control-sm" id="region" type="text" value="" />
                  </div>
              
                 <div class="col-sm-4">
                      <label for="InputName"></br>Country</label>
                      <input name="country" type="text" id="country" class="form-control form-control-sm" value="" />
                 </div>
            </div>

            <div class="form-row">
                <div class="col-sm-6">
                    <label for="InputName"></br>Twitter</label>
                    <input name="twitter" class="form-control form-control-sm" id="InputName" type="text" aria-describedby="nameHelp" >
                </div>
            </div>
            <div class="form-row">
                  <div class="col-sm-6">
                      <label for="InputName"></br>School Lower Age</label>
                      <input name="schoolLowerAge" class="form-control form-control-sm" id="InputName" type="text" aria-describedby="nameHelp" >
                  </div>
            </div>

            <div class="form-row">
                  <div class="col-sm-6">
                      <label for="InputName"></br>School Higher Age</label>
                      <input name="schoolHigherAge"  class="form-control form-control-sm" id="InputName" type="text" aria-describedby="nameHelp" >
                   </div>
            </div>

            <div class="form-row">
                  <div class="col-sm-6">
                      <label for="InputName"></br>School URN or Similar</label>
                      <input name="schoolURN"  class="form-control form-control-sm" id="InputName" type="text" aria-describedby="nameHelp" >
                          </div>
              </div>

              <div class="form-row">
                  <div class="col-sm-6">
                      <label for="InputName"></br>Notes</label>
                      <input name="notes" class="form-control form-control-sm" id="InputName" type="text" aria-describedby="nameHelp">
                          </div>
                  </div>
              
              </div>
              </br>
             <button type="submit" class="btn btn-primary">
                Submit
             </button>
          
          <!-- Modal -->
          <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-body">
                          Submitted Successfully
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" data-dismiss="modal">Back</button>
                  </div>
              </div>
          </div>
          </div>
        </div>
      </form>
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
    
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="js/chosen.jquery.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <!-- <script src="js/sb-admin.min.js"></script>-->
    <!-- Custom scripts for this page-->
    <!-- <script src="js/sb-admin-datatables.min.js"></script>-->
    <script src="https://cdn.bootcss.com/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script>
        $('.chosen-select').chosen();
    </script>
    <script>
      $("#postcode").change(function(){
        postcode=$("#postcode").val();
        if (postcode==""){
           console.log("postcode is empty");
           return false;
        }
        $.ajax({
             type: "GET",
             url: "<?php echo url('/'); ?>/postcode",
             data: {postcode:postcode},
             dataType: "json",
			 timeout : 5000,
             success: function(data){
                $('#region').empty();
                $('#country').empty();
                $("#region").attr("value", data.region)
                $("#country").attr("value", data.country)
            },
            fail:function(){
                console.log("request postcodes.io timeout over 5s");
            }
         });
     });
    </script>

  </div>
</body>

</html>
