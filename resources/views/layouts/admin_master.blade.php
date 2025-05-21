<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>InventoryManagementSystem</title>        

        <link href="{{ asset('backend') }}/css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css ">
<link href="https://cdn.jsdelivr.net/npm/bootstrap @5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<style>
    /* Base Styles */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        color: #212529;
        transition: background-color 0.4s ease, color 0.4s ease;
    }

    /* Dark Mode Background */
    body.dark-mode {
        background-color: #0d0d0d;
        color: #ffffff;
    }

    /* Card Styling (Light & Dark) */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: none;
    }

    body.dark-mode .card {
        background: rgba(30, 30, 30, 0.8); /* Glassy look */
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        color: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
    }

    body.dark-mode .card-header {
        background-color: rgba(44, 44, 44, 0.7);
        color: #00f7ff;
        text-shadow: 0 0 5px #00f7ff;
    }

    /* Navbar & Sidebar */
    body.dark-mode .navbar,
    body.dark-mode .sb-sidenav {
        background-color: #1a1a1a !important;
    }

    body.dark-mode .nav-link {
        color: rgba(255, 255, 255, 0.7);
    }

    body.dark-mode .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        color: #00f7ff;
    }

    /* Neon Text Classes */
    .neon-text-blue {
        color: #00f7ff;
        text-shadow: 0 0 5px #00f7ff, 0 0 10px #00f7ff, 0 0 20px #00f7ff;
    }

    .neon-text-green {
        color: #39ff14;
        text-shadow: 0 0 5px #39ff14, 0 0 10px #39ff14, 0 0 20px #39ff14;
    }

    .neon-text-pink {
        color: #ff1aff;
        text-shadow: 0 0 5px #ff1aff, 0 0 10px #ff1aff, 0 0 20px #ff1aff;
    }

    /* Buttons with Glow in Dark Mode */
    body.dark-mode .btn-primary {
        background-color: #00f7ff;
        color: #000;
        box-shadow: 0 0 10px #00f7ff, 0 0 20px #00f7ff;
        transition: all 0.3s ease;
    }

    body.dark-mode .btn-success {
        background-color: #39ff14;
        color: #000;
        box-shadow: 0 0 10px #39ff14, 0 0 20px #39ff14;
    }

    body.dark-mode .btn-danger {
        background-color: #ff1aff;
        color: #000;
        box-shadow: 0 0 10px #ff1aff, 0 0 20px #ff1aff;
    }

    /* Button Hover Glow */
    body.dark-mode .btn:hover {
        filter: brightness(1.1);
    }

    /* Table Styling in Dark Mode */
    body.dark-mode .table {
        color: #fff;
    }

    body.dark-mode .table thead {
        background-color: #2c2c2c;
        color: #00f7ff;
    }

    body.dark-mode .table tbody tr {
        background-color: #222;
    }

    /* Icons Glow in Dark Mode */
    body.dark-mode .fas,
    body.dark-mode .far,
    body.dark-mode .fab {
        color: #00f7ff;
        text-shadow: 0 0 5px #00f7ff;
    }

    /* Toggle Switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0;
        right: 0; bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 2px;
        bottom: 2px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:checked + .slider:before {
        transform: translateX(20px);
    }

    /* Footer */
    .footer {
        background-color: #f1f1f1;
        color: #333;
        padding: 1rem;
        font-size: 0.95rem;
    }

    body.dark-mode .footer {
        background-color: #1e1e1e;
        color: #ccc;
    }

    body.dark-mode .footer a {
        color: #00f7ff;
        text-decoration: underline;
    }
</style>



    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand">Inventory Management</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
           

            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                
            </form>
             <button id="toggleModeBtn" class="btn btn-sm btn-light m-3">
  <i id="modeIcon" class="fas fa-moon"></i>
</button>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                    </form>

                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseProducts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                 
                                    <a class="nav-link" href="{{ route('all.product') }}">Stock Report</a>
                                    <a class="nav-link" href="{{ route('available.products') }}">Available Products</a>
                                </nav>
                            </div>
                            
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOrders" aria-expanded="false" aria-controls="collapseOrders">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Orders
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseOrders" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('new.order')}}">New Order</a>
                                </nav>
                            </div>
                            <div class="collapse" id="collapseOrders" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('all.orders')}}">Orders List</a>
                                </nav>
                            </div>
                            <div class="collapse" id="collapseOrders" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('pending.orders')}}">Pending Orders</a>
                                </nav>
                            </div>
                            <div class="collapse" id="collapseOrders" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('delivered.orders')}}">Delivered Orders</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInvoice" aria-expanded="false" aria-controls="collapseInvoice">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Sales
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseInvoice" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('new.invoice') }}">New Invoice</a>
                                    <a class="nav-link" href="{{ route('all.invoices') }}">Invoices List</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuthentication" aria-expanded="false" aria-controls="collapseAuthentication">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Customers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseAuthentication" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('add.customer') }}">New Customer</a>
                                </nav>
                            </div>
                            <div class="collapse" id="collapseAuthentication" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('all.customers') }}">Customers List</a>
                                </nav>
                            </div>

                            
                            
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                
                @yield('content')

                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Swapnajit </div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('backend') }}/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('backend') }}/assets/demo/chart-area-demo.js"></script>
        <script src="{{ asset('backend') }}/assets/demo/chart-bar-demo.js"></script>
        <!-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script> -->
         <!-- <script src="{{ asset('backend') }}/assets/demo/datatables-demo.js"></script>  -->
<!-- 
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script> -->

                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
           <script>
document.addEventListener('DOMContentLoaded', function () {
  const toggleBtn = document.getElementById('toggleModeBtn');
  const modeIcon = document.getElementById('modeIcon');

  // Check localStorage and apply saved mode
  if (localStorage.getItem('dark-mode') === 'enabled') {
    document.body.classList.add('dark-mode');
    modeIcon.classList.remove('fa-moon');
    modeIcon.classList.add('fa-sun');
  }

  toggleBtn.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');

    const darkModeEnabled = document.body.classList.contains('dark-mode');

    // Update icon
    if (darkModeEnabled) {
      modeIcon.classList.remove('fa-moon');
      modeIcon.classList.add('fa-sun');
      localStorage.setItem('dark-mode', 'enabled');
    } else {
      modeIcon.classList.remove('fa-sun');
      modeIcon.classList.add('fa-moon');
      localStorage.setItem('dark-mode', 'disabled');
    }
  });
});
</script>


        @yield('script')
    </body>
</html>
