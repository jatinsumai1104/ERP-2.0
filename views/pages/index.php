
<?php
  require_once('../../helper/constants.php');
  require_once(__DIR__.'/../../helper/init.php');

if(!isset($_SESSION['employee_id'])){
  Util::redirect("login");
}

?>
<!DOCTYPE html>
<html lang="en">

<!-- Header containing all Links -->
<?php
  require_once('../includes/header.php');
  
?>


<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php
      require_once('../includes/sidebar.php');
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php
          require_once('../includes/navbar.php');
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Earnings (Annual)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

<?php
//LABELS FOR MONTHS IF ANY YEAR SELECTED
$monthLabels=array("Jan","Feb","Mar","April","May","June","July","August","September","October","November","December");

//LABELS FOR YEARS IF YEARLY SELECTED
$yearLabels = array();

//YEARS THAT NEED TO BE DISPLAYED IN DROPDOWN AS WELL AS IN YEARLY GRAPH
$years = $di->get("Database")->rawQuery("SELECT YEAR(created_at) as year from purchases GROUP by YEAR(created_at)");

//DATA FOR EACH MONTH FOR ALL THE CORRESSPONDING YEARS EXTRACTED FROM THE DATABASE
$eachMonthData = array();

//ADDING DATA FOR EACH MONTH FOR EACH YEAR AND ADDING THE YEARS EXTRACTED IN YEARLABELS
foreach($years as $year){
  $ans = $di->get("Database")->rawQuery("select MONTH(created_at) as month,Sum(purchase_rate*quantity) as amount from purchases WHERE YEAR(created_at)={$year['year']} GROUP BY MONTH(created_at)");
  array_push($eachMonthData,$ans);
  array_push($yearLabels,$year['year']);
}

//ADDING THE FINAL YEARLY DROPDOWN DATA ALSO IN THE EACH MONTH DATA WHICH CAN BE EXTRACTED BY LAST INDEX DIRECTLY IN JS 
$yearlyData = $di->get("Database")->rawQuery("SELECT YEAR(created_at) as year,SUM(purchase_rate*quantity) as amount from purchases GROUP by YEAR(created_at)");
array_push($eachMonthData,$yearlyData);
// print_r($eachMonthData);
// print_r($yearlyData);
//COMBINING THE ALL POSSIBLE LABELS AND SENDING TO THE JS FILE TO WORK ON IT
$monthYearLabels = array($monthLabels,$yearLabels);

//CALL TO THE JS FUNCTION TO LOAD THE CHARTS IS GIVEN AT THE END OF THE FILE

?>

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                  <select name="time" id="timeperiod">
                  <?php
                    $i=0;
                    foreach($years as $year){
                      echo "<option value={$i}>{$year['year']}</option>";
                      $i++;
                    }
                  ?>
                  <option value="year-wise">Yearly</option>
                  </select>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area" id="chart-container">
                    <canvas id="bar-chart-grouped"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>


<!-- SALES BAR GRAPH STARTS HERE -->

<?php
//LABELS FOR MONTHS IF ANY YEAR SELECTED
$monthLabels2=array("Jan","Feb","Mar","April","May","June","July","August","September","October","November","December");

//LABELS FOR YEARS IF YEARLY SELECTED
$yearLabels2 = array();

//YEARS THAT NEED TO BE DISPLAYED IN DROPDOWN AS WELL AS IN YEARLY GRAPH
$years2 = $di->get("Database")->rawQuery("SELECT YEAR(created_at) as year from sales GROUP by YEAR(created_at)");

//DATA FOR EACH MONTH FOR ALL THE CORRESSPONDING YEARS EXTRACTED FROM THE DATABASE
$eachMonthData2 = array();

//ADDING DATA FOR EACH MONTH FOR EACH YEAR AND ADDING THE YEARS EXTRACTED IN YEARLABELS
foreach($years2 as $year){
  $ans = $di->get("Database")->rawQuery("select MONTH(sales.created_at) as month,Sum(selling_rate*quantity) as amount from sales INNER JOIN products_selling_rate on sales.product_id = products_selling_rate.product_id WHERE YEAR(sales.created_at)={$year['year']} GROUP BY MONTH(sales.created_at)");
  array_push($eachMonthData2,$ans);
  array_push($yearLabels2,$year['year']);
}
// print_r($eachMonthData2);

//ADDING THE FINAL YEARLY DROPDOWN DATA ALSO IN THE EACH MONTH DATA WHICH CAN BE EXTRACTED BY LAST INDEX DIRECTLY IN JS 
$yearlyData2 = $di->get("Database")->rawQuery("select YEAR(sales.created_at) as year,Sum(selling_rate*quantity) as amount from sales INNER JOIN products_selling_rate on sales.product_id = products_selling_rate.product_id GROUP BY YEAR(sales.created_at)");
array_push($eachMonthData2,$yearlyData2);
// print_r($eachMonthData);
// print_r($yearlyData2);
//COMBINING THE ALL POSSIBLE LABELS AND SENDING TO THE JS FILE TO WORK ON IT
$monthYearLabels2 = array($monthLabels2,$yearLabels2);

//CALL TO THE JS FUNCTION TO LOAD THE CHARTS IS GIVEN AT THE END OF THE FILE

?>



          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-10 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                  <select name="time" id="timeperiod2">
                  <!-- <option value="month-wise">Monthly</option> -->
                  <?php
                    $i=0;
                    foreach($years2 as $year){
                      echo "<option value={$i}>{$year['year']}</option>";
                      $i++;
                    }
                  ?>
                  <option value="year-wise">Yearly</option>
                  </select>
                

<form method="post" action="<?php echo BASEURL?>helper/routing.php">
<input type="date" name="from">
<input type="date" name="to">
<button type="submit" name="purchase_report">SUBMIT</button>
</form>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area" id="chart-container2">
                    <canvas id="bar-chart-sales"></canvas>
                  </div>
                </div>
              </div>
            </div>
            




          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                  <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                  <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>




              <!-- Color System -->
              <div class="row">
                <div class="col-lg-6 mb-4">
                  <div class="card bg-primary text-white shadow">
                    <div class="card-body">
                      Primary
                      <div class="text-white-50 small">#4e73df</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-success text-white shadow">
                    <div class="card-body">
                      Success
                      <div class="text-white-50 small">#1cc88a</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      Info
                      <div class="text-white-50 small">#36b9cc</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-warning text-white shadow">
                    <div class="card-body">
                      Warning
                      <div class="text-white-50 small">#f6c23e</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                      Danger
                      <div class="text-white-50 small">#e74a3b</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 mb-4">
                  <div class="card bg-secondary text-white shadow">
                    <div class="card-body">
                      Secondary
                      <div class="text-white-50 small">#858796</div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="img/undraw_posting_photo.svg" alt="">
                  </div>
                  <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank" rel="nofollow" href="https://undraw.co/">unDraw</a>, a constantly updated collection of beautiful svg images that you can use completely free and without attribution!</p>
                  <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a>
                </div>
              </div>

              <!-- Approach -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                  <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                  <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php
        require_once('../includes/footer.php');
      ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- All Required Scripts  -->
  <?php
    require_once('../includes/scripts.php');
  ?>

</body>

</html>



<script>
var allLabels = <?php echo json_encode($monthYearLabels); ?>;
var allData = <?php echo json_encode($eachMonthData); ?>;
loadCharts(allLabels,allData);

var allLabels2 = <?php echo json_encode($monthYearLabels2); ?>;
var allData2 = <?php echo json_encode($eachMonthData2); ?>;
loadSalesCharts(allLabels2,allData2);
</script>