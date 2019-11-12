<?php if(count($trainings)==0){
	echo 'No Trainings Available.';
} else 		{foreach($trainings as $training):
				
				$trainee_id = $training['trainee_id'];
				if(($training['trainee_id']==($this->session->userdata('trainee_id'))) and ($training['status'])=='in_training'){
					echo "<a href=changeStatus?id="."initial training"."><button type='button'>Train</button></a>";
				} else {
					echo "<a href=''><button type='button' disabled>Train</button></a>";
				}
				echo "<br><br>";
			endforeach; } ?>
<br>
