<?php if(count($trainings)==0){
	echo 'No Trainees Available.';
} else 		{foreach($trainings as $training):
				echo $training['trainee_id'].'<br>'.$training['status'].'<br>';
				$trainee_id = $training['trainee_id'];
				if($training['status']!='In-Training'){
					echo "<a href=changeStatus?id=".$trainee_id."><button type='button'>Train</button></a>";
				} else {
					echo "<a href=''><button type='button' disabled>Train</button></a>";
				}
				echo "<br><br>";
			endforeach; } ?>
<br>
<a href='logout'>Logout</a><br>
