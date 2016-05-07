<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>Your Company Tweets</title>
    <!-- Latest compiled and minified CSS -->
    <style>
        #countdown{
            color: #1B232F;
            font-family: Verdana, Arial, sans-serif;
            font-size: 18px;
            font-weight: bold;
            text-decoration: none
    </style>
    <script>
        var limit="60"
        var doctitle = document.title
        function beginrefresh(){
            if (limit==1)
                window.location.reload()
            else{
                limit-=1;
                $('#countdown').text('00:00:'+limit);
                var curtime=limit+" seconds left until page refresh!"
                document.title = doctitle + ' (' + curtime +')'

                setTimeout("beginrefresh()",1000)
            }
        }

        if (window.addEventListener)
            window.addEventListener("load", beginrefresh, false)
        else if (window.attachEvent)
            window.attachEvent("load", beginrefresh)

        //-->
    </script>
</head>

<body>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:void(0)">Your Company</a>
            <span class="navbar-brand" id="countdown" style="color: white">00:00:60</span>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style=" float: right;">
            <form class="navbar-form" role="search">
                <div class="input-group">
                    <input type="text" class="form-control col-sm-12" value="<?php echo isset($_GET['q']) ? $_GET['q'] : '' ?>"
                           style="width: 500px" placeholder="Search" name="q">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <section class="content">
                <table class="table table-filter">
                    <tbody>
                    <?php
//                    error_reporting(E_ALL);
//                    ini_set("display_errors", 1);
                    include_once 'TwitterConnection.php';
                    include_once 'TwitterSearch.php';
                    $conObj = new TwitterConnection();
                    $con = $conObj->getConnectionInstance();

                    $tweetObj = new TwitterSearch($con);
                    if(isset($_GET['q'])) {
                        $tweetObj->setResultType('mixed');
                        $tweetObj->setSearchTerm($_GET['q']);
                    }
                    $tweets = $tweetObj->getResults();

                    foreach($tweets->statuses as $tweet){
                   ?>
                    <tr data-status="pagado">
                        <td>
                            <div class="media">
                                <a href="#" class="pull-left">
                                    <img src="<?php echo $tweet->user->profile_image_url; ?>" class="media-photo">
                                </a>
                                <div class="media-body">
                                    <span class="media-meta pull-right"><?php  echo date('H:i, M d', strtotime( $tweet->created_at )); ?></span>
                                    <h4 class="title">
                                        <?php echo $tweet->user->screen_name; ?>
                                    </h4>
                                    <p class="summary"><?php echo $tweet->text; ?></p>
                                </div>
<!--                                <img height="350px" src="--><?php //echo $tweet->media[0]->media_url;?><!--" alt="" style="width: 100%; top: -0px;">-->
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    //
                    //                    echo '<pre>';
                    //                    print_r($tweets);exit;
                    ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</div>
<div class="container">
    <hr>
    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Company 2016</p>
            </div>
        </div>
    </footer>
</div>

</div> <!-- /container -->
<!-- /.container -->
<!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
