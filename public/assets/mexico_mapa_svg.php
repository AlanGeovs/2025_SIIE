<?php
header('Content-Type: image/svg+xml; charset=UTF-8');

// 1) DB: obtener conteos por estado
require_once dirname(__DIR__, 2) . '/config/db.php';
global $pdo;

$conteosRaw = []; // 'AGUASCALIENTES' => 123
try {
    $sql = "
        SELECT UPPER(TRIM(p.entidad)) AS entidad, COUNT(*) AS total
        FROM siniestros s
        LEFT JOIN planteles p ON p.cct = s.cct
        GROUP BY UPPER(TRIM(p.entidad))
    ";
    $stmt = $pdo->query($sql);
    foreach ($stmt as $r) {
        $conteosRaw[$r['entidad']] = (int)$r['total'];
    }
} catch (Throwable $e) {
    // Si falla la DB, seguimos pero sin colorear (todo gris claro)
    $conteosRaw = [];
}

// 2) Utilidades para normalizar nombres y mezclar colores
function normalize_name(string $s): string
{
    $s = trim(mb_strtoupper($s, 'UTF-8'));
    // Quitar acentos
    $s = strtr($s, [
        'Á' => 'A',
        'É' => 'E',
        'Í' => 'I',
        'Ó' => 'O',
        'Ú' => 'U',
        'Ü' => 'U',
        'Ñ' => 'N',
    ]);
    // Compactar espacios
    $s = preg_replace('/\s+/', ' ', $s);
    return $s;
}
function hex_to_rgb(string $hex): array
{
    $hex = ltrim($hex, '#');
    if (strlen($hex) === 3) $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    return [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
}
function rgb_to_hex(array $rgb): string
{
    return sprintf('#%02x%02x%02x', max(0, min(255, $rgb[0])), max(0, min(255, $rgb[1])), max(0, min(255, $rgb[2])));
}
function lerp_color(string $fromHex, string $toHex, float $t): string
{
    $a = hex_to_rgb($fromHex);
    $b = hex_to_rgb($toHex);
    return rgb_to_hex([
        (int) round($a[0] + ($b[0] - $a[0]) * $t),
        (int) round($a[1] + ($b[1] - $a[1]) * $t),
        (int) round($a[2] + ($b[2] - $a[2]) * $t),
    ]);
}

// 3) Códigos del mapa → nombre oficial (coinciden con la mayoría de SVGs por estado)
// Soportamos ids como MXAGU o MX-AGU (aceptaremos el guión opcional más abajo)
$mxNames = [
    'MXAGU' => 'AGUASCALIENTES',
    'MXBCN' => 'BAJA CALIFORNIA',
    'MXBCS' => 'BAJA CALIFORNIA SUR',
    'MXCAM' => 'CAMPECHE',
    'MXCHH' => 'CHIHUAHUA',
    'MXCHP' => 'CHIAPAS',
    'MXCMX' => 'CIUDAD DE MÉXICO',
    'MXCOA' => 'COAHUILA',
    'MXCOL' => 'COLIMA',
    'MXDUR' => 'DURANGO',
    'MXGRO' => 'GUERRERO',
    'MXGUA' => 'GUANAJUATO',
    'MXHID' => 'HIDALGO',
    'MXJAL' => 'JALISCO',
    'MXMEX' => 'MÉXICO',
    'MXMIC' => 'MICHOACÁN',
    'MXMOR' => 'MORELOS',
    'MXNAY' => 'NAYARIT',
    'MXNLE' => 'NUEVO LEÓN',
    'MXOAX' => 'OAXACA',
    'MXPUE' => 'PUEBLA',
    'MXQUE' => 'QUERÉTARO',
    'MXROO' => 'QUINTANA ROO',
    'MXSIN' => 'SINALOA',
    'MXSLP' => 'SAN LUIS POTOSÍ',
    'MXSON' => 'SONORA',
    'MXTAB' => 'TABASCO',
    'MXTAM' => 'TAMAULIPAS',
    'MXTLA' => 'TLAXCALA',
    'MXVER' => 'VERACRUZ DE IGNACIO DE LA LLAVE',
    'MXYUC' => 'YUCATÁN',
    'MXZAC' => 'ZACATECAS',
];
// Sinónimos frecuentes → nombre oficial del array anterior
$aliases = [
    'CDMX' => 'CIUDAD DE MEXICO',
    'CIUDAD DE MEXICO' => 'CIUDAD DE MEXICO',
    'DISTRITO FEDERAL' => 'CIUDAD DE MEXICO',
    'MEXICO' => 'MEXICO',
    'ESTADO DE MEXICO' => 'MEXICO',
    'MICHOACAN' => 'MICHOACAN',
    'QUERETARO' => 'QUERETARO',
    'SAN LUIS POTOSI' => 'SAN LUIS POTOSI',
    'YUCATAN' => 'YUCATAN',
    'VERACRUZ' => 'VERACRUZ DE IGNACIO DE LA LLAVE',
];
// Invertir nombres oficiales → código
$nameToCode = [];
foreach ($mxNames as $code => $name) {
    $nameToCode[normalize_name($name)] = $code;
}
// Añadir alias al invertido
foreach ($aliases as $alias => $target) {
    $nameToCode[normalize_name($alias)] = $nameToCode[normalize_name($target)] ?? null;
}

// 4) Pasar conteos por nombre → conteos por código (MX***)
$countsByCode = array_fill_keys(array_keys($mxNames), 0);
foreach ($conteosRaw as $entidad => $total) {
    $k = normalize_name($entidad);
    $code = $nameToCode[$k] ?? null;
    if ($code) $countsByCode[$code] += (int)$total;
}
$max = max(1, max($countsByCode)); // evitar división por 0

// 5) Colores por estado
$from = '#fde0dd';            // rojo muy claro
$to   = '#691C32';            // rojo GSNI
$zero = '#eeeeee';            // sin reportes
$fillByCode = [];
foreach ($countsByCode as $code => $cnt) {
    if ($cnt <= 0) {
        $fillByCode[$code] = $zero;
        continue;
    }
    $t = $cnt / $max; // 0..1
    $fillByCode[$code] = lerp_color($from, $to, $t);
}

// 6) Cargar el SVG base y decorarlo (clase, data-*, fill y <title>)
$baseDir  = __DIR__;
$sourceSvg = $baseDir . DIRECTORY_SEPARATOR . 'mx.svg';

// Estilos del mapa
$styleBlock = '<style>
    .state { fill: #ccc; stroke: #fff; stroke-width: 1; cursor: pointer; transition: fill .2s; }
    .state:hover { filter: brightness(1.05); }
    .label { font-family: Arial, sans-serif; font-size: 12px; fill: #000; pointer-events: none; }
    #tooltip { pointer-events: none; }
    .tooltip-bg { fill: rgba(0,0,0,0.75); stroke: #fff; stroke-width: .5; }
    .tooltip-text { fill: #fff; font-family: Arial, sans-serif; font-size: 12px; dominant-baseline: hanging; }
</style>';

function inject_style_once(string $svg, string $styleBlock): string
{
    return preg_replace('/(<svg\b[^>]*>)/i', '$1' . $styleBlock, $svg, 1);
}
function ensure_attr(string $attrs, string $attr, string $value): string
{
    if (preg_match('/\b' . preg_quote($attr, '/') . '\s*=\s*"/i', $attrs)) {
        return preg_replace('/(' . preg_quote($attr, '/') . '\s*=")([^"]*)(")/i', '$1$2 ' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '$3', $attrs, 1);
    }
    return rtrim($attrs) . ' ' . $attr . '="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '"';
}
function ensure_style_fill(string $attrs, string $fillHex): string
{
    if (preg_match('/\bstyle\s*=\s*"/i', $attrs)) {
        // agregar/actualizar fill dentro del style existente
        if (preg_match('/style\s*=\s*"([^"]*)"/i', $attrs, $m)) {
            $style = $m[1];
            // quitar fill previo si existe
            $style = preg_replace('/\bfill\s*:\s*[^;]+;?/i', '', $style);
            $style = trim($style);
            if ($style !== '' && substr($style, -1) !== ';') $style .= ';';
            $style .= 'fill: ' . $fillHex . ';';
            return preg_replace('/style\s*=\s*"[^"]*"/i', 'style="' . $style . '"', $attrs, 1);
        }
    }
    return rtrim($attrs) . ' style="fill: ' . $fillHex . ';"';
}
function code_norm(string $id): string
{
    return str_replace('-', '', strtoupper($id)); // MX-AGU -> MXAGU
}

if (!is_readable($sourceSvg)) {
    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800" width="100%" height="100%">' .
        $styleBlock .
        '<rect x="0" y="0" width="1200" height="800" fill="#f9f9f9" stroke="#ddd"/>' .
        '<text x="50" y="120" font-family="Arial, sans-serif" font-size="20" fill="#333">Falta el archivo mx.svg para pintar el mapa</text>' .
        '</svg>';
    exit;
}

$svg = file_get_contents($sourceSvg);
if ($svg === false || stripos($svg, '<svg') === false) {
    echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800" width="100%" height="100%">' .
        $styleBlock .
        '<text x="50" y="120" font-family="Arial, sans-serif" font-size="20" fill="#333">No se pudo leer mx.svg</text>' .
        '</svg>';
    exit;
}

$svg = inject_style_once($svg, $styleBlock);

$scriptBlock = '<script><![CDATA[(function(){
    function makeTooltip(){
      var svgns = "http://www.w3.org/2000/svg";
      var root = document.querySelector("svg");
      if(!root) return null;
      var g = document.createElementNS(svgns, "g");
      g.setAttribute("id", "tooltip");
      g.setAttribute("visibility", "hidden");
      var bg = document.createElementNS(svgns, "rect");
      bg.setAttribute("rx", "4");
      bg.setAttribute("ry", "4");
      bg.setAttribute("class", "tooltip-bg");
      var text = document.createElementNS(svgns, "text");
      text.setAttribute("class", "tooltip-text");
      text.setAttribute("x", "0");
      text.setAttribute("y", "0");
      g.appendChild(bg);
      g.appendChild(text);
      root.appendChild(g);
      return {root: root, g: g, bg: bg, text: text};
    }

    var tip = null;
    function showTip(evt, el){
      if(!tip) tip = makeTooltip();
      if(!tip) return;
      var name = el.getAttribute("data-estado") || "";
      var count = el.getAttribute("data-count") || "0";
      var label = name + " — " + count + " reportes";
      tip.text.textContent = label;
      // Measure text
      var bbox = tip.text.getBBox();
      var pad = 8;
      tip.bg.setAttribute("x", bbox.x - pad);
      tip.bg.setAttribute("y", bbox.y - (pad*0.6));
      tip.bg.setAttribute("width", bbox.width + pad*2);
      tip.bg.setAttribute("height", bbox.height + pad*1.2);
      // Position near pointer
      var pt = tip.root.createSVGPoint();
      pt.x = (evt.clientX !== undefined ? evt.clientX : (evt.pageX || 0));
      pt.y = (evt.clientY !== undefined ? evt.clientY : (evt.pageY || 0));
      var svgPt = pt.matrixTransform(tip.root.getScreenCTM().inverse());
      var offset = 12;
      tip.g.setAttribute("transform", "translate("+(svgPt.x+offset)+","+(svgPt.y+offset)+")");
      tip.g.setAttribute("visibility", "visible");
    }

    function hideTip(){ if(tip) tip.g.setAttribute("visibility", "hidden"); }

    function attach(){
      var root = document.querySelector("svg");
      if(!root) return;
      var nodes = root.querySelectorAll(".state");
      nodes.forEach(function(n){
        n.addEventListener("mousemove", function(e){ showTip(e, n); });
        n.addEventListener("mouseleave", hideTip);
        n.addEventListener("touchstart", function(e){ if(e.touches && e.touches[0]) showTip(e.touches[0], n); });
        n.addEventListener("touchend", hideTip);
      });
    }

    if(document.readyState === "loading"){
      document.addEventListener("DOMContentLoaded", attach);
    } else { attach(); }
  })();]]></script>';

// A) Grupos <g id="MX***"> → añadir clase/attrs/fill y <title>
$svg = preg_replace_callback(
    '/<g\b([^>]*\bid="(MX-?[A-Z]{3})"[^>]*)>/i',
    function ($m) use ($mxNames, $fillByCode, $countsByCode) {
        $attrs = $m[1];
        $raw   = $m[2];
        $code  = code_norm($raw);
        $name  = $mxNames[$code] ?? $code;
        $cnt   = $countsByCode[$code] ?? 0;
        $fill  = $fillByCode[$code] ?? '#cccccc';

        $attrs = ensure_attr($attrs, 'class', 'state');
        $attrs = ensure_attr($attrs, 'data-estado', $name);
        $attrs = ensure_attr($attrs, 'data-count', (string)$cnt);
        $attrs = ensure_style_fill($attrs, $fill);

        return '<g ' . trim($attrs) . '><title>' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ' — ' . $cnt . ' reportes</title>';
    },
    $svg
);

// B) Paths autoconclusivos <path .../> con id="MX***" → convertir a <path>...</path> con <title>
$svg = preg_replace_callback(
    '/<path\b([^>]*\bid="(MX-?[A-Z]{3})"[^>]*)\/>/i',
    function ($m) use ($mxNames, $fillByCode, $countsByCode) {
        $attrs = $m[1];
        $raw   = $m[2];
        $code  = code_norm($raw);
        $name  = $mxNames[$code] ?? $code;
        $cnt   = $countsByCode[$code] ?? 0;
        $fill  = $fillByCode[$code] ?? '#cccccc';

        $attrs = ensure_attr($attrs, 'class', 'state');
        $attrs = ensure_attr($attrs, 'data-estado', $name);
        $attrs = ensure_attr($attrs, 'data-count', (string)$cnt);
        $attrs = ensure_style_fill($attrs, $fill);

        return '<path ' . trim($attrs) . '><title>' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ' — ' . $cnt . ' reportes</title></path>';
    },
    $svg
);

// C) Paths no autoconclusivos <path ...> sin /> → inyectar <title> al inicio del contenido
$svg = preg_replace_callback(
    '/<path\b([^>]*\bid="(MX-?[A-Z]{3})"[^>]*)>/i',
    function ($m) use ($mxNames, $fillByCode, $countsByCode) {
        $attrs = $m[1];
        $raw   = $m[2];
        $code  = code_norm($raw);
        $name  = $mxNames[$code] ?? $code;
        $cnt   = $countsByCode[$code] ?? 0;
        $fill  = $fillByCode[$code] ?? '#cccccc';

        $attrs = ensure_attr($attrs, 'class', 'state');
        $attrs = ensure_attr($attrs, 'data-estado', $name);
        $attrs = ensure_attr($attrs, 'data-count', (string)$cnt);
        $attrs = ensure_style_fill($attrs, $fill);

        return '<path ' . trim($attrs) . '><title>' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ' — ' . $cnt . ' reportes</title>';
    },
    $svg
);

// Inject tooltip script before closing </svg>
$svg = preg_replace('/(<\/svg>)/i', $scriptBlock . '$1', $svg, 1);

echo $svg;
