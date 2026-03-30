<h1>Vehículos</h1>

<a href="index.php?accion=crear">Crear vehículo</a>
<a href="index.php?accion=logout">Logout</a>

<table border="1">
<tr>
    <th>Tipo</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Matrícula</th>
    <th>Cilindrada</th>
    <th>Precio</th>
    <th>Acciones</th>
</tr>

<?php foreach ($vehiculos as $v): ?>
<tr>
    <td><?= $v instanceof Coche ? 'Coche' : 'Motocicleta' ?></td>
    <td><?= $v->getMarca() ?></td>
    <td><?= $v->getModelo() ?></td>
    <td><?= $v->getMatricula() ?></td>
    <td>
        <?php if ($v instanceof Motocicleta): ?>
            <?= $v->getCilindrada() ?> cc
        <?php else: ?>
            -
        <?php endif; ?>
    </td>
    <td><?= $v->getPrecioDia() ?></td>
    <td>
        <a href="index.php?accion=editar&id=<?= $v->getId() ?>">Editar</a>
        <a href="index.php?accion=eliminar&id=<?= $v->getId() ?>">Eliminar</a>
    </td>
</tr>
<?php endforeach; ?>

</table>