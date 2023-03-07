

<div class="modal fade bd-example-modal-lg" id="modal_emp" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Leave Selection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="leave_id" id="leave_id">
        <input type="hidden" name="leave_id_no" id="leave_id_no">
        <input type="hidden" name="leave_full_name" id="leave_full_name">
        <input type="hidden" name="leave_department" id="leave_department">
        <input type="hidden" name="leave_remaning_leave" id="leave_remaning_leave">
        <input type="hidden" name="leave_status" id="leave_status">
        <div class="row">
          

          <div class="container-fluid">
 
<div class="row">
<div class="col-12 col-sm-6 col-md-6">
<div class="info-box">
<span class="info-box-icon bg-danger elevation-1"><a href="#" onclick="modal_whole()"><i class="fas fa-file-alt"></i></a></span>
<div class="info-box-content">
<a href="#" onclick="modal_whole()"><span class="info-box-text"><b>Whole Day</b></span></a>
<span class="info-box-number">
<small></small>
</span>
</div>

</div>

</div>

<div class="col-12 col-sm-6 col-md-6">
<div class="info-box">
<span class="info-box-icon bg-warning elevation-1"><a href="#" onclick="modal_half()"><i class="fas fa-file-alt"></i></a></span>
<div class="info-box-content">
<a href="#" onclick="modal_half()"><span class="info-box-text"><b>Half Day</b></span></a>
<span class="info-box-number">
<small></small>
</span>
</div>

</div>

</div>


</div>
</div>

<label>Leave History Employee</label>
<div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="view_emp">
                <thead style="text-align:center;">
                  <!-- <th>
                        <input type="checkbox" name="" id="check_all"  onclick="select_all_func()">
                    </th> -->
                    <th>#</th>
                    <th>Date From</th>
                    <th>Date to</th>
                    <th>Leave Type</th>
                   
                    
            </thead>
            <tbody id="leave_history_table" style="text-align:center;"></tbody>
                </table>
                 <div class="row">
                  <div class="col-6">


                    
                  </div>
                  <div class="col-6">
                      <input type="hidden" name="" id="stocks">
   
                    <div class="spinner" id="spinner" style="display:none;">
                        
                        <div class="loader float-sm-center"></div>    
                    </div>
             
                  </div>

              </div>
              <!-- /.card-body -->
            </div>


</div>
      <div class="modal-footer">
       <!--  <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
      </div>
    </div>
  </div>
</div>

