<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/img/stmik.png">
        <title>Login | SimonTA</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url();?>assets/css/login.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Silahkan Login</div>
            <form action="<?php echo site_url('admin/login/check');?>" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" value="">
                        <span><?php echo form_error('username'); ?></span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" value=""/>
                        <span><?php echo form_error('password'); ?></span>
                    </div>          
                    
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block btn-flat">Login</button>  
                    
                </div>
            </form>

           
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>