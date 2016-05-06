 <?php
       $name = $_POST['nome'];
       $email = $_POST['email'];
       $message = $_POST['message'];
       $from = 'From: My Contact Form';
       $to = 'metroid.p2p@gmail.com';
       $subject = 'Wassup?';

       $body = "From: $name\n E-Mail: $email\n Message:\n $message";

       if ($_POST['submit']) {
           if (mail ($to, $subject, $body, $from)) {
           echo '<p>Message Sent Successfully!</p>';
           } else {
           echo '<p>Ah! Try again, please?</p>';
           }
       }
    ?>