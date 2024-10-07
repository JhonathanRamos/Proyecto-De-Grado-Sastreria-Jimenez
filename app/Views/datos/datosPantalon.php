<?= $cabecera ?>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="index.html"><img src="img/logo.png"
                        alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="img/miniLogo.png"
                        alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle " src="assets/images/faces/face15.jpg" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
                                <span>Gold Member</span>
                            </div>
                        </div>
                        <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i
                                class="mdi mdi-dots-vertical"></i></a>
                        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                            aria-labelledby="profile-dropdown">
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-cog text-primary"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-onepassword  text-info"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-calendar-today text-success"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('cliente') ?>">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Datos Cliente</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false"
                        aria-controls="auth">
                        <span class="menu-icon">
                            <i class="mdi mdi-security"></i>
                        </span>
                        <span class="menu-title">Datos Medidas</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="auth">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('datosFalda') ?>">Falda</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="<?= base_url('datosTrajeMasculino') ?>">Traje Masculino</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('datosTrajeFemenino') ?>">Traje
                                    Femenino</a> </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="<?= base_url('datosPantalon') ?>">Pantalon</a> </li>

                        </ul>
                    </div>
                </li>

                <!-- <li class="nav-item menu-items">
                    <a class="nav-link" href="<?= base_url('crear') ?>">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Crear Cliente</span>
                    </a>
                </li> -->


                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">+ Confeccion</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('trajeMasculino') ?>">+Traje
                                    Masculino</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('trajeFemenino') ?>">+Traje
                                    Femenino</a></li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('pantalon') ?>">+Pantalon</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="<?= base_url('falda') ?>">+Falda</a></li>
                        </ul>
                    </div>
                </li>



            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="img/miniLogo.png"
                            alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav w-100">
                        <!-- <li class="nav-item w-100">
                <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  <input type="text" class="form-control" placeholder="Search products">
                </form>
              </li> -->
                    </ul>

                    <ul class="navbar-nav navbar-nav-right">
         
            <li class="nav-item dropdown border-left">
              <a class="nav-link count-indicator dropdown-toggle" href="<?= base_url('crear') ?>">
                <i class="mdi mdi-account-plus"></i>
                <!-- <span class="count bg-success"></span> -->
              </a>

            </li>


            <li class="nav-item dropdown border-left">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                data-bs-toggle="dropdown">
                <i class="mdi mdi-bell"></i>
                <span class="count bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-calendar text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Event today</p>
                    <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-cog text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Settings</p>
                    <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-link-variant text-warning"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Launch Admin</p>
                    <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <p class="p-3 mb-0 text-center">See all notifications</p>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" src="assets/images/faces/face15.jpg" alt="">
                  <p class="mb-0 d-none d-sm-block navbar-profile-name">Henry Klein</p>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0">Profile</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-cog text-success"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Log out</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <p class="p-3 mb-0 text-center">Advanced settings</p>
              </div>
            </li>
          </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    <div class="row">





                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h1 class="card-title">Clientes</h1>
                                    <div class="input-group mb-3">

                                        <input type="text" id="search" class="form-control"
                                            placeholder="Buscar Clientes...">
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-dark" id="clientesTable">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre Cliente</th>
                                                    <th>Largo</th>
                                                    <th>Entrepierna</th>
                                                    <th>Cintura</th>
                                                    <th>Cadera</th>
                                                    <th>Pierna</th>
                                                    <th>Rodilla</th>
                                                    <th>Bota</th>
                                                    <th>Acciones</th>
                                                </tr>

                                            </thead>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($pantalones as $Pantalon): ?>
                                                    <tr>
                                                        <td><?= $Pantalon['idCliente']; ?></td>
                                                        <td><?= $Pantalon['nombre_completo']; ?></td>
                                                        <!-- Acceder al nombre del cliente relacionado -->
                                                        <td><?= $Pantalon['largo']; ?></td>
                                                        <td><?= $Pantalon['entrepierna']; ?></td>
                                                        <td><?= $Pantalon['cintura']; ?></td>
                                                        <td><?= $Pantalon['cadera']; ?></td>
                                                        <td><?= $Pantalon['pierna']; ?></td>
                                                        <td><?= $Pantalon['rodilla']; ?></td>
                                                        <td><?= $Pantalon['bota']; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?= base_url('editarPantalon/' . $Pantalon['idCliente']); ?>"
                                                                    class="btn btn-outline-primary"
                                                                    style="margin-right: 2px;">Editar</a>
                                                                <a href="#" class="btn btn-outline-danger"
                                                                    style="margin-right: 2px;"
                                                                    onclick="confirmDeleteDatos(event, '<?= base_url('borrarPantalon/' . $Pantalon['idCliente']); ?>');">Borrar</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 <a
                                href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights
                            reserved.</span>
                        <span class="text-muted float-none float-sm-end d-block mt-1 mt-sm-0 text-center"> <span
                                class="text-muted float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Hand-crafted
                                & made with <i class="mdi mdi-heart text-danger"></i></span> <i
                                class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <?= $pie ?>