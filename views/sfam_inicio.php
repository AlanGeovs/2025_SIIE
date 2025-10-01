<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../config/db.php';

//redirigirSiNoLogeado();
$title = 'Anticipo - Sistema de Fondo de Aportaciones Múltiples';
include __DIR__ . '/../templates/header_sfam.php';
?>
<!-- <div class="container mt-4 mb-5">
    <div class="border rounded p-3 shadow-sm bg-light ">
        <div class="d-flex flex-wrap gap-3 align-items-baseline  ">
            <span class="fw-semibold text-dark"><strong>Entidad:</strong> <?= $_SESSION['entidad'] ?? 'Entidad' ?></span> |
            <span class="fw-semibold text-dark"><strong>CCT:</strong> <?= $_SESSION['cct'] ?? 'CCT' ?></span>
        </div>
        <div class="d-flex flex-wrap gap-1 align-items-baseline  ">
            <span class="fw-semibold text-dark"><strong>Municipio:</strong> <?= $_SESSION['municipio'] ?? 'Municipio' ?></span> |
            <span class="fw-semibold text-dark"><strong>Nombre del plantel:</strong> <?= $_SESSION['nombre'] ?? 'Usuario' ?></span> |
            <span class="fw-semibold text-dark"><strong>Nivel educativo:</strong> <?= $_SESSION['nivel_educativo'] ?? 'Nivel' ?></span> |
            <span class="fw-semibold text-dark"><strong>Turno:</strong> <?= $_SESSION['turno'] ?? 'Turno' ?></span> |
            <span class="fw-semibold text-dark"><strong>Dirección:</strong> <?= $_SESSION['domicilio'] ?? '' ?> <?= $_SESSION['n_ext'] ?? '' ?></span>
        </div>
    </div>
</div> -->


<div class="container mt-5">
    <h4 class="mb-4">Registro de Anticipo</h4>
    <form id="formAnticipo" method="POST" action="../includes/guardar_sfam_anticipo.php">
        <div class="mb-3">
            <label for="cct" class="form-label">CCT</label>
            <input type="text" class="form-control" id="cct" name="cct" placeholder="Escriba el CCT y presione Enter para autocompletar los datos." required>

        </div>


        <div id="datosPlantel" class="mb-3">
            <!-- Aquí se llenarán automáticamente los datos del plantel desde la base de datos -->
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="tipo-recurso" class="form-label">Tipo de recurso</label>
                <select class="form-control" name="procedimiento">
                    <option value="">Seleccione una opción</option>
                    <option value="fam-regularto">FAM Regular</option>
                    <option value="fondo-sep">Fondo SEP</option>
                    <option value="mantenimiento">Mantenimiento</option>
                    <option value="anexoa">Recursos de Monetización (Anexo A)</option>
                    <option value="rendimiento">Rendimientos Fianancieros (Anexo Plus)</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="no_contrato" class="form-label">No. Contrato</label>
                <input type="text" class="form-control" name="no_contrato" maxlength="50">
            </div>
            <div class="col-md-4">
                <label for="procedimiento" class="form-label">Procedimiento de Adjudicación</label>
                <select class="form-control" name="procedimiento">
                    <option value="">Seleccione una opción</option>
                    <option value="Licitación Pública (LP)">Licitación Pública (LP)</option>
                    <option value="Adjudicación directa (AD)">Adjudicación directa (AD)</option>
                    <option value="Invitación de 3 personas (R3)">Invitación a por lo menos 3 personas (IR3)</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="monto_contrato" class="form-label">Monto del Contrato</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" step="0.01" name="monto_contrato" id="monto_contrato" required>
                </div>
            </div>
            <div class="col-md-6">
                <label for="fecha_firma" class="form-label">Fecha de Firma</label>
                <input type="date" class="form-control" name="fecha_firma" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Plazo de Ejecución</label>
            <div class="input-group">
                <input type="date" class="form-control" name="plazo_inicio">
                <span class="input-group-text">al</span>
                <input type="date" class="form-control" name="plazo_fin">
            </div>
        </div>

        <!-- Crear campo de objeto como checobox radios  
        Seguridad estructura
        sanitarios
        Bebederos
        Mobiliario y equipamo
        Accesibilidad
        Servicios Administrativos
        Conectividad    
        Espacios de usos múltiples        
         -->
        <div class="mb-4">
            <label class="form-label">Componentes a intervenir</label>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="componente_seguridad" name="campo_objeto" value="Seguridad estructura" required>
                        <label class="form-check-label" for="componente_seguridad">Seguridad estructural</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="componente_sanitarios" name="campo_objeto" value="Sanitarios">
                        <label class="form-check-label" for="componente_sanitarios">Sanitarios</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="componente_bebederos" name="campo_objeto" value="Bebederos">
                        <label class="form-check-label" for="componente_bebederos">Bebederos</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="componente_mobiliario" name="campo_objeto" value="Mobiliario y equipamiento">
                        <label class="form-check-label" for="componente_mobiliario">Mobiliario y equipamiento</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="componente_accesibilidad" name="campo_objeto" value="Accesibilidad">
                        <label class="form-check-label" for="componente_accesibilidad">Accesibilidad</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="componente_servicios" name="campo_objeto" value="Servicios Administrativos">
                        <label class="form-check-label" for="componente_servicios">Servicios administrativos</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="componente_conectividad" name="campo_objeto" value="Conectividad">
                        <label class="form-check-label" for="componente_conectividad">Conectividad</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="componente_espacios" name="campo_objeto" value="Espacios de usos múltiples">
                        <label class="form-check-label" for="componente_espacios">Espacios de usos múltiples</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="objeto" class="form-label">Componentes a intervenir</label>
            <input type="text" class="form-control" name="objeto">
        </div>

        <div class="mb-3">
            <label class="form-label">¿Renuncia al Anticipo?</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="renuncia" value="SI" id="renuncia_si"> <label class="form-check-label">SI</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="renuncia" value="NO" id="renuncia_no" checked> <label class="form-check-label">NO</label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label>Anticipo (IVA incluido)</label>
                <input type="text" class="form-control" id="anticipo" readonly>
            </div>
            <div class="col-md-3">
                <label>2% OR INFE</label>
                <input type="text" class="form-control" id="or_infe" readonly>
            </div>
            <div class="col-md-3">
                <label>2% INIFED</label>
                <input type="text" class="form-control" id="inifed" readonly>
            </div>
            <div class="col-md-3">
                <label>Total (IVA incluido)</label>
                <input type="text" class="form-control" id="total" readonly>
            </div>
        </div>

        <!-- <div class="mb-3">
            <label>Total con letra</label>
            <input type="text" class="form-control" id="total_letra" readonly>
        </div> -->

        <hr class="mt-4 mb-4">
        <p>
            <b>Datos del contratista</b>
        </p>
        <div class="row mb-3">
            <div class="col-md-6 mb-3">
                <label for="razon_social" class="form-label">Nombre o Razón Social</label>
                <input type="text" class="form-control" name="razon_social">
            </div>

            <div class="col-md-6 mb-3">
                <label for="representante" class="form-label">Nombre del Representante Legal</label>
                <input type="text" class="form-control" name="representante">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>



