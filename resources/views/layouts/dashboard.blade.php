<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
                        <div class="col-sm-12 col-md-12 well" id="content">
                            <form class="form-horizontal" method="post">
                                @csrf
                              <div class="form-group">
                                <label for="inputValues" class="col-sm-2 control-label">Input Values</label>
                                <div class="col-sm-10">
                                  <input type="text" name="values" class="form-control" id="inputValues" placeholder="Input Values">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="searchValue" class="col-sm-2 control-label">Search Value</label>
                                <div class="col-sm-10">
                                  <input type="text" name="searchValue" class="form-control" id="searchValue" placeholder="Search Value">
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input id="formSubmit" type="submit" name="btn" class="btn btn-success" value="Khoj">
                                    <input type="reset" value="Reset" class="btn btn-primary">
                                </div>
                              </div>

                              
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                      <span style="font-size: 20px; font-weight: bold;">Result: </span> <span style="font-size: 20px;" id="showResult"></span>
                                    </div>
                                </div>
                              
                              
                            </form>
                            
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


    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
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
    }) 
    </script>
</body>
</html>