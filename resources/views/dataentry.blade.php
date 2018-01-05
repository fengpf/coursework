<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Grodata Solutions</title>
  <!-- Latest compiled and minified CSS -->
  
  <!-- Bootstrap core CSS-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/chosen.css" rel="stylesheet" >
  <link href="css/combo.select.css" rel="stylesheet" >
  
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
                <a class="nav-link active" href="/dataentry">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/organisation">Organisation</a>
            </li>
        </ul>

    <form action="<?php echo url('/'); ?>/add_contact" method="post">
        <?php echo method_field('POST'); ?>
        <?php echo csrf_field(); ?>

        @if(Session::has('message'))                                            
        <div class="alert alert-success">                                          
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{Session::get('message')}}
        </div>  
        @endif

        <div class="card-body container" id="needs-validation" novalidate>
          <div class="table-responsive">
              
              <div class="form-row">
              <div class="col-sm-6">
                  <label>Record type</label>
                  <select name="recordType" class=" form-control form-control-sm"  >
                      <option value="generic">Generic</option>
                      <option value="work">Work</option>
                      <option value="personal">Personal</option>
                  </select>
              </div>
              
              <div class="col-sm-6">
                  <label >Record status</label>
                  <select name="recordStatus" aria-controls="dataTable" class="chosen-select form-control form-control-sm" multiple >
                      <option value="deceased">Deceased</option>
                      <option value="left-retired">Left-Retired</option>
                      <option value="left-other">Left-Other</option>
                      <option value="delete-requested removal">Delete-Requested Removal</option>
                      <option value="delete-other">Delete-Other</option>
                      <option value="delete-other">IT Person</option>
                      </select>
              </div>
            </div>
              <div class="form-row">
                  <div class="col-sm-6">
                      <label for="Instruction"></br>Instruction</label>
                      <input name="instruction" class="form-control form-control-sm" id="instruction" type="text" >
                  </div>
                  <div class="col-sm-6">
                      <label for="InputName"></br>First name</label>
                      <input name="fname" class="form-control form-control-sm" id="firstname" type="text" >
                          </div>
                  <div class="col-sm-6">
                      <label for="InputLastName"></br>Last name</label>
                      <input name="lname" class="form-control form-control-sm" id="InputLastName" type="text" >
                          </div>
                  <div class="col-sm-6">
                              <label for="InputName"></br>Title</label>
                              <input name="title" class="form-control form-control-sm" id="InputTitle" type="text" >
                                  </div>
                  <div class="col-sm-6">
                      <label for="InputName"></br>Job title</label>
                      <input  name="jobtitle"  class="form-control form-control-sm" id="InputJobTitle" type="text" autocomplete="off" data-provide="typeahead" data-source='["teacher"]'>
                          </div>
                  <div class="col-sm-6">
                      <label for="InputName"></br>Email</label>
                      <input name="email"  class="form-control form-control-sm" id="InputEmail" type="text"  >
                          </div>
                  <div class="col-sm-6">
                      <label for="InputName"></br>Telephone</label>
                      <input name="telephone" class="form-control form-control-sm" id="InputName" type="text" >
                          </div>
                  <div class="col-sm-6">
                      <label for="InputName"></br>Telephone2</label>
                      <input name="telephone2" class="form-control form-control-sm" id="InputName" type="text"  >
                          </div>
                  <div class="col-sm-6">
                      <label for="InputName"></br>Mobile</label>
                      <input name="mobile" class="form-control form-control-sm" id="InputName" type="text" >
                  </div>
                  
        
                  <div class="col-sm-6">
                          <label for="InputName"></br>Person types</label>
                          <select name="personType" aria-controls="dataTable" class="form-control form-control-sm chosen-select" data-live-search="true" multiple>
                              <option value="academic - lecturer">Academic - Lecturer</option>
                              <option value="academic - researcher">Academic - Researcher</option>
                              <option value="academic - senior management">Academic - Senior Management</option>
                              <option value="account manager">Account Manager</option>
                              <option value="accountant">Accountant</option>
                              <option value="administration">Administration</option>
                              <option value="business/management consultant">Business/Management Consultant</option>
                              <option value="catering">Catering</option>
                              <option value="communications">Communications</option>
                              <option value="economist">Economist</option>
                              <option value="editor">Editor</option>
                              <option value="elected official - councillor">Elected Official - Councillor</option>
                              <option value="elected official - councillor - mayor">Elected Official - Councillor - Mayor</option>
                              <option value="elected official - directly elected mayor">Elected Official - Directly Elected Mayor</option>
                              <option value="elected official - MEP">Elected Official - MEP</option>
                              <option value="elected official - MP">Elected Official - MP</option>
                              <option value="elected official - police and crime commissioner">Elected Official - Police and Crime Commissioner</option>
                              <option value="engineer">Engineer</option>
                              <option value="facilities management">Facilities Management</option>
                              <option value="finance">Finance</option>
                              <option value="financial analyst">Financial Analyst</option>
                              <option value="firefighter">Firefighter</option>
                              <option value="health - allied health professional">Health - Allied Health Professional</option>
                              <option value="health - care worker (other)">Health - Care Worker (Other)</option>
                              <option value="health - medical doctor">Health - Medical Doctor</option>
                              <option value="health - nurse">Health - Nurse</option>
                              <option value="health and safety">Health and Safety</option>
                              <option value="human resources">Human Resources</option>
                              <option value="it/systems admin">IT/Systems Admin</option>
                              <option value="journalist">Journalist</option>
                              <option value="lawyer - barrister">Lawyer - Barrister</option>
                              <option value="lawyer - in house">Lawyer - In House</option>
                              <option value="lawyer - other">Lawyer - Other</option>
                              <option value="lawyer - solicitor">Lawyer - Solicitor</option>
                              <option value="lawyer - trade mark patent attorney">Lawyer - Trade Mark Patent Attorney</option>
                              <option value="public-local">Librarian</option>
                              <option value="public-local">Marketing</option>
                              <option value="other - legal">Other - Legal</option>
                              <option value="personal/executive assistant">Personal/Executive Assistant</option>
                              <option value="planning officer">Planning Officer</option>
                              <option value="police officer">Police Officer</option>
                              <option value="policy">Policy</option>
                              <option value="procurement officer">Procurement Officer</option>
                              <option value="property/building surveyor">Property/Building Surveyor</option>
                              <option value="public affairs">Public Affairs</option>
                              <option value="public relations">Public Relations</option>
                              <option value="sales">Sales</option>
                              <option value="scientist">Scientist</option>
                              <option value="secretary">Secretary</option>
                              <option value="senior management">Senior Management</option>
                              <option value="social worker(social services)">Social Worker(Social Services)</option>
                              <option value="teacher">Teacher</option>
                              <option value="technician">Technician</option>
                          </select>
                </div>

                  
                <div class="col-sm-6">
                      <label for="org_search"></br>Organisation</label>
                      <input id="org_search" class="form-control form-control-sm" type="text" data-provide="typeahead">
                </div>
                <div class="col-sm-6">
                      <label for="InputName"></br>Department Level 1</label>
                      <input name="departmentLevel1" class="form-control form-control-sm" id="InputName" type="text"  >
                 </div>
                <div class="col-sm-6">
                      <label for="InputName"></br>Department Level 2</label>
                      <input name="departmentLevel2"  class="form-control form-control-sm" id="InputName" type="text" >
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
                      <!-- 
                      <select name="region" aria-controls="dataTable" class="form-control form-control-sm">
                          <option value="east of england">England</option>
                          <option value="east midlands">East Midlands</option>
                          <option value="london">London</option>
                          <option value="norht west">Norht West</option>
                          <option value="north east">North East</option>
                          <option value="northern ireland">Northern Ireland</option>
                          <option value="scotland">Scotland</option>
                          <option value="south east">South East</option>
                          <option value="south west">South West</option>
                          <option value="wales - north">Wales - North</option>
                          <option value="wales - south">Wales - South</option>
                          <option value="west midlands">West Midlands</option>
                          <option value="yorkshire and the humber">Yorkshire and the Humber</option>
                          <option value="other">Other</option>
                      </select>  -->
                    </div>
                  <div class="col-sm-4">
                      <label for="InputName"></br>Country</label>
                          <input name="country" type="text" id="country" class="form-control form-control-sm" value="" />
                     <!--  <input ame="country" type="text" id="country" class="form-control form-control-sm" autocomplete="off" data-provide="typeahead" data-source='["Afghanistan","Albania","Algeria","Andorra","Angola","Antigua and Barbuda","Argentina","Armenia","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana","Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cabo Verde","Cambodia","Cameroon","Canada","Central African Republic (CAR)","Chad","Chile","China","Colombia","Comoros","Democratic Republic of the Congo","Republic of the Congo","Costa Rica","Cote d‘Ivoire",
                          "Croatia","Cuba","Cyprus","Czech Republic","Denmark", "Djibouti", "Dominica","Dominican Republic","Ecuador","Egypt","El Salvador",
                          "Equatorial Guinea","Eritrea","Estonia","Ethiopia","Fiji","Finland",
                          "France","Gabon","Gambia","Georgia","Germany","Ghana","Greece","Grenada",
                          "Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras",
                          "Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel",
                          "Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo",
                          "Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya",
                          "Liechtenstein","Lithuania","Luxembourg","Macedonia (FYROM)","Madagascar",
                          "Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova",
                          "Monaco","Mongolia","Montenegro","Morocco","Mozambique",
                          "Myanmar (Burma)","Namibia","Nauru","Nepal","Netherlands","New Zealand",
                          "Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan",
                          "Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia","Rwanda",
                          "Saint Kitts and Nevis","Saint Lucia","Saint Vincent and the Grenadines",
                          "Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal",
                          "Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia",
                          "Solomon Islands","Somalia","South Africa","South Korea","South Sudan",
                          "Spain","Sri Lanka","Sudan","Suriname","Swaziland","Sweden","Switzerland",
                          "Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor-Leste","Togo",
                          "Tonga","Trinidad and Tobago","Tunisia","Turkey", "Turkmenistan","Tuvalu",
                          "Uganda","Ukraine","United Arab Emirates (UAE)","United Kingdom (UK)",
                          "United States of America (USA)","Uruguay","Uzbekistan","Vanuatu",
                          "Vatican City (Holy See)","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe"]'>
                       -->
                  </div>
              </div>
              
              
              <div class="form-row" >
                  <div class="col-sm-6">
                      <label for="InputName"></br>Social account</label>
                      <input name="linkedIn" class="form-control form-control-sm" id="InputName" type="text" >
                          </div>
                  
                  <div class="col-sm-6">
                      <label for="InputName"></br>Professional interests</label>
                      <input name="professionalInterest" class="form-control form-control-sm" id="InputName" type="text" >
                          </div>

                <div class="col-sm-6">
                            <label for="InputName"></br>Biography text</label>
                            <input name="biographyText" class="form-control form-control-sm" id="InputName" type="text"  >
                                </div>
                <div class="col-sm-6">
                    <label for="notes"></br>Notes</label>
                    <input name="notes" class="form-control form-control-sm" id="notes" type="text" >
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                </div>

                </div>
            </div>
              </br>
          <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
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


    
    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="/js/chosen.jquery.js"></script>
    <script src="js/jquery.combo.select.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
     <!--<script src="js/sb-admin.min.js"></script>-->
    <!-- Custom scripts for this page-->
    <!--<script src="js/sb-admin-datatables.min.js"></script>-->
   <script src="js/bootstrap3-typeahead.js"></script>
    <script>
        $('.chosen-select').chosen();
    </script>

    <script>
        $(document).ready(function($) {
            $.fn.typeahead.Constructor.prototype.blur = function() {
                var that = this;
                setTimeout(function () { that.hide() }, 250);
            };
            $('#org_search-test').typeahead({
                source: [
                  {id: "someId1", name: "Display name 1"},
                  {id: "someId2", name: "Display name 2"}
                ],
                autoSelect: true
            });
       })
   </script>
    <script>
     // match region country.
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
            error:function(){
                console.log("request postcodes.io timeout over 5s");
            }
         });
      });

      $(document).ready(function($) {
        // Workaround for bug in mouse item selection
        $.fn.typeahead.Constructor.prototype.blur = function() {
           var that = this;
           setTimeout(function () { that.hide() }, 250);
        };
      
        console.log(1111111111)
        $('#org_search').typeahead({
            source: function (query, process) {
                $.ajax({
                    type: "GET",
                    url: "<?php echo url('/'); ?>/match_org_name",
                    data: {name:query},
                    dataType: "json",
                    timeout : 1000,
                    success: function(data){
                        console.log(data);
                        if (data.code == 0 && data.data.length != 0) {
                           return process(data.data);
                        }
                        window.location.href="<?php echo url('/'); ?>/organisation"; 
                    },
                    error:function() {
                       console.log("request error");
                    }
                });
            }
        });
     })

     

    </script>
  </div>
  </div>
</body>

</html>
