<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <!-- Description, Keywords and Author -->
    <meta name="description" content="Your description">
    <meta name="keywords" content="Your,Keywords">
    <meta name="author" content="ResponsiveWebInc">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font awesome CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">


    <!-- Main CSS -->
    <link href="css/style-150.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="#">
</head>

<body>
    <!-- UI # -->
    <div class="ui-150">
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    
                    <!-- Login Form -->
                    <div class="ui-form">
                        <h3 class="text-center">Sign In</h3>
                        <form role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}

                            <!-- Email -->
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <!-- Password -->
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" laceholder="Enter Password">

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                            <!-- Button -->
                            <button type="submit" class="btn btn-block">Sign In</button> 
                        </form>
                        <!-- 
                            <div class="text-center white">OR</div>
                            <h3 class="text-center">Sign In Using</h3>
                            <div class="social">
                                <a href="#" class="facebook"><i class="fa fa-facebook"></i> &nbsp; Login with Facebook</a>
                                <a href="#" class="twitter"><i class="fa fa-twitter"></i> &nbsp; Login with Twitter</a>
                                <a href="#" class="google-plus"><i class="fa fa-google-plus"></i> &nbsp; Login with Google Plus</a>
                            </div>
                        -->                     
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- Javascript files -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Placeholder JS -->
    <script src="js/placeholder.js"></script>
    <!-- Respond JS for IE8 -->
    <script src="js/respond.min.js"></script>
    <!-- HTML5 Support for IE -->
    <script src="js/html5shiv.js"></script>
</body> 
</html>