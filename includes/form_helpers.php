<?php
// incluye catalogos de áreas, equipos, etc.
include_once __DIR__ . '/../config/catalogos.php';

function generarTablaDanos($catalogo, $tituloTabla)
{
    echo "<h4>$tituloTabla</h4>";
    echo "<table class='table table-bordered text-center'>";
    echo "<thead><tr>
        <th>Elemento</th>
        <th>Número dañado</th>
        <th>Zona de ubicación</th>
        <th>Grado de daño</th>
    </tr></thead><tbody>";

    foreach ($catalogo as $item) {
        echo "<tr>";
        echo "<td>{$item}</td>";
        echo "<td><input type='number' name='cantidad_{$item}' class='form-control'></td>";
        echo "<td><input type='text' name='zona_{$item}' class='form-control'></td>";
        echo "<td>
                <select name='tipo_{$item}' class='form-select'>
                    <option value=''>Selecciona</option>
                    <option value='Leve'>Leve</option>
                    <option value='Moderado'>Moderado</option>
                    <option value='Grave'>Grave</option>
                </select>
              </td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
}
