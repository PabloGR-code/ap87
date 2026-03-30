<h1>Editar Vehículo</h1>

<form method="POST">

<input name="marca" value="<?= $vehiculo->getMarca() ?>">
<input name="modelo" value="<?= $vehiculo->getModelo() ?>">
<input name="matricula" value="<?= $vehiculo->getMatricula() ?>">
<input name="precioDia" value="<?= $vehiculo->getPrecioDia() ?>">

<?php if ($vehiculo instanceof Coche): ?>
    <input name="numeroPuertas" value="<?= $vehiculo->getNumeroPuertas() ?>">
    <input name="tipoCombustible" value="<?= $vehiculo->getTipoCombustible() ?>">
<?php else: ?>
    <input name="cilindrada" value="<?= $vehiculo->getCilindrada() ?>">
    <input type="checkbox" name="incluyeCasco" <?= $vehiculo->getIncluyeCasco() ? 'checked' : '' ?>>
<?php endif; ?>

<button type="submit">Actualizar</button>
</form>