<?php 
	echo validation_errors();
	if ($this->session->flashdata('add_supervisor')){
		echo '<p>'.$this->session->flashdata('add_supervisor').'</p>';
	}
?>
<?php echo form_open('supervisors/addSupervisor'); ?>
	
	<div class='form-group'>
		<input type='text' name='username' class='form-control' placeholder='Enter Trainee ID' required autofocus>
	</div>
	<br>
	<button type='submit' class='btn btn-primary'>Add Supervisor</button>

<?php echo form_close(); ?>
<a href='logout'>Logout</a><br>
