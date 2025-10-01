<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once __DIR__ . '/../config/db.php';
global $pdo;

$title = "Dashboard";
require_once __DIR__ . '/../templates/header.php';

session_start();
if (!isset($_SESSION['correo'])) {
    header("Location: acceso");
    exit();
}

// Mapeo de títulos de módulos
$titulosModulos = [
    1 => "I. DATOS DEL CENTRO DE TRABAJO",
    2 => "II. ACCESIBILIDAD Y SERVICIOS BÁSICOS DEL CENTRO DE TRABAJO",
    3 => "III. DESCRIPCIÓN DE LA INFRAESTRUCTURA DEL CENTRO DE TRABAJO",
    4 => "IV. PROTECCIÓN CIVIL Y SEGURIDAD ESTRUCTURAL",
    5 => "V. INVERSIÓN PÚBLICA",
    6 => "VI. DATOS LEGALES DEL CENTRO DE TRABAJO"
];

$modulo = isset($_POST['modulo']) ? intval($_POST['modulo']) : 1;
if ($modulo < 1 || $modulo > 6) $modulo = 1;
?>


<style>
    .container {
        max-width: 1200px;
        padding-left: .25rem;
        padding-right: .25rem;
        margin: 0 auto;
    }
</style>

<div class="container my-2">



    <!-- Datos de usuario en session  -->
    <!-- <div>
        <h2 class="mb-0">Bienvenido, <?= htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido_p']) . ' id: ' . $_SESSION['usuario_id'] . ' id_ficha:' . $_SESSION['id_ficha'] ?></h2>
        <p class="text-secondary mb-0">Usuario: <?= htmlspecialchars($_SESSION['correo']) ?> | Tipo: <?= htmlspecialchars($_SESSION['tipo_usuario']) ?></p>
    </div> -->

    <div class="d-flex justify-content-center mb-4 flex-wrap gap-2">
        <?php
        $romanNumerals = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI'];
        for ($i = 1; $i <= 6; $i++):
            $isActive = ($i === $modulo);
            $activeClass = $isActive ? 'active' : 'bg-light text-dark';
            $roman = $romanNumerals[$i];
            $titulo = isset($titulosModulos[$i]) ? $titulosModulos[$i] : '';
        ?>
            <form method="post" class="d-inline">
                <input type="hidden" name="modulo" value="<?= $i ?>">
                <button type="submit"
                    class="modulo-circle border-0 p-0 <?= $activeClass ?>"
                    data-bs-toggle="tooltip"
                    title="<?= htmlspecialchars($titulo) ?>">
                    <?= $roman ?>
                </button>
            </form>
        <?php endfor; ?>
    </div>

    <div class="card p-3">
        <?php require_once __DIR__ . '/../templates/modulo_' . $modulo . '.php'; ?>
    </div>



</div>





<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>


<!-- Subir Evidencia -->
<script>
    function inicializarEvidencias() {
        document.querySelectorAll('.evidencia-input').forEach(input => {
            input.addEventListener('change', async function() {
                const file = this.files[0];
                if (!file) return;

                const modulo = this.dataset.modulo || '';
                const cct = "<?= $_SESSION['cct'] ?? '' ?>";
                const idFicha = "<?= (!empty($_SESSION['id_ficha']) && $_SESSION['id_ficha'] != 0) ? $_SESSION['id_ficha'] : 1 ?>"; // asegúrate de tenerlo en sesión 
                const idUsuario = "<?= $_SESSION['usuario_id'] ?? '' ?>";

                if (!cct || !modulo || !idFicha || !idUsuario) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Datos faltantes',
                        text: 'No se pudieron obtener datos necesarios para subir la evidencia.'
                    });
                    this.value = '';
                    return;
                }

                const formData = new FormData();
                formData.append('evidencia', file);
                formData.append('cct', cct);
                formData.append('modulo', modulo);
                formData.append('id_ficha', idFicha);
                formData.append('id_usuario', idUsuario);
                formData.append('nombre_doc', file.name);

                // Feedback de carga
                const loadingSwal = Swal.fire({
                    title: 'Subiendo evidencia...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                try {
                    const resp = await fetch('/controllers/subir_evidencia.php', {
                        method: 'POST',
                        body: formData
                    });
                    const data = await resp.json();
                    Swal.close();

                    if (data.success) {
                        // Previsualizar archivo subido
                        const label = this.closest('label');
                        const existing = label.querySelector('img');
                        if (existing) label.removeChild(existing);

                        const preview = document.createElement('img');
                        preview.src = '/uploads/' + data.filename;
                        preview.alt = 'Vista previa';
                        preview.style.maxHeight = '60px';
                        preview.style.marginTop = '5px';
                        label.appendChild(preview);

                        Swal.fire({
                            icon: 'success',
                            title: 'Evidencia cargada',
                            text: 'La evidencia fue subida correctamente.'
                        });
                    } else {
                        this.value = '';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'No se pudo subir la evidencia.'
                        });
                    }
                } catch (err) {
                    Swal.close();
                    this.value = '';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de red',
                        text: 'No se pudo conectar con el servidor.'
                    });
                }
            });
        });
    }

    // Inicializar evidencias al cargar dashboard
    document.addEventListener('DOMContentLoaded', inicializarEvidencias);
</script>





<?php require_once __DIR__ . '/../templates/footer.php'; ?>