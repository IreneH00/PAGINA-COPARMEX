
<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];

    
    $pdfFilePath = 'pdfs/Historial_cobranza.pdf'; 

    
    $pdfData = $_POST['pdf_data'];
    $pdfSaved = file_put_contents($pdfFilePath, base64_decode($pdfData));

    if ($pdfSaved === false) {
        echo "Error al guardar el archivo PDF.";
        exit;
    }

   
    function enviarCorreo($destinatario, $asunto, $mensaje, $archivo) {
        
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: multipart/mixed; boundary=\"boundary\"\r\n";

        
        $headers .= "This is a multi-part message in MIME format.\r\n";
        $headers .= "--boundary\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $headers .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $headers .= $mensaje . "\r\n";

    
        if (file_exists($archivo)) {
            $contenido = chunk_split(base64_encode(file_get_contents($archivo)));
            $headers .= "--boundary\r\n";
            $headers .= "Content-Type: application/pdf; name=\"" . basename($archivo) . "\"\r\n";
            $headers .= "Content-Disposition: attachment; filename=\"" . basename($archivo) . "\"\r\n";
            $headers .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $headers .= $contenido . "\r\n";
        }

        
        $headers .= "--boundary--";

        
        return mail($destinatario, $asunto, "", $headers);
    }

  
    $asunto = "Historial de Cobranza";
    $mensaje = "Por favor, encuentra adjunto el PDF generado.";
    
    if (enviarCorreo($correo, $asunto, $mensaje, $pdfFilePath)) {
        echo "El correo ha sido enviado con éxito.";
    } else {
        echo "Error al enviar el correo.";
    }

    
    unlink($pdfFilePath);
}

?>