<?php include __DIR__ . '/../templates/footer_sfam.php'; ?>

<script>
    function formatCurrency(value) {
        return new Intl.NumberFormat('es-MX', {
            style: 'currency',
            currency: 'MXN',
            minimumFractionDigits: 2
        }).format(value);
    }

    function numberToWords(value) {
        const UNIDADES = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve'];
        const DECENAS = ['', 'diez', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
        const CENTENAS = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

        function convertirGrupo(n) {
            let output = '';
            if (n == 100) return 'cien';
            if (n > 99) {
                output += CENTENAS[Math.floor(n / 100)] + ' ';
                n = n % 100;
            }
            if (n > 9) {
                if (n < 20) {
                    const especiales = ['diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
                    return output + especiales[n - 10];
                } else {
                    output += DECENAS[Math.floor(n / 10)];
                    if (n % 10 > 0) {
                        output += ' y ' + UNIDADES[n % 10];
                    }
                    return output;
                }
            } else {
                output += UNIDADES[n];
                return output;
            }
        }

        function convertirNumero(num) {
            if (num === 0) return 'cero';

            const partes = [];
            const millones = Math.floor(num / 1000000);
            const miles = Math.floor((num % 1000000) / 1000);
            const cientos = num % 1000;

            if (millones > 0) {
                if (millones === 1) partes.push('un millón');
                else partes.push(convertirGrupo(millones) + ' millones');
            }

            if (miles > 0) {
                if (miles === 1) partes.push('mil');
                else partes.push(convertirGrupo(miles) + ' mil');
            }

            if (cientos > 0) {
                partes.push(convertirGrupo(cientos));
            }

            return partes.join(' ').trim();
        }

        return convertirNumero(Math.round(value)) + ' pesos';
    }

    document.getElementById('monto_contrato').addEventListener('input', function() {
        const rawValue = parseFloat(this.value.replace(/,/g, ''));
        if (isNaN(rawValue)) {
            document.getElementById('total_letra').value = '';
            return;
        }

        const anticipo = rawValue * 0.30;
        const or_infe = rawValue * 0.02;
        const inifed = rawValue * 0.02;
        const total = anticipo + or_infe + inifed;

        document.getElementById('anticipo').value = formatCurrency(anticipo);
        document.getElementById('or_infe').value = formatCurrency(or_infe);
        document.getElementById('inifed').value = formatCurrency(inifed);
        document.getElementById('total').value = formatCurrency(total);
        document.getElementById('total_letra').value = numberToWords(total).toUpperCase() + ' MXN';
    });

    function recalcularTotales() {
        const montoInput = document.getElementById('monto_contrato');
        const rawValue = parseFloat(montoInput.value.replace(/,/g, ''));

        const renunciaSi = document.getElementById('renuncia_si').checked;

        if (isNaN(rawValue)) {
            document.getElementById('anticipo').value = '';
            document.getElementById('or_infe').value = '';
            document.getElementById('inifed').value = '';
            document.getElementById('total').value = '';
            document.getElementById('total_letra').value = '';
            return;
        }

        const anticipo = renunciaSi ? 0 : rawValue * 0.30;
        const or_infe = rawValue * 0.02;
        const inifed = rawValue * 0.02;
        const total = anticipo + or_infe + inifed;

        document.getElementById('anticipo').value = formatCurrency(anticipo);
        document.getElementById('or_infe').value = formatCurrency(or_infe);
        document.getElementById('inifed').value = formatCurrency(inifed);
        document.getElementById('total').value = formatCurrency(total);
        document.getElementById('total_letra').value = numberToWords(total).toUpperCase() + ' MXN';
    }

    document.getElementById('monto_contrato').addEventListener('blur', recalcularTotales);
    document.getElementById('renuncia_si').addEventListener('change', recalcularTotales);
    document.getElementById('renuncia_no').addEventListener('change', recalcularTotales);
</script>