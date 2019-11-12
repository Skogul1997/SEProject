<?php 
	echo validation_errors();
	if ($this->session->flashdata('add_trainee')){
		echo '<p>'.$this->session->flashdata('add_trainee').'</p>';
	}
?>
<?php echo form_open('supervisors/addTrainee'); ?>
	
	<div class='form-group'>
		<input type='text' name='username' class='form-control' placeholder='Enter Trainee ID' required autofocus>
	</div>
	<br>
	<div class='form-group'>
		<input type='text' name='designation' class='form-control' placeholder='Enter Designation' required autofocus>
	</div>
	<br>
	<button type='submit' class='btn btn-primary'>Add Trainee</button>

<?php echo form_close(); ?>

<a href='logout'>Logout</a><br>
