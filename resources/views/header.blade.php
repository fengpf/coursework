<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="/home">Grodata Solutions</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="/home">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Entry">
                <a class="nav-link " href="/dataentry">
                    <i class="fa fa-fw fa-table"></i>
                    <span class="nav-link-text">Data Entry</span>
                </a>
            </li>
            <?php if(Session::has('superadmin_login') || Session::has('admin_login')) { ?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Search">
                <a class="nav-link " href="/datasearch">
                    <i class="fa fa-fw fa-file"></i>
                    <span class="nav-link-text">Data Search</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Search">
                <a class="nav-link " href="/admin_search">
                    <i class="fa fa-fw fa-file"></i>
                    <span class="nav-link-text">Admin Search</span>
                </a>
            </li>
            <?php } ?>
            

            <?php if(Session::has('superadmin_login') || Session::has('admin_login')) { ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseAdmin">
                        <i class="fa fa-fw fa-user"></i>
                        <span class="nav-link-text">Admin</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseAdmin">
                        <!--<li>
                            <a href="/list_role">Roles</a>
                        </li>-->
                        <li>
                            <a href="/adminuser">Users</a>
                        </li>
                        <li>
                            <a href="/dataupload">Data Upload</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Report">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseReport">
                    <i class="fa fa-fw fa-list"></i>
                    <span class="nav-link-text">Report</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseReport">
                    <li>
                        <a href="/dailyreport">Daily Report</a>
                    </li>
                    <?php if(Session::has('superadmin_login') || Session::has('admin_login')) { ?>
                        <li>
                            <a href="/targetreport">Target Report</a>
                        </li>
                    <?php } ?>
                </ul>
            </li>

        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    welcome <?php echo $name ?> <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>