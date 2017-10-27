<?php
class Html{
	public static function start($title){
		echo('

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>'.$title.'</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bower_components/eternicode/dist/css/bootstrap-datepicker3.css" rel="stylesheet">
    <!-- Jquery UI -->
    <link href="bower_components/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="css/styles.css" media="screen" rel="stylesheet">
    <link href="css/justified.css" media="screen" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

');

$ddd = new User();
if($ddd->isLoggedIn()){
echo '<div class="top">Welcome '. $ddd->activeRecord()->data()->first_name.'</div>'; 
}
	}

public static function end(){
echo('    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="bower_components/eternicode/dist/js/bootstrap-datepicker.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/timeago/moment.js"></script>
    <script src="bower_components/timeago/livestamp.js"></script>


    <!-- Custom Theme JavaScript -->
    <script type="text/javascript" src="dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/signup.js"></script>
  </body>

</html>

	');
}

}
?>