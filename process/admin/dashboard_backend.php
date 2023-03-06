<?php 

include '../conn.php';

$method = $_POST['method'];


if ($method == 'load_emp') {
	$emp_id = $_POST['emp_id'];
	$emp_name = $_POST['emp_name'];
	$c = 0;

	$query = "SELECT * FROM employee WHERE id_no LIKE '%$emp_id%' AND full_name LIKE '%$emp_name%'";
	$sec = $conn->prepare($query);
	$sec->execute();
	if ($sec->rowCount() > 0) {
		foreach ($sec->fetchALL() as $x) {
			$c++;

			echo '<tr style="cursor:pointer;" class="modal-trigger" data-toggle="modal" data-target="#modal_emp" onclick="details(&quot;'.$x['id'].'~!~'.$x['id_no'].'~!~'.$x['full_name'].'~!~'.$x['department'].'~!~'.$x['remaining_leave'].'~!~'.$x['status'].'&quot;)">';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['id_no'].'</td>';
				echo '<td>'.$x['full_name'].'</td>';
				echo '<td>'.$x['department'].'</td>';
				echo '<td>'.$x['date_hired'].'</td>';
				echo '<td>'.$x['remaining_leave'].'</td>';
				echo '<td>'.$x['status'].'</td>';
			echo '<tr>';
		}
	}else{
		echo '<tr>';
			echo '<td colspan = "11" style="color:red;">No Results!</td>';
		echo '<tr>';
	}
}


if ($method == 'insert_leave_whole') {
	$id_no = $_POST['id_no'];
	$full_name = $_POST['full_name'];
	$remaining_leave = $_POST['remaining_leave'];
	$datefrom = $_POST['datefrom'];
	$dateto = $_POST['dateto'];
	$reason = $_POST['reason'];

	$update = "UPDATE employee SET status = 'On Leave(Whole)' WHERE full_name = '$full_name'";
	$sec = $conn->prepare($update);
	if ($sec->execute()) {
		$insert = "INSERT INTO whole_day (`id_no`,`full_name`,`datefrom`,`dateto`,`reason`) VALUES ('$id_no','$full_name','$datefrom','$dateto','reason')";
		$swc = $conn->prepare($insert);
		if ($swc->execute()) {

				
		$start = new DateTime($datefrom);
		$end = new DateTime($dateto);
		// otherwise the  end date is excluded (bug?)
		$end->modify('+1 day');

		$interval = $end->diff($start);

		// total days
		$days = $interval->days;

		// create an iterateable period of date (P1D equates to 1 day)
		$period = new DatePeriod($start, new DateInterval('P1D'), $end);

		foreach($period as $dt) {
		    $curr = $dt->format('D');

		    // substract if Saturday or Sunday
		    if ($curr == 'Sat' || $curr == 'Sun') {
		        $days--;
		    }

		    // (optional) for the updated question
		    elseif ($dt->format('D')) {
		        $days;
		    }
		}


		$days;

		if ($day > 2) {
			echo ''
		}

		$sub = "UPDATE employee SET remaining_leave - $days WHERE id_no = '$id_no' AND full_name = '$full_name'";
		$stmt = $conn->prepare($sub);
		if ($stmt->execute()) {
			
		}




		}else{
			$count = $count + 1;
		}
	}else{
		$count = $count + 1;
	}
}




$conn = NUll;


24/48


?>