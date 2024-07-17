<?php
    include("header.php");

   if(!isset($_SESSION["adminid"])){
    echo "<script>window.location.href ='login.php';</script>";
    exit();
   }
?>

  <!-- Header -->

  <!-- Sidebar -->
  <?php   include("sidebar.php") ;?>

  <!-- Page Content -->
  <div class="page-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-title"><i class="fas fa-chart-line widget-icon"></i>Sales Statistics</h3>
            </div>
            <canvas id="sales-chart" class="sales-chart"></canvas>
          </div>
        </div>
        <div class="col-md-6">
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-title"><i class="fas fa-list-ul widget-icon"></i>Recent Orders</h3>
            </div>
            <div class="order-list">
              <div class="order-item">
                <p>#1234 - John Doe</p>
             <p>Total: $150</p>
              </div>
              <div class="order-item">
                <p>#1235 - Jane Smith</p>
                <p>Total: $200</p>
              </div>
              <div class="order-item">
                <p>#1236 - Alex Johnson</p>
                <p>Total: $100</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="widget">
            <div class="widget-header">
              <h3 class="widget-title"><i class="fas fa-tags widget-icon"></i>Product Categories</h3>
            </div>
            <ul class="category-list">
              <li>NIKE</li>
              <li>JORDAN</li>
              <li>PUMA</li>
              <li>ASICS</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    // Sample sales data for chart
    var salesData = {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Sales ($)',
        data: [1000, 1500, 1200, 1700, 1400, 2000],
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    };
    // Sales chart
    var salesChart = document.getElementById('sales-chart').getContext('2d');
    var mySalesChart = new Chart(salesChart, {
      type: 'line',
      data: salesData,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</body>
</html>
