<?php
//on appel tous les fichier pour que PHPmailer foctionne
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
        
    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/PHPMailer.php';
    require '../../PHPMailer/src/SMTP.php';


    if(isset($_POST['submit'])){
        if(($_POST['name']!='')&&($_POST['surname']!='')&&($_POST['mail']!='')&&($_POST['subject']!=''&&($_POST['msg']!=''))){

            $to='testcci54@gmail.com';
            $From=$_POST['mail'];
            $FromName=$_POST['name'].' - '.$_POST['surname'];

            //Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = 2;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

                /************************************************************************************
                 *                  regler directement dans PHPMailer.php                           *
                 *    $mail->Username   = 'testcci54@gmail.com';                  //SMTP username   *
                 *    $mail->Password   = 'cci54Joeuf';                           //SMTP password   *
                 ************************************************************************************/
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom($From, $name=$FromName);                     //from (émetteur)
                $mail->addAddress($to, $name = 'Moi');                     //to (recois)
                //$mail->addAddress('ellen@example.com');                   //Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $_POST['subject'];
                $mail->Body    = 'message envoyer par: '.$_POST['mail'].'<br><hr>'.$_POST['msg'].'<hr><br>Sign by '.$_POST['name'].' - '.$_POST['surname'];
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                header('Location: http://localhost/mvc/index.php?action=formEmail&mail=ok');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
              
        }else{
            header('Location: http://localhost/mvc/index.php?action=formEmail&err=champ');
        }
    }
?>