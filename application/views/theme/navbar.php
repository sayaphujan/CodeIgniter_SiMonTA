<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <?php
				echo"
					<a data-scroll class='navbar-brand' href='#top'>
						<b>SiMonTA</b>
					</a>
				";
			?>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

			<?php $result = $this->m_menu->general_menu();

			  		$data['list'] = $result->result();

			  		echo menu($data,'nav navbar-nav');
			?>

			  <ul class="nav navbar-nav navbar-right">

			<!-- not login -->
			
			  	<li class="dropdown">
				  <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown" id="login-a">Login <b class="caret"></b></a>
				  <ul class="dropdown-menu square primary no-border margin-list-rounded with-triangle" style="width:300px">
					<form role="form" method="POST" action="<?=site_url('beranda/login');?>" id="form-login">
						<div class="form-group sign-in">
							<label>Username</label>
							<input type="text" class="form-control" placeholder="username" name="username" style="border:1px solid #ddd">	
							<span id="err-user"></span>
						</div>
						<div class="form-group sign-in">
							<label>Password</label>
							<input type="password" class="form-control" placeholder="password" name="password" style="border:1px solid #ddd">
							<span id="err-pass"></span>
						</div>
						<div class="form-group sign-in" style="padding-right:0px">
						<button class="btn btn-primary btn-square" type="submit">login</button>
						</div>
			  		</form>
					
				  </ul>
			  </ul>
			  
			</div><!-- /.navbar-collapse -->