<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Grodata Solutions</title>
  <link href="css/bootstrap-select.css" rel="stylesheet">
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
      <div class="card mb-3" >
        <div class="card-header">
          <i class="fa fa-file"></i> Data Search</div>
          <div class="card-body">
            <div class="table-responsive">
                <div class="form-row col-md-12">
                    <label class="col-md-2 ">
                        <h6>Field</h6>
                    </label>
                    <label class="col-md-1">
                        <h6>User</h6>
                    </label>
                    <label class="col-md-2 offset-md-1">
                        <h6>Entry</h6>
                    </label>
                    <lable class="col-md-2 offset-md-1 ">
                        <h6>Not Entry</h6>
                    </label>
                </div>
                
                <div class="form-row" id="fname">
                    <label class="col-sm-2">
                        </br></br>First Name
                    </label>
                    <label class="text-center col-sm-1">
                        </br></br><input type="checkbox" name="blankCheckbox" value="fname">
                    </label>
                    <div class="col-sm-3 offset-sm-1">
                    </br></br><input  name="entry" class="form-control form-control-sm col-sm-12 offset-sm-3">
                    </div>
                    <div class="col-sm-2 offset-sm-1 text-center">
                        </br></br><input name="noentry"  class="form-control form-control-sm col-sm-12 offset-sm-2">
                    </div>
                    <div class="col-sm-2 text-center">
                        </br></br>
                        <select name="condition" aria-controls="dataTable">
                            <option value="exact">exact</option>
                            <option value="like">like</option>
                            <option value="not">not</option>
                        </select>
                    </div>
                </div>
                <div class="form-row" id="lname">
                    <label class="col-sm-2">
                        </br>Last Name
                    </label>
                    <label class=" text-center col-sm-1">
                        </br><input type="checkbox" name="blankCheckbox" value="lname">
                    </label>
                    <div class="col-sm-3 offset-sm-1">
                        </br><input  name="entry" class="form-control form-control-sm col-sm-12 offset-sm-3">
                    </div>
                    <div class="col-sm-2 offset-sm-1">
                        </br><input name="noentry" class="form-control form-control-sm col-sm-12 offset-sm-2">
                    </div>
                    <div class="col-sm-2 text-center">
                        </br><select name="condition"  aria-controls="dataTable">
                            <option value="exact">exact</option>
                            <option value="like">like</option>
                            <option value="not">not</option>
                        </select>
                    </div>
                </div>
              
                <div class="form-row" id="email">
                    <label class="col-sm-2">
                        </br>Email
                    </label>
                    <label class=" text-center col-sm-1">
                        </br><input class="form-check-input position-static" type="checkbox" name="blankCheckbox" value="email">
                    </label>
                    <div class="col-sm-3 offset-sm-1">
                        </br><input  name="entry" class="form-control form-control-sm col-sm-12 offset-sm-3">
                            </div>
                    <div class="col-sm-2 offset-sm-1">
                        </br><input  name="noentry" class="form-control form-control-sm col-sm-12 offset-sm-2">
                            </div>
                    <div class="col-sm-2  text-center">
                        </br><select name="condition" aria-controls="dataTable">
                            <option value="exact">exact</option>
                            <option value="like">like</option>
                            <option value="not">not</option>
                        </select>
                    </div>
                </div>
              
            <br/><br/>

            <div class="form-row">
                <div class="col-md-6">
                    <button onclick="search()" type="button" class="btn btn-primary">Search</button>
                </div>
            </div><br/>
        </div>
      </div>
    </div>
    </div>
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
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
   <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="js/bootstrap-select.js"></script>
    <script src="js/chosen.jquery.js"></script>
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
    <script src="https://cdn.bootcss.com/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript" src="js/csv/tableExport.js"></script>
    <script>
        $('.chosen-select').chosen({width:"100%"} );
        $("#search-result").hide();
        $("#search-condition").hide();
        

        function csv() {
          $('#search-result').tableExport({type:'csv'});
          $('#search-condition').tableExport({type:'csv'});
        }

        function search() {
            var str = document.getElementsByName("blankCheckbox");
            var objarray = str.length;
            var checkStr = '';
            var fieldStr = '';
            var field = new Array();
            console.log("start");            
            for (i=0; i<objarray; i++) {
            　 if(str[i].checked == true)
            　 {
                  var key =  str[i].value;
                  var obj = new Object();
                  var list=document.getElementById(key).getElementsByTagName("input");
                  for(var j=0; j<list.length;j++)
                  {
                        if(list[j].name=="entry")   
                        {
                           obj.entry=list[j].value;
                        }
                        if(list[j].name=="noentry")   
                        {
                           obj.noentry=list[j].value;
                        }
                  }
                  var list2=document.getElementById(key).getElementsByTagName("select");
                  for(var k=0; k<list2.length;k++)
                  {
                        if(list2[k].name=="condition")   
                        {
                           obj.condition=list2[k].value;
                        }
                  }
                  obj.key=key;
                  field.push(obj);
                  checkStr += key+",";
            　 }
            }
            checkStr = checkStr.substr(0, checkStr.length-1)
            console.log(checkStr);
            if(checkStr == "") {
              console.log("请先选择复选框～！");
            } else {
            　 console.log(field);
               fieldStr = JSON.stringify(field)
            　 console.log(fieldStr);
            　 //alert(fieldStr);
            }

            window.location.href="<?php echo url('/'); ?>/search_admin?fieldStr=" + fieldStr + "&checkStr=" + checkStr; 


            $.ajax({
                type: "GET",
                url: "<?php echo url('/'); ?>/search_admin",
                data: {
                    fieldStr:fieldStr,
                    checkStr:checkStr,
                },
                dataType: "json",
                timeout : 1000,
                success: function(data){
                    console.log(data);
                    if (data.code == 0) {
                        var num = data.results.length;
                        //if ($('#recordType').attr('checked')) {
                    
                        for (var i = 0; i < num; i++) {
                            var tr = document.createElement("tr");
                            tr.innerHTML = ' <td>' + data.results[i].id + '</td>';
                            tr.innerHTML += ' <td>' + data.results[i].instruction + '</td>';
                            tr.innerHTML += ' <td>' + data.results[i].jobtitle + '</td>';
                            tr.innerHTML += ' <td>' + data.results[i].personType + '</td>';
                            tr.innerHTML += ' <td>' + data.results[i].professionalInterest + '</td>';
                            tr.innerHTML += ' <td>' + data.results[i].organisation + '</td>';
                            tr.innerHTML += ' <td>' + data.results[i].departmentLevel1 + '</td>';
                            tr.innerHTML += ' <td>' + data.results[i].dapartmentLevel2 + '</td>';
                            tr.innerHTML += ' <td>' + data.results[i].orgType + '</td>';
                            tr.innerHTML += ' <td>' + data.results[i].country + '</td>';
                            tr.innerHTML += ' <td>' + data.results[i].region + '</td>';
                            tr.innerHTML +=  ' <td>' + "<a id='edit' href='/edit_contact?id=" + data.results[i].id+ "'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></td>";
                            tr.innerHTML +=  ' <td>' + "<a id='delete' href='/delete_contact?id=" + data.results[i].id+ "'><i class='fa fa-trash-o offset-md-3' aria-hidden='true'></i></a></td>";
                            $('#search-result tbody').append(tr);
                        }
                        $("#search-result").show();
                        $("#search-condition").show();
                    }
                },
                error:function() {
                   console.log("search request error");
                }
            });
        }

        
    </script>
  </div>
</body>

</html>
