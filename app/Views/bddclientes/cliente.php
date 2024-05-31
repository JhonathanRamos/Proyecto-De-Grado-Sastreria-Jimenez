<?=$cabecera?>

<header class="header">
    <div class="container">
        <div class="btn-menu">
            <label for="btn-menu">☰</label>
        </div>
        <nav class="menu">
            <a class="btn btn-dark" href="<?=base_url('cliente')?>">Cliente</a>
            <a class="btn btn-dark" href="<?=base_url('datosFalda')?>">Falda</a>
            <a class="btn btn-dark" href="<?=base_url('datosTrajeMasculino')?>">Traje Masculino</a>
            <a class="btn btn-dark" href="<?=base_url('datosTrajeFemenino')?>">Traje Femenino</a>
            <a class="btn btn-dark" href="<?=base_url('datosPantalon')?>">Pantalon</a>
        </nav>
    </div>
</header>
<div class="capa"></div>
<input type="checkbox" id="btn-menu">
<div class="container-menu">
    <div class="cont-menu">
        <nav>
            <a class="btn btn-success" href="<?=base_url('crear')?>">Crear Clientes</a>
            <a class="btn btn-dark" href="<?=base_url('trajeMasculino')?>">Traje Masculino</a>
            <a class="btn btn-dark" href="<?=base_url('trajeFemenino')?>">Traje Femenino</a>
            <a class="btn btn-dark" href="<?=base_url('pantalon')?>">Pantalon</a>
            <a class="btn btn-dark" href="<?=base_url('falda')?>">Falda</a>
            <a class="btn btn-dark" href="<?=base_url('producto')?>">Subir Traje</a>
        </nav>
        <label for="btn-menu">✖️</label>
    </div>
</div>

<div class="container mt-4">
    <h1>Clientes</h1>

    --
    <div class="input-group mb-3">
        <input type="text" id="search" class="form-control" placeholder="Buscar clientes...">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="btn-search">Buscar</button>
        </div>
    </div>
    -- Es el filtro para buscar a los clientes
    
    <table class="table table-light" id="clientesTable"> -- agregamos id para buscar en la tabla con el filtro
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Sexo</th>
                <th>Celular</th>
                <th>Pagado</th>
                <th>Fecha Registro</th>
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
                            <a href="<?= base_url('borrar/' . $Cliente['id']); ?>" class="btn btn-outline-danger" style="margin-right: 2px;">Borrar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?=$pie?>

<script>
document.getElementById('btn-search').addEventListener('click', function() {
    var input = document.getElementById('search');
    var filter = input.value.toLowerCase();
    var table = document.getElementById('clientesTable');
    var tr = table.getElementsByTagName('tr');
    
    for (var i = 1; i < tr.length; i++) {  // Empieza desde 1 para omitir el encabezado
        var td = tr[i].getElementsByTagName('td');
        var found = false;
        
        for (var j = 0; j < td.length; j++) {
            if (td[j]) {
                var txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;  // Salir del bucle si encuentra coincidencia
                }
            }
        }
        
        if (found) {
            tr[i].style.display = '';
        } else {
            tr[i].style.display = 'none';
        }
    }
});
</script>