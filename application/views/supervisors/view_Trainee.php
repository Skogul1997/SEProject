<?php if(count($trainees)==0){
	echo 'No Trainees Available.';
} else { foreach($trainees as $trainee): ?>
	<div>
		<?php echo $trainee['username']; ?>
		<br>
		<?php echo $trainee['designation']; ?>
		<br>
	</div>
<?php endforeach; } ?>