<?php if(count($trainees)==0){
	echo 'No Trainees Available.';
} else {
	echo "<table><tr><th>Trainee_ID</th><th>Designation</th></tr>";
	foreach($trainees as $trainee): ?>
	<tr>
		<td><?php echo $trainee['username']; ?></td>
		<td><?php echo $trainee['designation']; ?></td>
	</tr>
<?php endforeach; } ?>
</table>
<a href='logout'>Logout</a><br>
