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
        <br>
        </div>
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
                    <span>Drak Mode</span>
                </div>
                <div class="switch">
                    <div class="base">
                        <div class="circulo">
                            
                        </div>
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
    <nav >
            <a class="btn btn-dark" href="<?=base_url('cliente')?>">Cliente</a>
            <a class="btn btn-dark" href="<?=base_url('datosFalda')?>">Falda</a>
            <a class="btn btn-dark" href="<?=base_url('datosTrajeMasculino')?>">Traje Masculino</a>
            <a class="btn btn-dark" href="<?=base_url('datosTrajeFemenino')?>">Traje Femenino</a>
            <a class="btn btn-dark" href="<?=base_url('datosPantalon')?>">Pantalon</a>
</nav>

<div class="container mt-4">
        <h1>Pantalon</h1>
        <div class="input-group mb-3">
            <input type="text" id="search" class="form-control" placeholder="Buscar clientes...">
        </div>

<table class="table table-light" id="clientesTable">
    <thead class="thead-light">
     
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
    <tbody>
    <?php foreach ($pantalones as $Pantalon): ?>
<tr>
    <td><?= $Pantalon['cliente_id']; ?></td>
    <td><?= $Pantalon['nombre_completo']; ?></td> <!-- Acceder al nombre del cliente relacionado -->
    <td><?= $Pantalon['largo']; ?></td>
    <td><?= $Pantalon['entrepierna']; ?></td>
    <td><?= $Pantalon['cintura']; ?></td>
    <td><?= $Pantalon['cadera']; ?></td>
    <td><?= $Pantalon['pierna']; ?></td>
    <td><?= $Pantalon['rodilla']; ?></td>
    <td><?= $Pantalon['bota']; ?></td>
    <td>
        <div class="btn-group">
            <a href="<?= base_url('editarPantalon/' . $Pantalon['cliente_id']); ?>" class="btn btn-outline-primary" style="margin-right: 2px;">Editar</a>
            <a href="#" class="btn btn-outline-danger" style="margin-right: 2px;" onclick="confirmDeleteDatos(event, '<?= base_url('borrarPantalon/' . $Pantalon['cliente_id']); ?>');">Borrar</a>
        </div>
    </td>
</tr>
<?php endforeach; ?>

    </tbody>
</table>
</div>
</main>

<?=$pie?>
