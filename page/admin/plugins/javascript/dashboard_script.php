<script type="text/javascript">
	$( document ).ready(function() {
    reload_whole();
    setTimeout(reload_half, 3000);
	});

	
	const emp_search =()=>{
		var emp_id = document.getElementById('emp_id').value;
		var emp_name = document.getElementById('emp_name').value;

		// console.log(emp_id)
		// console.log(emp_name)

		$.ajax({
			url: '../../process/admin/dashboard_backend.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'load_emp',
				emp_id:emp_id,
				emp_name:emp_name
			},success:function(x) {
				document.getElementById('emp_table').innerHTML = x;
			}
		});
	}

	const reload_whole =()=>{

		$.ajax({
			url:'../../process/admin/dashboard_backend.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'reload_table_whole',
			},success:function(x) {
				// console.log(x)
			}
		});
	}

	const reload_half =()=>{
		$.ajax({
			url:'../../process/admin/dashboard_backend.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'reload_table_half',
			},success:function(x) {
				console.log(x)
			}
		});
	}

	const details =(param)=>{
		var data = param.split('~!~');
		var id = data[0];
		var id_no = data[1];
		var full_name = data[2];
		var department = data[3];
		// var dat_hired = data[4];
		var remaning_leave = data[4];
		var status = data[5];

		$('#leave_id').val(id);
		$('#leave_id_no').val(id_no);
		$('#leave_full_name').val(full_name);
		$('#leave_department').val(department);
		// $('#leave_dat_hired').val(dat_hired);
		$('#leave_remaning_leave').val(remaning_leave);
		$('#leave_status').val(status);

		// console.log(param)

		leave_history();
	}

	const modal_whole =()=>{
		var remaining_leave = document.getElementById('leave_remaning_leave').value;
		var status = document.getElementById('leave_status').value;

		// console.log(remaining_leave)
		// console.log(status)

		if (remaining_leave == 0) {
			 	Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'This employee has 0 leaves ',
			})
		}else if(status == 'On Leave(Whole)' || status == 'On Leave(Half)'){
				Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'The Employee is currently on leave',
			})
		}else{
			$('#whole_day').modal('show');
			$('#modal_emp').modal('hide');
		}
	}


	const set_leave =()=>{
		var id_no = document.getElementById('leave_id_no').value;
		var full_name = document.getElementById('leave_full_name').value;
		var remaining_leave = document.getElementById('leave_remaning_leave').value;
		var datefrom = document.getElementById('datefrom').value; 
		var dateto = document.getElementById('dateto').value;
		var reason = document.getElementById('reason').value;

		// console.log(id_no)
		// console.log(full_name)
		// console.log(datefrom)
		// console.log(dateto)
		// console.log(reason)

		if (datefrom == '') {
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Please Select Date Start',
			})
		}else if(dateto == ''){
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Please Select Date End',
			})
		}else if(reason == ''){
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Please Input Reason',
			})
		}else{

			$.ajax({
				url: '../../process/admin/dashboard_backend.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'insert_leave_whole',	
					id_no:id_no,
					full_name:full_name,
					remaining_leave:remaining_leave,
					datefrom:datefrom,
					dateto:dateto,
					reason:reason
				},success:function(x) {
					// console.log(x);
					if (x == 'success') {
						Swal.fire({
						  icon: 'success',
						  title: 'Success!!',
						  text: 'Successfully Set Leave',
						})
						$('#whole_day').modal('hide');
					}else if(x == 'no'){
						Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Max of only 2 leaves per month',
					})
					}else{
						Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Something went wrong!',
					})
					}
				}
			});

		}
	}


	const modal_half =()=>{
		var remaining_leave = document.getElementById('leave_remaning_leave').value;
		var status = document.getElementById('leave_status').value;

		if (remaining_leave == 0) {
			 	Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'This employee has 0 leaves ',
			})
		}else if(status == 'On Leave(Whole)' || status == 'On Leave(Half)'){
				Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'The Employee is currently on leave',
			})
		}else{
			$('#half_day').modal('show');
			$('#modal_emp').modal('hide');
		}
	}


	const leave_set =()=>{
		var id_no = document.getElementById('leave_id_no').value;
		var full_name = document.getElementById('leave_full_name').value;
		var remaining_leave = document.getElementById('leave_remaning_leave').value;
		var datetime = document.getElementById('datetime').value;
		var reason = document.getElementById('reason').value;
			// console.log(datetime)
			// console.log(reason)
		if (datefrom == '') {
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Please Select Date',
			})
		}else if(reason == ''){
				Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'This employee has 0 leaves ',
			})
		}else{
			$.ajax({
				url:'../../process/admin/dashboard_backend.php',
				type: 'POST',
				cache: false,
				data:{
					method: 'insert_leave_half',
					id_no:id_no,
					full_name:full_name,
					remaining_leave:remaining_leave,
					datetime:datetime,
                    reason:reason
				},success:function(x) {
					// console.log(x)
					if (x == 'fail') {
							Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: 'Something went wrong!!',
						})
					}else{
						Swal.fire({
						  icon: 'success',
						  title: 'Success!!',
						  text: 'Successfully Set Half Day Leave',
						})
						$('#half_day').modal('hide');
					}
				}
			});
		}
	}


	const leave_history =()=>{
		var id_no = document.getElementById('leave_id_no').value;
		var full_name = document.getElementById('leave_full_name').value;

		$.ajax({
			url:'../../process/admin/dashboard_backend.php',
			type: 'POST',
			cache: false,
			data:{
				method: 'load_history',
				id_no:id_no,
				full_name:full_name
			},success:function (x) {
				document.getElementById('leave_history_table').innerHTML = x;
			}
		});
	}


</script>