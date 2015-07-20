<?php 

 	$level 		= $this->session->userdata('levelid'); 	
	
	$user 		= $this->m_menu->sub_menu_user($level);
	
	$dosen 		= $this->m_menu->sub_menu_dosen($level);
	
	$akademik 	= $this->m_menu->sub_menu_akademik($level);
	
	$ta 		= $this->m_menu->sub_menu_ta($level);
	
	$admin 		= $this->m_menu->sub_menu_admin($level);	
	
?>
<!-- ADMIN -->
			<div class="sidebar">
				<ul class="stacked-menu">
<?php 
	if ($level == '2'){
?>				
					
						
						<?php
							foreach($user->result() as $row): 
							echo "<li><a href='".site_url($row->menu_path)."'>$row->menu_description</a></li>";
						endforeach;
						?>
						
						<?php
							foreach($akademik->result() as $row): 
							echo "<li><a href='".site_url($row->menu_path)."'>$row->menu_description</a></li>";
							endforeach;
						?>
						
					
<!--					
					<li><a href="#fakelink">Pembimbing<i class="fa fa-angle-down right-icon"></i></a>
						<ul>
						<?php
						/*	foreach($dosen->result() as $row): 
							echo "<li><a href='".site_url($row->menu_path)."'>$row->menu_description</a></li>";
							endforeach;*/
						?>
						</ul>
					</li>
					<li><a href="#fakelink">TA/Skripsi<i class="fa fa-angle-down right-icon"></i></a>
						<ul>
						<?php/*
							foreach($ta->result() as $row): 
							echo "<li><a href='".site_url($row->menu_path)."'>$row->menu_description</a></li>";
							endforeach;*/
						?>
						</ul>
					</li>-->
					
						
						<?php
							foreach($admin->result() as $row): 
							echo "<li><a href='".site_url($row->menu_path)."'>$row->menu_description</a></li>";
							endforeach;
						?>
						
					
<?php }?>
<!-- PRODI -->
<?php 
	if ($level == '3'){
?>				
					
						
						<?php
							foreach($dosen->result() as $row): 
							echo "<li><a href='".site_url($row->menu_path)."'>$row->menu_description</a></li>";
							endforeach;
						?>
						
						<?php
							foreach($ta->result() as $row): 
							echo "<li><a href='".site_url($row->menu_path)."'>$row->menu_description</a></li>";
							endforeach;
						?>
						
					
<?php }?>
				</ul>
			</div>
		<script>
			$(document).ready(function(){
				
				/** BUTTON SHOW / HIDDEN SIDEBAR **/
				$(".btn-sidebar-collapse").click(function(){
					$(".sidebar").toggleClass("collapse-sidebar");
					$(".content-page").toggleClass("collapse-content");
				});
				
				
				/** NICE SCROLL FUNCTION FOR SIDEBAR MENU **/
				if ($(window).width() > 767) {
					$(".sidebar").addClass("sidebar-nicescroller");
				}
				else {
					$(".sidebar").removeClass("sidebar-nicescroller");
				}
				
				$(".sidebar-nicescroller").niceScroll({
					cursorcolor: "#000",
					cursorborder: "0px solid #fff",
					cursorborderradius: "0px",
					cursorwidth: "5px"
				});
				$(".sidebar-nicescroller").getNiceScroll().resize();
				
				
				/** SIDEBAR MENU **/
				$('.sidebar ul.stacked-menu li a').click(function() {
					$('.sidebar li').removeClass('active');
					$(this).closest('li').addClass('active');	
					var checkElement = $(this).next();
						if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
							$(this).closest('li').removeClass('active');
							checkElement.slideUp('fast');
						}
						if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
							$('.sidebar ul.stacked-menu ul:visible').slideUp('fast');
							checkElement.slideDown('fast');
						}
						if($(this).closest('li').find('ul').children().length == 0) {
							return true;
							} else {
							return false;	
						}		
				});
			});
		</script>