<?php 

    session_start();

    //   if(!$_SESSION['logged_in']) {
    //     header("Location: login.php");
    // }

    include('templates/header.html');
    require 'phpmailer/PHPMailerAutoload.php';
    
    //message has to be logged in

?>
<section class="center">
    <form method="post">
        <fieldset>
            <h2>Email Form</h2>
               <label>My Email:</label>
                <input type="email" name="userEmail" required><br/>
                <label>Subject:</label>
                <input type="text" name="subject" required><br/>
                <label>Message:</label>
                <textarea name="notes" required></textarea><br/>
                <input type="submit" name="submit" value="Submit" formaction="index.php"/>
        </fieldset>
    </form>
</section>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $mail = new PHPMailer;                            
    $mail->isSMTP(); 
    $mail->SMTPAuth = true;
    //$mail->SMTPDebug = 3;   // debug set to 3 to show all details
    
    $mail->Host = 'stmp.gmail.com';    // example smtp.gmail.com                               
    $mail->Username = 'abiam222@gmail.com'                   ;               
    $mail->Password = '';                           
    $mail->SMTPSecure = 'ssl';                       
    $mail->Port = 465;     

    $mail->addAddress('someone@gmail.com');     // Add a recipient
    $mail->FromName = $_POST['userEmail'];       // the email or name you want to appear
    $mail->Subject = $_POST['subject'];
    $mail->Body    = $_POST['notes'];
    
    if(!$mail->send()) 
    {
        print '<h3 style="color: red;">ERROR! Unable to send Email<h3>';
    } 
    else 
    {
        print '<h3 style="color: green;">Email Sent Successfully</h3>';
    }
    
    //$mail->addReplyTo($_POST['from'], 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com'); 

    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
}

 include('templates/footer.html');

?>    
