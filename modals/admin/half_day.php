

<div class="modal fade bd-example-modal-lg" id="half_day" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Half Day Filling</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <!-- <div class="col-3">
                      <label for="">Date Select:</label> <input type="date" name="datefrom" id="datefrom" class="form-control"  autocomplete=off>
                  </div> -->
          <div class="col-3">
            <form action="">
  <label>Date and Time:</label>
  <input type="datetime-local" id="datetime" name="datetime">
</form>
          </div>
                  <br>
      </div>

       <label>Reason:</label>
       <br>
             <textarea style="font-size:125%;" rows="10" cols="83" id="reason"></textarea>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="leave_set()">Set Leave</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

