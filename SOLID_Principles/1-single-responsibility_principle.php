<?php

/*
🧱 S - Single Responsibility Principle (SRP)
Una clase debe tener una sola responsabilidad.
*/

// ❌ Ejemplo incorrecto:
class Report {
    public function generate() {
        // generar el reporte
    }

    public function saveToFile($filename) {
        file_put_contents($filename, 'contenido');
    }

    public function sendEmail($email) {
        // lógica para enviar el correo
    }
}

// ✅ Ejemplo correcto:
class ReportGenerator {
    public function generate() {
        return 'contenido del reporte';
    }
}

class FileSaver {
    public function save($filename, $content) {
        file_put_contents($filename, $content);
    }
}

class EmailSender {
    public function send($email, $content) {
        // lógica para enviar email
    }
}

// Uso:
$generator = new ReportGenerator();
$content = $generator->generate();

$saver = new FileSaver();
$saver->save('reporte.txt', $content);

$mailer = new EmailSender();
$mailer->send('usuario@example.com', $content);

// Cada clase hace solo una cosa, lo que facilita el mantenimiento y la reutilización.
