<?php
// Documentación API
$title = "Documentación API";
require_once __DIR__ . '/../templates/header.php';
?>

<style>
    .doc-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 24px;
    }

    @media (max-width: 991.98px) {
        .doc-layout {
            display: block;
        }
    }

    .doc-sidenav {
        position: sticky;
        top: 90px;
        align-self: start;
    }

    .doc-sidenav .list-group-item {
        border: 0;
        padding-left: 0;
        background: transparent;
    }

    .doc-sidenav .list-group-item a {
        text-decoration: none;
        color: #691C32;
    }

    .doc-sidenav .list-group-item a:hover {
        text-decoration: underline;
    }

    .doc-section h3 {
        color: #691C32;
        margin-top: 1.25rem;
    }

    .doc-section h4 {
        color: #9F2241;
        margin-top: 1rem;
    }

    pre.code {
        background: #0b0f19;
        color: #e6e6e6;
        padding: 16px;
        border-radius: 8px;
        overflow: auto;
        font-size: 0.95rem;
    }

    code.inline {
        background: #f6f8fa;
        padding: 2px 6px;
        border-radius: 4px;
    }

    .badge-method {
        font-weight: 600;
        letter-spacing: .02em;
    }

    .badge-get {
        background: #e8eef5;
        color: #13345b;
    }
</style>

