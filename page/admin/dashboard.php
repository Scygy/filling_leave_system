
<?php include 'plugins/navbar.php';?>
<?php include 'plugins/sidebar/dashboardbar.php';?>

  <!-- Main Sidebar Container -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
                
       <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title col-6">
                  <div class="row">
                    <div class="col-3">
                      <label>Employee ID:</label><input type="text" name="emp_id"  id="emp_id" class="form-control">
                    </div>
                     <div class="col-5">
                      <label>Employee Name:</label><input type="text" name="emp_name"  id="emp_name" class="form-control">
                    </div>
                  </div>
                  <br>
                </h3> 
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 100px;">
                    <button class="btn btn-primary" id="searchReqBtn" onclick="emp_search()">Search <i class="fas fa-search"></i></button>
                  </div>
                </div>
              </div>
             <!--  <button class="btn btn-success" id="searchReqBtn" style="width:100px;" onclick="master_export('view_master')">Export <i class="fas fa-file"></i></button> -->
              <div class="card-body table-responsive p-0" style="height: 420px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="view_emp">
                <thead style="text-align:center;">
                  <!-- <th>
                        <input type="checkbox" name="" id="check_all"  onclick="select_all_func()">
                    </th> -->
                    <th>#</th>
                    <th>ID No.</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Date Hired</th>
                    <th>Remaining Leaves</th>
                    <th>Status</th>

                   
                    
            </thead>
            <tbody id="emp_table" style="text-align:center;"></tbody>
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
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->

        
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>


<?php include 'plugins/footer.php';?>
<?php include 'plugins/javascript/dashboard_script.php';?>