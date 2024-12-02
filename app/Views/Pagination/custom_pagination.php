<nav aria-label="Paginación">
    <ul class="pagination justify-content-center">
        <!-- Botón para la primera página -->
        <?php if ($pager->hasPreviousPage()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() ?>">Primero</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>">Anterior</a>
            </li>
        <?php endif; ?>

        <!-- Enlaces de las páginas -->
        <?php foreach ($pager->links() as $link): ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach; ?>

        <!-- Botón para la última página -->
        <?php if ($pager->hasNextPage()): ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPage() ?>">Siguiente</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() ?>">Último</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
