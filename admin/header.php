<?php
  session_start();

?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Custom CSS -->
  <style>
    /* Header Styling */
    .header {
  background-color: #343a40; /* Dark theme background color */
  color: #fff; /* Text color */
  padding: 10px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2); /* Shadow effect */
  position: fixed; /* Fix the header position */
  top: 0; /* Stick the header to the top */
  width: 100%; /* Ensure the header spans the full width */
  z-index: 999; /* Ensure the header is on top of other content */
}
    .header img {
      max-height: 40px; /* Adjust logo height */
    }
    .sign-out {
      color: rgba(255, 255, 255, 0.5); /* Sign out link text color */
    }
    .sign-out:hover {
      color: #fff; /* Hover color */
    }
    /* Sidebar Styling */
    .sidebar {
  position: fixed;
  top: 60px; /* Adjust header height */
  bottom: 0;
  left: 0;
  z-index: 100;
  background-color: #343a40; /* Dark theme background color */
  padding-top: 20px;
  color: #fff; /* Text color */
  width: 250px; /* Sidebar width */
  box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.2); /* Shadow effect */
}

    .sidebar-heading {
      padding: 10px 15px;
      text-align: center;
    }
    .nav-link {
      color: rgba(255, 255, 255, 0.5); /* Link text color */
    }
    .nav-link:hover {
      color: #fff; /* Hover color */
    }
    /* Page Content Styling */
    
.page-content {
  margin-top: 60px; /* Adjust according to header height */
  margin-left: 250px; /* Sidebar width */
  padding: 20px;
  background-color: #f8f9fa; /* Light background color */
  min-height: calc(100vh - 60px); /* Set a minimum height */
}

    .widget {
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1); /* Shadow effect */
    }
    .widget-header {
      border-bottom: 1px solid #dee2e6;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }
    .widget-title {
      font-size: 20px;
      margin-bottom: 0;
    }
    .widget-icon {
      font-size: 24px;
      margin-right: 10px;
    }
    .sales-chart {
      height: 300px;
    }
    .order-item {
      padding: 10px 0;
      border-bottom: 1px solid #dee2e6;
    }
    .order-item:last-child {
      border-bottom: none;
    }
    .page-content {
    background-color: #f8f9fa;
  }

  .table-modern {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .table-modern thead th {
    background-color: #343a40;
    color: #fff;
    padding: 12px;
    text-align: left;
    border-bottom: none;
  }

  .table-modern tbody tr {
    border-bottom: 1px solid #dee2e6;
    transition: background-color 0.3s;
  }

  .table-modern tbody tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  .table-modern tbody tr:nth-child(odd) {
    background-color: #ffffff;
  }

  .table-modern tbody tr:hover {
    background-color: #e9ecef;
  }

  .table-modern tbody td {
    padding: 12px;
    border-top: none;
    border-bottom: none;
  }

  .btn-outline-primary, .btn-outline-danger {
    transition: all 0.3s ease;
  }

  .btn-outline-primary:hover {
    background-color: #007bff;
    color: #fff;
  }

  .btn-outline-danger:hover {
    background-color: #dc3545;
    color: #fff;
  }
</style>
</head>
<body>
 <div class="header">
 <div class="company-logo">
   <!-- Replace the src attribute with your company logo image URL -->
   <img src="../img/logo1-removebg-preview.png" alt="Company Logo">
   <!-- Or use company name -->
   <!-- <h3>Company Name</h3> -->
 </div>
 <div>
  
   <a href="../admin-includes/logout.adm.php" class="sign-out">Sign Out</a>
 </div>
</div>

