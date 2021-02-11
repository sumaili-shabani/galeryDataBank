  <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0);">
                <img src="<?php echo(base_url()) ?>upload/annumation/logo.jpg" class="img-responsive img-thumbnail" style="width: 70px; height: 60px;">
                <div class="sidebar-brand-text mx-3">User <sup>I°</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo(base_url()) ?>user/dashbord">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Applications:</h6>

                        <a class="collapse-item" href="<?php echo(base_url()) ?>user/client">Client</a>

                        <a class="collapse-item" href="<?php echo(base_url()) ?>user/location">Locaton</a>

                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
          

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Deconnexion au système
            </div>

            

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" onclick="return confirm('êtes-vous sûre de vouloire se deconnecter?');" href="<?php echo(base_url())?>login/logout">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Se Deconnecter</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->