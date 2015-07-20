<div class="content-page-inner">
					<div class="container-fluid">
						<ol class="breadcrumb"><li><a href="<?php echo site_url('admin'); ?>">
							Home</a></li>
							<li class="active"><?php echo $this->router->fetch_class();?></li>
						</ol>

						<div class="alert alert-warning fade in alert-dismissable">
							<div class="table-responsive" style="margin:5px;padding:5px" id="stack-personal">
							<?php
									echo "<p><strong>Maaf. Tidak ada data yang dapat ditampilkan saat ini.</strong></p>";
							?>
                            </div>
						</div><!-- /.the-box full -->
					</div><!-- /.container-fluid" -->
				</div><!-- /.content-page-inner -->