<main class="container my-4">
    <div class="mb-4 text-center">
        <h2 class="text-uppercase fw-bold" style="color:#691C32;">Documentación de la API</h2>
        <p class="text-muted m-0">Base URL: <code class="inline">https://sia.inifed.mx/api</code></p>
    </div>

    <div class="doc-layout">
        <!-- Sidebar -->
        <nav class="doc-sidenav">
            <div class="list-group">
                <div class="list-group-item"><a href="#overview">1. Introducción</a></div>
                <div class="list-group-item"><a href="#auth">2. Acceso y uso</a></div>
                <div class="list-group-item"><a href="#reporte">3. /reporte/{id}</a></div>
                <div class="list-group-item"><a href="#global">4. /global</a></div>
                <div class="list-group-item"><a href="#pdf">5. /pdf/{id}</a></div>
                <div class="list-group-item"><a href="#ejemplos">6. Ejemplos (cURL / Postman)</a></div>
                <div class="list-group-item"><a href="#respuestas">7. Estructuras de respuesta</a></div>
            </div>
        </nav>

        <!-- Content -->
        <div>
            <section id="overview" class="doc-section">
                <h3>1. Introducción</h3>
                <p>
                    Esta API expone información de reportes del <strong>Sistema de Infraestructura Educativa (SIIE)</strong>.
                    Está organizada en tres endpoints principales para consultar un reporte puntual, obtener un conjunto
                    de reportes consolidados y abrir el PDF oficial de cada reporte.
                </p>
                <ul>
                    <li><code class="inline">GET /api/reporte/{id}</code> &mdash; Obtiene el detalle (JSON) de un reporte por su <em>id</em>.</li>
                    <li><code class="inline">GET /api/global</code> &mdash; Devuelve todos los reportes consolidados en JSON.</li>
                    <li><code class="inline">GET /api/pdf/{id}</code> &mdash; Redirige al PDF oficial del reporte.</li>
                </ul>
            </section>

            <section id="auth" class="doc-section">
                <h3>2. Acceso y uso</h3>
                <p>
                    Los endpoints <em>GET</em> pueden consultarse desde el navegador, con herramientas como Postman o vía cURL.
                    Si en el futuro se requiere restricción adicional, se podrá incluir autenticación por sesión o token.
                </p>
                <p class="mb-1"><strong>Formato de respuesta:</strong> JSON (salvo <code class="inline">/pdf/{id}</code>, que redirige al visor de PDF).</p>
                <p class="mb-1"><strong>Códigos de estado:</strong> <code class="inline">200</code> éxito, <code class="inline">404</code> no encontrado, <code class="inline">500</code> error del servidor.</p>
            </section>

            <section id="reporte" class="doc-section">
                <h3>3. Endpoint: <span class="badge badge-method badge-get">GET</span> /reporte/{id}</h3>
                <p>
                    Devuelve un objeto JSON con los datos del siniestro (tabla <code class="inline">siniestros</code>) y los datos del plantel
                    relacionados vía <code class="inline">cct</code> (tabla <code class="inline">planteles</code>: nombre, entidad, nivel_educativo, municipio, domicilio, n_ext, cp, longitud, latitud).
                </p>
                <p><strong>URL:</strong> <code class="inline">/api/reporte/&lt;id&gt;</code></p>
                <p><strong>Ejemplo:</strong> <code class="inline">/api/reporte/1281</code></p>
            </section>

            <section id="global" class="doc-section">
                <h3>4. Endpoint: <span class="badge badge-method badge-get">GET</span> /global</h3>
                <p>
                    Devuelve un arreglo JSON con todos los reportes, consolidando las tablas de detalle mediante
                    <code class="inline">GROUP_CONCAT</code> (áreas principales, comunes, adicionales, elementos, equipo y mobiliario),
                    ordenados por <code class="inline">id</code> descendente.
                </p>
                <p><strong>URL:</strong> <code class="inline">/api/global</code></p>
            </section>

            <section id="pdf" class="doc-section">
                <h3>5. Endpoint: <span class="badge badge-method badge-get">GET</span> /pdf/{id}</h3>
                <p>
                    Redirige al PDF oficial del reporte generado por el sistema SIA.
                </p>
                <p><strong>URL:</strong> <code class="inline">/api/pdf/&lt;id&gt;</code></p>
                <p><strong>Ejemplo:</strong> <code class="inline">/api/pdf/1281</code></p>
            </section>

            <section id="ejemplos" class="doc-section">
                <h3>6. Ejemplos (cURL / Postman)</h3>
                <h4>6.1. Obtener reporte por id</h4>
                <pre class="code">curl -X GET "https://sia.inifed.mx/api/reporte/1281" -H "Accept: application/json"</pre>

                <h4>6.2. Obtener el consolidado global</h4>
                <pre class="code">curl -X GET "https://sia.inifed.mx/api/global" -H "Accept: application/json"</pre>

                <h4>6.3. Abrir PDF de un reporte</h4>
                <pre class="code">curl -L "https://sia.inifed.mx/api/pdf/1281"</pre>
                <p class="mt-2">
                    En <strong>Postman</strong>, crea una nueva petición <em>GET</em>, pega la URL correspondiente y observa la respuesta JSON
                    en la pestaña <em>Body</em> ▶ <em>Pretty</em>. Para el PDF, Postman seguirá la redirección y podrás visualizar el documento en el navegador.
                </p>
            </section>

            <section id="respuestas" class="doc-section">
                <h3>7. Estructuras de respuesta (JSON)</h3>
                <h4>7.1. Respuesta de <code class="inline">/reporte/{id}</code></h4>
                <pre class="code">{
  "id": 1281,
  "cct": "20DPR0001A",
  "creado": "2025-09-08 15:40:00",
  "tipo_siniestro": "Huracán",
  "nivel_atencion": "estatal",
  "brigadas_activadas": "rescate, evacuacion",
  "descripcion": "Breve descripción del siniestro...",
  "nombre": "Primaria Benito Juárez",
  "entidad": "OAXACA",
  "nivel_educativo": "Primaria",
  "municipio": "Oaxaca de Juárez",
  "domicilio": "Av. Principal",
  "n_ext": "123",
  "cp": "68000",
  "longitud": -96.721,
  "latitud": 17.059
}</pre>

                <h4>7.2. Respuesta de <code class="inline">/global</code> (arreglo de objetos)</h4>
                <pre class="code">[
  {
    "cct": "20DPR0001A",
    "nombre": "Primaria Benito Juárez",
    "nivel_educativo": "Primaria",
    "entidad": "OAXACA",
    "municipio": "Oaxaca de Juárez",
    "localidad": "Centro",
    "turno": "Matutino",
    "domicilio": "Av. Principal",
    "n_ext": "123",
    "cp": "68000",
    "id_siniestro": 1281,
    "fecha_reporte": "2025-09-08 15:40:00",
    "tipo_siniestro": "Huracán",
    "nivel_atencion": "estatal",
    "brigadas_activadas": "rescate, evacuacion",
    "areas_principales": "Salón - Grave - 2 | Baño - Moderado - 1",
    "areas_comunes": "Plaza cívica - Leve - 1",
    "areas_adicionales": "Laboratorio - Moderado - 1",
    "elementos": "Barda perimetral - Grave - 1",
    "equipo": "Computadora portátil - Moderado - 3",
    "mobiliario": "Mesa-banco - Leve - 10"
  },
  { /* ... más objetos ... */ }
]</pre>

                <h4>7.3. Errores</h4>
                <pre class="code">{
  "error": "Ruta no válida"
}
</pre>
            </section>

        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>