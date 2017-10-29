<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}{{ (isset($page->title)) ? ' - '.$page->title : '' }}</title>

    <!-- Styles -->
    <link href="{{ asset('asset/css/color/blue-grey.css') }}" rel="stylesheet">
    @if( View::hasSection('page_styles') )
      @yield('page_styles')
    @endif

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> --}}

    <style type="text/css">
        /*html, body {
            font-family: 'Raleway', sans-serif;
        }*/
        * {
            border-radius: 0 !important;
        }
        .table-wrapper {
            overflow-x: scroll;
        }
        textarea {
            resize: vertical;
        }
        #sidebar .list-group-item {
            border: none;
        }
        select.form-control {
             width: 100%;
        }
        .nav-btn:hover {
    		background: transparent;
        }

        #login-dp {
		    min-width: 250px;
		    padding: 14px 14px 0;
		    overflow:hidden;
		    background-color:rgba(255,255,255,1);
		}
		#login-dp .help-block {
		    font-size:12px    
		}
		#login-dp .bottom {
		    background-color:rgba(255,255,255,1);
		    border-top:1px solid #ddd;
		    clear:both;
		    padding:14px;
		}
		#login-dp .social-buttons {
		    margin:12px 0    
		}
		#login-dp .social-buttons a {
		    width: 49%;
		}
		#login-dp .form-group {
		    margin-bottom: 10px;
		}
		.btn-fb {
		    color: #fff;
		    background-color:#3b5998;
		}
		.btn-fb:hover {
		    color: #fff;
		    background-color:#496ebc 
		}
		.btn-tw {
		    color: #fff;
		    background-color:#55acee;
		}
		.btn-tw:hover {
		    color: #fff;
		    background-color:#59b5fa;
		}
		@media(max-width:768px) {
		    #login-dp {
		        /*background-color: inherit;*/
		        /*color: #fff;*/
		    }
		    #login-dp .bottom {
		        /*background-color: inherit;*/
		        /*border-top:0 none;*/
		    }
		}
    </style>
</head>
<body style="background: #f7f7f7;">
	<div id="app">
        @include('shared.authnav')

    	@include('shared.sidebar')

        {{-- <div id="content" class="col-lg-9 col-md-9 col-sm-8 "> --}}
        {{-- <div id="content" class="col-lg-12 col-md-12 col-sm-12"> --}}
        <div class="col-lg-9 col-md-9 col-sm-8">
    		<div class="container-fluid">
    		   	<div class="clearfix"><br></div>
          		<div class="row">
     		      	@include('shared.alerts')
	          
	          	  	@yield('content')
             	</div>
        	</div>
      	</div>
    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('asset/js/app.js') }}"></script> --}}
    <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    @if( View::hasSection('page_scripts') )
        @yield('page_scripts')
    @endif
</body>
</html>
