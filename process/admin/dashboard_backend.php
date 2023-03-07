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

	$fetch = "SELECT remaining_leave FROM employee WHERE id_no = '$id_no' AND full_name = '$full_name'";
		$stmt = $conn->prepare($fetch);
		$stmt->execute();
		foreach ($stmt->fetchALL() as $a) {
		 	$remaining_leave = $a['remaining_leave'];
		 	$count_month = 11;
		 	$max_leave_month = round($remaining_leave/11);
		 }
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

				if ($max_leave_month <= $days) {
						
					$sub = "UPDATE employee SET remaining_leave = remaining_leave - $days, status = 'On Leave(Whole)' WHERE id_no = '$id_no' AND full_name = '$full_name'";
					$sec = $conn->prepare($sub);
					if ($sec->execute()) {
						$insert = "INSERT INTO leave_table (`id_no`,`full_name`,`datefrom`,`dateto`,`reason`,`leave_type`) VALUES ('$id_no','$full_name', '$datefrom', '$dateto', '$reason','Whole Day')";
						$swc = $conn->prepare($insert);
						if ($swc->execute()) {
							$count = 0;
						}else{
							$count = $count + 1;
						}

					}

				}else{

					$count = $count + 2;

				}

		if ($count == 0) {
			echo 'success';
		}else if($count == 1){
			echo 'fail';
		}else{
			echo 'no';
		}

		
	}


	if ($method == 'insert_leave_half') {
		$id_no = $_POST['id_no'];
		$full_name = $_POST['full_name'];
		$remaining_leave = $_POST['remaining_leave'];
		$datetime = $_POST['datetime'];
		$reason = $_POST['reason'];

		$new_dt = str_replace('T', ' ', $datetime);

		$update = "UPDATE employee SET remaining_leave = remaining_leave - 1, status = 'On Leave(Half)' WHERE id_no = '$id_no' AND full_name = '$full_name'";
		$set = $conn->prepare($update);
		if ($set->execute()) {
			$insert = "INSERT INTO leave_table (`id_no`,`full_name`,`datefrom`,`dateto`,`reason`,`leave_type`) VALUES ('$id_no','$full_name','$new_dt','n/a', '$reason', 'Half Day')";
			$seq = $conn->prepare($insert);
			if ($seq->execute()) {
				$count = 0;
			}else{
				$count = $count + 1;
			}

		}else{
			$count = $count + 2;
		}

		if ($count == 0) {
			echo 'success';
		}else{
			echo 'fail';
		}

	}


	if ($method == 'load_history') {
			$id_no = $_POST['id_no'];
			$full_name = $_POST['full_name'];
			$c = 0;

			$query = "SELECT * FROM leave_table WHERE id_no = '$id_no' AND full_name = '$full_name'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			if ($stmt->rowCount() >0) {
				foreach ($stmt->fetchALL() as $x) {
					$c++;
					echo '<tr>';
						echo '<td>'.$c.'</td>';
						echo '<td>'.$x['datefrom'].'</td>';
						echo '<td>'.$x['dateto'].'</td>';
						echo '<td>'.$x['leave_type'].'</td>';
					echo '<tr>';
				}
			}else{
				echo '<tr>';
					echo '<td colspan = "11" style="color:red;">No Results!</td>';
				echo '<tr>';
			}

	}

	if ($method == 'reload_table_whole') {
		
		$query = "SELECT dateto, leave_type, DATEDIFF('$server_date_only','$newDate') as diff FROM leave_table WHERE dateto = '$server_date_only' GROUP BY dateto";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			foreach ($stmt->fetchALL() as $x) {
				$dateto = $x['dateto'];
				echo $diff = $x['diff'];
				}

				if ($diff == -1) {
					$select = "SELECT employee.id_no, employee.full_name, leave_table.dateto FROM employee LEFT JOIN leave_table ON leave_table.full_name = employee.full_name WHERE leave_table.dateto = '$dateto'";
					$stmt1 = $conn->prepare($select);
					$stmt1->execute();
					if ($stmt1->rowCount() > 0) {
						foreach ($stmt1->fetchALL() as $a) {
							$id_no = $a['id_no'];
							$full_name = $a['full_name'];
						}

						$update = "UPDATE employee SET status = 'Not on Leave' WHERE id_no = '$id_no' AND full_name = '$full_name'";
						$stmt2 = $conn->prepare($update);
						if ($stmt2->execute()) {
							$count = 0;
						}else{
							$count = $count + 1;
						}
					}else{
						$count = $count + 1;
					}

				}else{
					$count = $count + 1;
				}
			
		}else{
			echo 'no';
		}

		
	}


	if ($method == 'reload_table_half') {
		
		$query = "SELECT datefrom, leave_type, SUBSTRING(datefrom, 1, 10) as datefrom1 FROM leave_table WHERE leave_type = 'Half Day' GROUP BY leave_type";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			foreach ($stmt->fetchALL() as $x) {
				$datefrom1 = $x['datefrom1'];
				$datefrom = $x['datefrom'];

				echo $no = date_diff($datefrom1,$server_date_only);
			}

			if ($datefrom1 == $server_date_only) {

				$select = "SELECT employee.id_no, employee.full_name, leave_table.datefrom as datetrue FROM employee LEFT JOIN leave_table ON leave_table.full_name = employee.full_name WHERE leave_table.datefrom = '$datefrom'";
			$stmt1 = $conn->prepare($select);
			$stmt1->execute();
			if ($stmt1->rowCount() > 0) {
				foreach ($stmt1->fetchALL() as $a) {
					$id_no = $a['id_no'];
					$full_name = $a['full_name'];
				}

				$update = "UPDATE employee SET status "
			}
			
			}else{
			
			}


		}
	}






	// $update = "UPDATE employee SET status = 'On Leave(Whole)' WHERE full_name = '$full_name'";
	// $sec = $conn->prepare($update);
	// if ($sec->execute()) {
	// 	$select = "SELECT month(datefrom) as month FROM leave_table WHERE id_no = '$id_no' AND full_name = '$full_name'";
	// 	$sev = $conn->prepare($select);
	// 	$sev->execute();
	// 	if ($sev->rowCount() > 0) {
	// 		foreach ($sev->fetchALL() as $x) {
	// 			$month = $x['month'];

	// 			if ($month = 1) {
	// 				$this_month = 'January';
	// 			}else if($month = 2){
	// 				$this_month = 'February';
	// 			}else if($month = 3){
	// 				$this_month = 'March';
	// 			}else if($month = 4){
	// 				$this_month = 'April';
	// 			}else if($month = 5){
	// 				$this_month = 'May';
	// 			}else if($month = 6){
	// 				$this_month = 'June';
	// 			}else if($month = 7){
	// 				$this_month = 'July';
	// 			}else if($month = 8){
	// 				$this_month = 'August';
	// 			}else if($month = 9){
	// 				$this_month = 'September';
	// 			}else if($month = 10){
	// 				$this_month = 'October';
	// 			}else if($month = 11){
	// 				$this_month = 'November';
	// 			}else{
	// 				$this_month = 'No record';
	// 			}

	// 		}
	// 	}else{

	// 			if ($month = 1) {
	// 				$this_month = 'January';
	// 			}else if($month = 2){
	// 				$this_month = 'February';
	// 			}else if($month = 3){
	// 				$this_month = 'March';
	// 			}else if($month = 4){
	// 				$this_month = 'April';
	// 			}else if($month = 5){
	// 				$this_month = 'May';
	// 			}else if($month = 6){
	// 				$this_month = 'June';
	// 			}else if($month = 7){
	// 				$this_month = 'July';
	// 			}else if($month = 8){
	// 				$this_month = 'August';
	// 			}else if($month = 9){
	// 				$this_month = 'September';
	// 			}else if($month = 10){
	// 				$this_month = 'October';
	// 			}else if($month = 11){
	// 				$this_month = 'November';
	// 			}else{
	// 				$this_month = 'No record';
	// 			}


	// 	}
	// }


	// if ($sec->execute()) {
	// 	$insert = "INSERT INTO whole_day (`id_no`,`full_name`,`datefrom`,`dateto`,`reason`) VALUES ('$id_no','$full_name','$datefrom','$dateto','reason')";
	// 	$swc = $conn->prepare($insert);
	// 	if ($swc->execute()) {

				
	// 	$start = new DateTime($datefrom);
	// 	$end = new DateTime($dateto);
	// 	// otherwise the  end date is excluded (bug?)
	// 	$end->modify('+1 day');

	// 	$interval = $end->diff($start);

	// 	// total days
	// 	$days = $interval->days;

	// 	// create an iterateable period of date (P1D equates to 1 day)
	// 	$period = new DatePeriod($start, new DateInterval('P1D'), $end);

	// 	foreach($period as $dt) {
	// 	    $curr = $dt->format('D');

	// 	    // substract if Saturday or Sunday
	// 	    if ($curr == 'Sat' || $curr == 'Sun') {
	// 	        $days--;
	// 	    }

	// 	    // (optional) for the updated question
	// 	    elseif ($dt->format('D')) {
	// 	        $days;
	// 	    }
	// 	}


	// 	$days;

	// 	// if ($day > 2) {
	// 	// 	echo ''
	// 	// }

	// 	// $sub = "UPDATE employee SET remaining_leave - $days WHERE id_no = '$id_no' AND full_name = '$full_name'";
	// 	// $stmt = $conn->prepare($sub);
	// 	// if ($stmt->execute()) {
			
	// 	// }




	// 	}else{
	// 		$count = $count + 1;
	// 	}
	// }else{
	// 	$count = $count + 1;
	// }




$conn = NUll;


?>