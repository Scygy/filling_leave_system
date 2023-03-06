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
						
						$insert = "INSERT INTO leave_table (`id_no`,`full_name`,`datefrom`,`dateto`,`reason`,`leave_type`) VALUES ('$id_no','$full_name', '$datefrom', '$dateto', '$reason','On Leave(Whole)')";
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


24/48


?>