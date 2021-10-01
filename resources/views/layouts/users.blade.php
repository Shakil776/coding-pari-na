<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Users</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('style/css/dashboard.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
           <div id="throbber" style="display:none; min-height:120px;"></div>
        <div id="noty-holder"></div>
    <div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">
                <h4 style="color: #fff;">Ami Coding Pari Na</h4>
            </a>
            
        </div>

         <ul class="nav navbar-right top-nav">
            <li>
                <h4 style="color: #fff;">@if(Session::has('userName')) <i>Welcome &nbsp;{{ Session::get('userName') }}</i> @endif</h4>
            </li>            
        </ul>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
        
                <li>
                    <a href="{{ url('/') }}"><i class="fa fa-bar-chart-o"></i> Dashboard</a>
                </li>

                <li>
                    <a href="{{ route('all-users') }}"><i class="fa fa-user"></i>&nbsp; All Users</a>
                </li>

                <li>
                    <a href="#" onclick="document.getElementById('logoutFormId').submit();">
                        <i class="fa fa-fw fa-power-off"></i> Logout
                    </a>
                </li>
                <form action="{{ url('/logout') }}" method="POST" id="logoutFormId">
                    @csrf
                </form>
                
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="row" id="main" >
                        <div class="col-sm-12 col-md-12" id="content">
                            <table class="table table-bordered table-striped" id="data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
            </div><!-- /#wrapper -->
                </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function(){
            $('[data-toggle="tooltip"]').tooltip();
            $(".side-nav .collapse").on("hide.bs.collapse", function() {                   
            $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
        });

        $('.side-nav .collapse').on("show.bs.collapse", function() {                        
        $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");        
        });

        // search values
        // csrf token setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // get search value
        $(document).on("click", "#formSubmit", function(e){
            e.preventDefault();
            var values = $("#inputValues").val();
            var searchValue = $("#searchValue").val();

            if (values == "") {
                alert("Input Values field must be filled out");
                return false;
            }
            
            if (searchValue == "") {
                alert("Search Value field must be filled out");
                return false;
            }
            
            $.ajax({
                type: 'post',
                url: '/search-value',
                data: {input_values:values, searchValue:searchValue},
                success: function(resp){
                    $("#showResult").html(resp.result);
                },
                error: function(){
                    console.log("Error");
                }
            });
        });

        // delete data
        $(document).on("click", ".delete", function(e){
            e.preventDefault();
            var id = $(this).attr("id");
            
            $.ajax({
                type: 'post',
                url: '/delete-user',
                data: {id:id},
                success: function(resp){
                    console.log(resp);
                    $('#data-table').DataTable().ajax.reload();
                },
                error: function(){
                    console.log("Error");
                }
            });
        });
    }) 

        $(function () {
    
            var table = $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('all-users') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        
        });
    </script>
</body>
</html>