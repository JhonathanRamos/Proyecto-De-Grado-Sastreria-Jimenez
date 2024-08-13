<?=$cabecera?>
<div class="menu">
    <ion-icon name="menu-outline"></ion-icon>
    <ion-icon name="close-outline"></ion-icon>
</div>

<div class="barra-lateral">
    <div>
        <div class="nombre-pagina">
            <ion-icon id="cloud" name="grid-outline"></ion-icon>
            <span>Sastreria <br>
                Jimenez</span>
        </div>
    </div>
    <br>
    <nav class="navegacion">
        <ul>
            <li>
                <a class="btn btn-dark" href="<?=base_url('crear')?>">
                    <ion-icon name="people-outline"></ion-icon>
                    <span>Crear Clientes</span>
                </a>
            </li>
            <li>
                <a class="btn btn-dark" href="<?=base_url('trajeMasculino')?>">
                    <ion-icon name="add-outline"></ion-icon>
                    <span>Traje Masculino</span>
                </a>
            </li>
            <li>
                <a class="btn btn-dark" href="<?=base_url('trajeFemenino')?>">
                    <ion-icon name="add-outline"></ion-icon>
                    <span>Traje Femenino</span>
                </a>
            </li>
            <li>
                <a class="btn btn-dark" href="<?=base_url('pantalon')?>">
                    <ion-icon name="add-outline"></ion-icon>
                    <span>Pantalon</span>
                </a>
            </li>
            <li>
                <a class="btn btn-dark" href="<?=base_url('falda')?>">
                    <ion-icon name="add-outline"></ion-icon>
                    <span>Falda</span>
                </a>
            </li>
            <li>
                <a class="btn btn-dark" href="<?=base_url('producto')?>">
                    <ion-icon name="add-outline"></ion-icon>
                    <span>Subir Traje</span>
                </a>
            </li>
        </ul>
    </nav>

    <div>
        <div class="linea"></div>
        <div class="modo-oscuro">
            <div class="info">
                <ion-icon name="moon-outline"></ion-icon>
                <span></span>
            </div>
            <div class="switch">
                <div class="base">
                    <div class="circulo"></div>
                </div>
            </div>
        </div>

        <div class="usuario">
            <img src="<?= base_url('img/Jhampier.jpg') ?>" alt="">
            <div class="info-usuario">
                <div class="nombre-email">
                    <span class="nombre">Jhampier</span>
                    <span class="email">jhampier@gmail.com</span>
                </div>
                <ion-icon name="ellipsis-vertical-outline"></ion-icon>
            </div>
        </div>
    </div>
</div>

<main>
    <nav>
        <a class="btn btn-dark" href="<?=base_url('cliente')?>">Cliente</a>
        <a class="btn btn-dark" href="<?=base_url('datosFalda')?>">Falda</a>
        <a class="btn btn-dark" href="<?=base_url('datosTrajeMasculino')?>">Traje Masculino</a>
        <a class="btn btn-dark" href="<?=base_url('datosTrajeFemenino')?>">Traje Femenino</a>
        <a class="btn btn-dark" href="<?=base_url('datosPantalon')?>">Pantalon</a>
    </nav>

    <div class="container mt-4">
        <h1>Clientes</h1>
        <div class="input-group mb-3">
            <input type="text" id="search" class="form-control" placeholder="Buscar clientes...">
        </div>
        <!-- Es el filtro para buscar a los clientes -->
        <table class="table table-light mb-3" id="clientesTable"> <!-- agregamos id para buscar en la tabla con el filtro -->
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Sexo</th>
                    <th>Celular</th>
                    <th>Pagado</th>
                    <th id="fechaRegistro" class="sortable" data-sort="fechaRegistro">Fecha Registro<span class="sort-icon"></span></th>
                    <th>Fecha Actualizacion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($clientes as $Cliente): ?>
                    <tr>
                        <td><?=$Cliente['id'];?></td>
                        <td><?=$Cliente['nombre'];?></td>
                        <td><?=$Cliente['apellido'];?></td>
                        <td><?= ($Cliente['sexo'] === 'M') ? 'Masculino' : 'Femenino'; ?></td>
                        <td><?=$Cliente['celular'];?></td>
                        <td id="pagoCell"><?= ($Cliente['pago'] === null || $Cliente['pago'] === '0') ? '<span style="color: red;">Falta pagar</span>' : $Cliente['pago'] . ' Bs'; ?></td>
                        <td><?=$Cliente['fechaRegistro'];?></td>
                        <td><?=$Cliente['fechaActualizacion'];?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?= base_url('editar/' . $Cliente['id']); ?>" class="btn btn-outline-primary" style="margin-right: 2px;">Editar</a>
                                <a href="<?= base_url('borrar/' . $Cliente['id']); ?>" class="btn btn-outline-danger" style="margin-right: 2px;" onclick="confirmDelete(event, '<?= $Cliente['id']; ?>');">Borrar</a>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>


<?=$pie?>