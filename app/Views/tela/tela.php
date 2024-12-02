<?= $cabecera ?>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="<?= base_url('cliente') ?>"><img src="img/logo.png"
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
                            <a class="nav-link count-indicator dropdown-toggle" href="<?= base_url('crearTela') ?>">
                                <i class="mdi mdi-tshirt-crew"></i>
                                <!-- <span class="count bg-success"></span> -->
                            </a>

                        </li>

                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle"
                                href="<?= base_url('crearConfeccion') ?>">
                                <i class="mdi mdi-tie"></i>
                                <!-- <span class="count bg-success"></span> -->
                            </a>

                        </li>


                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="confeccionDropdown" href="#"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-hanger"></i>
                                <span class="count bg-success"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                                aria-labelledby="confeccionDropdown">
                                <h6 class="p-3 mb-0">Medidas Cliente</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="<?= base_url('trajeMasculino') ?>">
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Traje Masculino</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="<?= base_url('trajeFemenino') ?>">
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Traje Femenino</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="<?= base_url('pantalon') ?>">
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Pantalón</p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" href="<?= base_url('falda') ?>">
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Falda</p>
                                    </div>
                                </a>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="assets/images/faces/face15.jpg" alt="">
                                    <div class="d-none d-sm-block">
                                        <?php if (session()->has('user_id')): ?>
                                            <p class="mb-0 navbar-profile-name"><?= session()->get('user_name') ?></p>
                                            <small>
                                                <?php if (session()->get('user_role') == 1): ?>
                                                <?php else: ?>
                                                <?php endif; ?>
                                            </small>
                                        <?php else: ?>
                                            <p>No estás logueado.</p>
                                        <?php endif; ?>
                                    </div>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">Ajuste</h6>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('auth/logout') ?>" class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Cerrar Sesión</p>
                                    </div>
                                </a>
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
                                    <h1 class="card-title">Confecciones</h1>
                                    <div class="input-group mb-3">
                                        <input type="text" id="search" class="form-control"
                                            placeholder="Buscar Confecciones...">
                                    </div>
                                    <div class="table-responsive">


                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Calidad</th>
                                                    <th>Descripción</th>
                                                    <th>Metros</th>
                                                    <th>Precio</th>
                                                    <th>Imagen Tela</th>
                                                    <th>Imagen Traje</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($telas as $tela): ?>
                                                    <tr>
                                                        <td><?= $tela['id']; ?></td>
                                                        <td><?= $tela['nombre']; ?></td>
                                                        <td><?= $tela['calidad']; ?></td>
                                                        <td><?= $tela['descripcion']; ?></td>
                                                        <td><?= $tela['metros']; ?></td>
                                                        <td><?= $tela['precio']; ?> Bs</td>
                                                        <td>
                                                            <img src="<?= base_url('uploads/' . $tela['imagenTela']); ?>"
                                                                alt="Imagen Tela" width="50" height="50"
                                                                style="object-fit: cover; border-radius: 5px; cursor: pointer;"
                                                                onclick="openModal('<?= base_url('uploads/' . $tela['imagenTela']); ?>')">
                                                        </td>
                                                        <td>
                                                            <img src="<?= base_url('uploads/' . $tela['imagenTraje']); ?>"
                                                                alt="Imagen Traje" width="50" height="50"
                                                                style="object-fit: cover; border-radius: 5px; cursor: pointer;"
                                                                onclick="openModal('<?= base_url('uploads/' . $tela['imagenTraje']); ?>')">
                                                        </td>

                                                        <!-- Modal -->
                                                        <!-- Modal -->
                                                        <div id="imageModal"
                                                            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.8); z-index: 1000; justify-content: center; align-items: center;"
                                                            onclick="closeModal()">
                                                            <img id="modalImage"
                                                                style="max-width: 90%; max-height: 90%; border-radius: 10px;"
                                                                onclick="event.stopPropagation();">
                                                            <span onclick="closeModal()"
                                                                style="position: absolute; top: 20px; right: 30px; font-size: 40px; color: white; cursor: pointer;">&times;</span>
                                                        </div>

                                                        <td>
                                                            <a href="<?= base_url('telas/editar/' . $tela['id']); ?>"
                                                                class="btn btn-outline-primary">Editar</a>
                                                            <a href="<?= base_url('telas/borrar/' . $tela['id']); ?>"
                                                                class="btn btn-outline-danger"
                                                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta tela?');">Borrar</a>
                                                        </td>

                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                        <script>
                                            function confirmDelete(event, url) {
                                                event.preventDefault();
                                                if (confirm('¿Estás seguro de que deseas eliminar esta confección?')) {
                                                    window.location.href = url;
                                                }
                                            }
                                        </script>




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
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                            Sastreria Jimenez</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>


    <?= $pie ?>