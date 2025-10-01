<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../includes/session.php';

require_once __DIR__ . '/../lib/PHPMailer/Exception.php';
require_once __DIR__ . '/../lib/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../lib/PHPMailer/SMTP.php';

header('Content-Type: application/json');

// Obtener datos enviados como JSON
$input = json_decode(file_get_contents("php://input"), true);
$email = trim($input['correo'] ?? '');

if (!$email) {
    echo json_encode(['success' => false, 'message' => 'El correo es requerido.']);
    exit;
}

// Buscar usuario por correo
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if ($usuario) {
    $token = bin2hex(random_bytes(32));
    $expira = date("Y-m-d H:i:s", strtotime("+1 hour"));

    // Guardar token y expiración
    $stmt = $pdo->prepare("UPDATE usuarios SET reset_token = ?, token_expira = ? WHERE id = ?");
    $stmt->execute([$token, $expira, $usuario['id']]);

    $link = "https://siie2.inifed.mx/reset?token=$token";

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'mail.inifed.mx';
        $mail->SMTPAuth = true;
        $mail->Username = 'sia@inifed.mx';
        $mail->Password = 'Alan3001++';
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom("sia@inifed.mx", "SIIE INIFED");
        $mail->addAddress($email);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = "Recuperación de contraseña";
        $mail->isHTML(true);
        $mail->Body = "
            <p>Hola,</p>
            <p>Has solicitado recuperar tu contraseña para el sistema SIIE.</p>
            <p>Por favor, da clic en el siguiente botón para restablecerla:</p>
            <p><a href='$link' style='padding:10px 20px;background-color:#691c32;color:white;text-decoration:none;border-radius:5px;'>Restablecer contraseña</a></p>
            <p>O copia y pega este enlace en tu navegador:</p>
            <p><a href='$link'>$link</a></p>
            <p>Este enlace es válido por 1 hora.</p>
            <p>Si no solicitaste este cambio, puedes ignorar este mensaje.</p>
            <p>Atentamente,<br>Sistema de Infraestructura Educativa (SIIE)</p>  
        ";

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Correo enviado.']);
    } catch (Exception $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error al enviar el correo.',
            'error_detail' => $mail->ErrorInfo  // Agrega esta línea
        ]);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Correo no encontrado.']);
}
exit;
