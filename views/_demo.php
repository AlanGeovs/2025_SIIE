<?php
echo password_verify("demo", 'copiar_aqui_el_hash_generado') ? 'OK' : 'NOPE';



            <!-- Sección 2.2 Áreas adicionales -->
            <div id="tabla_areas_adicionales" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.2 Identifique las áreas adicionales dañados</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Área</th>
                                <th style="background-color:#E9E9E9;">Grado de daño</th>
                                <th style="background-color:#E9E9E9;">Cálculo de daño</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (CATALOGO_AREAS_ADICIONALES as $area): ?>
                                <tr>
                                    <td><?= $area ?></td>
                                    <td>
                                        <select name='areas_adicionales[<?= $area ?>][tipo]' class='form-select tipo-danio'>
                                            <option value=''>Selecciona</option>
                                            <option value='leve'>Leve</option>
                                            <option value='moderado'>Moderado</option>
                                            <option value='grave'>Grave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class='form-select cantidad-danio' name='areas_adicionales[<?= $area ?>][cantidad]' disabled required>
                                            <option value=''>Selecciona</option>
                                            <?php for ($i = 1; $i <= 100; $i++): ?>
                                                <option value='<?= $i ?>'><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label class="btn btn-evidencia w-100 disabled-label">
                                            Agrega evidencia
                                            <input type='file' name='areas_adicionales[<?= $area ?>][evidencia]' class='evidencia-input' style='display:none;' disabled>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Sección 2.3 Mobiliario -->
            <div id="tabla_mobiliario" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.3 Identifique lasl mobiliario dañado</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Mobiliario</th>
                                <th style="background-color:#E9E9E9;">Grado de daño</th>
                                <th style="background-color:#E9E9E9;">Cálculo de daño</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (CATALOGO_MOBILIARIO as $item): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td>
                                        <select name='mobiliario[<?= $item ?>][tipo]' class='form-select'>
                                            <option value=''>Selecciona</option>
                                            <option value='leve'>Leve</option>
                                            <option value='moderado'>Moderado</option>
                                            <option value='grave'>Grave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class='form-select cantidad-danio' name='mobiliario[<?= $item ?>][cantidad]' disabled required>
                                            <option value=''>Selecciona</option>
                                            <?php for ($i = 1; $i <= 100; $i++): ?>
                                                <option value='<?= $i ?>'><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label class="btn btn-evidencia w-100 disabled-label">
                                            Agrega evidencia
                                            <input type='file' name='mobiliario[<?= $item ?>][evidencia]' class='evidencia-input' style='display:none;' disabled>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Sección 2.4 Equipo dañado -->
            <div id="tabla_equipo" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.4 Identifique lasl equipo de cómputo dañado</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Equipo</th>
                                <th style="background-color:#E9E9E9;">Grado de daño</th>
                                <th style="background-color:#E9E9E9;">Cálculo de daño</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (CATALOGO_EQUIPO as $item): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td>
                                        <select name='equipo[<?= $item ?>][tipo]' class='form-select'>
                                            <option value=''>Selecciona</option>
                                            <option value='leve'>Leve</option>
                                            <option value='moderado'>Moderado</option>
                                            <option value='grave'>Grave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class='form-select cantidad-danio' name='equipo[<?= $item ?>][cantidad]' disabled required>
                                            <option value=''>Selecciona</option>
                                            <?php for ($i = 1; $i <= 100; $i++): ?>
                                                <option value='<?= $i ?>'><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label class="btn btn-evidencia w-100 disabled-label">
                                            Agrega evidencia
                                            <input type='file' name='equipo[<?= $item ?>][evidencia]' class='evidencia-input' style='display:none;' disabled>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Sección 2.5 Áreas comunes (sin zona) -->
            <div id="tabla_areas_comunes" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.5 Identifique las las áreas comunes dañados</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Área común</th>
                                <th style="background-color:#E9E9E9;">Grado de daño</th>
                                <th style="background-color:#E9E9E9;">Cálculo de daño</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (CATALOGO_AREAS_COMUNES as $item): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td>
                                        <select name='areas_comunes[<?= $item ?>][tipo]' class='form-select'>
                                            <option value=''>Selecciona</option>
                                            <option value='leve'>Leve</option>
                                            <option value='moderado'>Moderado</option>
                                            <option value='grave'>Grave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class='form-select cantidad-danio' name='areas_comunes[<?= $item ?>][cantidad]' disabled required>
                                            <option value=''>Selecciona</option>
                                            <?php for ($i = 1; $i <= 100; $i++): ?>
                                                <option value='<?= $i ?>'><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label class="btn btn-evidencia w-100 disabled-label">
                                            Agrega evidencia
                                            <input type='file' name='areas_comunes[<?= $item ?>][evidencia]' class='evidencia-input' style='display:none;' disabled>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Sección 2.6 Elementos (sin zona) -->
            <div id="tabla_elementos" class="mb-5">
                <h4 class="mb-3" style="color: #691C32;">2.6 Identifique las los elementos dañados</h4>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#E9E9E9;">
                            <tr>
                                <th style="background-color:#691C32; color:white; font-size: 1.25em;">Elemento</th>
                                <th style="background-color:#E9E9E9;">Grado de daño</th>
                                <th style="background-color:#E9E9E9;">Cálculo de daño</th>
                                <th style="background-color:#E9E9E9;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (CATALOGO_ELEMENTOS as $item): ?>
                                <tr>
                                    <td><?= $item ?></td>
                                    <td>
                                        <select name='elementos[<?= $item ?>][tipo]' class='form-select'>
                                            <option value=''>Selecciona</option>
                                            <option value='leve'>Leve</option>
                                            <option value='moderado'>Moderado</option>
                                            <option value='grave'>Grave</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class='form-select cantidad-danio' name='elementos[<?= $item ?>][cantidad]' disabled required>
                                            <option value=''>Selecciona</option>
                                            <?php for ($i = 1; $i <= 100; $i++): ?>
                                                <option value='<?= $i ?>'><?= $i ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <label class="btn btn-evidencia w-100 disabled-label">
                                            Agrega evidencia
                                            <input type='file' name='elementos[<?= $item ?>][evidencia]' class='evidencia-input' style='display:none;' disabled>
                                        </label>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>