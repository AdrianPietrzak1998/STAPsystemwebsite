<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';

require 'phpmailer/src/SMTP.php';
// Sprawdź, czy dane formularza zostały przesłane
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobierz dane z formularza
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $category = $_POST['Kategoria'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Utwórz nowy obiekt PHPMailer
    $mail = new PHPMailer();

    // Ustaw parametry serwera SMTP
    $mail->isSMTP();
    $mail->Host = 'mail.stapsystem.pl'; // Wprowadź nazwę hosta SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'technical@stapsystem.pl'; // Wprowadź adres email
    $mail->Password = 'adrian22'; // Wprowadź hasło do skrzynki email
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';
    // $mail->SMTPDebug = 2;
    // $mail->Debugoutput = 'html';

    // Ustaw nadawcę i odbiorcę
    $mail->setFrom('technical@stapsystem.pl', 'KontaktWWW');
    // $mail->addReplyTo($email, 'KontaktWWW');
    $mail->addAddress('kontakt@stapsystem.pl'); // Adres docelowy

    // Ustaw treść wiadomości e-mail
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = "Nowa wiadomość od: $name<br><br>Email: $email<br>Numer telefonu: $phone<br>Kategoria: $category<br>Temat: $subject<br><br>Treść wiadomości:<br>$message";

    // Wyślij e-mail
    if ($mail->send()) {
        // Jeśli e-mail został pomyślnie wysłany, wyświetl komunikat sukcesu
        // echo "Wiadomość została wysłana. Dziękujemy!";
        echo "OK";
    } else {
        // Jeśli wystąpił błąd podczas wysyłania e-maila, wyświetl komunikat błędu
        // echo "Wystąpił błąd podczas wysyłania wiadomości. Spróbuj ponownie później.";
        echo "ERROR";
    }
} else {
    // Jeśli formularz nie został przesłany, wyświetl komunikat o błędzie
    echo "Błąd: Nieprawidłowy sposób dostępu.";
}
?>
