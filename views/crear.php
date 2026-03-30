<h1>Crear Vehículo</h1>

<form method="POST">

<select name="tipoVehiculo">
    <option value="Coche">Coche</option>
    <option value="Motocicleta">Motocicleta</option>
</select>

<input name="marca" placeholder="Marca">
<input name="modelo" placeholder="Modelo">
<input name="matricula" placeholder="Matrícula">
<input name="precioDia" placeholder="Precio">

<h3>Coche</h3>
<input name="numeroPuertas" placeholder="Puertas">
<input name="tipoCombustible" placeholder="Combustible">

<h3>Moto</h3>
<input name="cilindrada" placeholder="Cilindrada">
<label><input type="checkbox" name="incluyeCasco"> Casco</label>

<button type="submit">Guardar</button>
</form>