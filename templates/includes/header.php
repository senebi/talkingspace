<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/starter-template/">

    <title>Welcome to TalkingSpace</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASE_URI; ?>templates/css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo BASE_URI; ?>templates/css/custom.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php echo BASE_URI; ?>templates/js/bootstrap.js"></script>
    <script src="<?php echo BASE_URI; ?>templates/js/ckeditor/ckeditor.js"></script>
    <?php
    //Check if title is set: if not, assign it
    if(!isset($title))
      $title=SITE_TITLE;
    ?>
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">TalkingSpace</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="index.php">Home</a></li>
            <?php if(!isLoggedIn()){ ?>
            <li><a href="register.php">Create an account</a></li>
            <?php }
              else{
            ?>
            <li><a href="create.php">Create topic</a></li>
            <?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="main-col">
                        <div class="block">
                            <h1 class="pull-left"><?php echo $title; ?></h1>
                            <h4 class="pull-right">A simple PHP forum engine</h4>
                            <div class="clearfix"></div>
                            <hr />
                            <?php
                              displayMessage();
                            ?>