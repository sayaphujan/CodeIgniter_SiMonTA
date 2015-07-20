<?php 

 	$level = $this->session->userdata('levelid');

 	$result = $this->m_menu->custom_menu($level);

	//$data['list'] = $result->result();

	foreach($result->result() as $aks){
?>
<div class="sidebar">
	<ul class="stacked-menu">
		<?php
			foreach($result->result() as $row): 
				echo "<li><a href='".site_url($row->menu_path)."'>$row->menu_description</a></li>";
			endforeach;
		?>
	</ul>
</div>
<?php } ?>