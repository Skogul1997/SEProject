<?php if(count($trainings)==0){
	echo 'No Trainees Available.';
} else 		{foreach($trainings as $training):
				echo $training['trainee_id'].' '.$training['status'].' ';
				if($training['status']!='In-Training'){
					echo "<a href=''><button type='button'>Train</button></a>";
				} else {
					echo "<a href=''><button type='button' disabled>Train</button></a>";
				}
			endforeach; } ?>
<a href='logout'>Logout</a><br>
