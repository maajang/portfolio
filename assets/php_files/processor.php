<?php
if(isset($_POST['submit'])){
    // Set Initial Variables
    // This appears on the email subject line
    $subject = 'Mail From Website';
    // This is where the email will go to
    $mailTo = "examplemail@email.com";
    // This is a header for the email that will be sent
    $headers = "From: " .$email;
    // Set Email layout
    $txt = "You have received an email from " .$name. ".\n\n".$message;
    // Set preg_match patterns
    $nameRegex = '~^[\p{L}\p{Z}]+$~u';
    $emailRegex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i';
    $messageRegex = '/[A-Za-z0-9]+/';
   
    // Set returnMessage variable
    $returnMessage = '';
    // Check if form content is valid
    if(
        isset($_POST['name']) == true
        && isset($_POST['email']) == true
        && isset($_POST['message']) == true
    ){
        $name= $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        if( preg_match($nameRegex, $name) == false
           || preg_match($emailRegex, $email) == false
           || preg_match($messageRegex, $message) == false){
            // if any field is incorrect, send user back with relevant returnMessage
            $returnMessage = 'Sorry, you did not fill in the form correctly. 
            Please ensure you are inputting the correct data into the correct fields.';
        }else{
            // If all fields are correct, send user with confirmation message
            $returnMessage = 'Thank you, '. $name . ' your message has been sent!';
            // Mail to respective email address
            mail($mailTo, $subject, $txt, $headers);
        }
    }else{
        $returnMessage = 'You did not fill the form correctly';
    }
    header("Location: contact.php?returnMessage=".$returnMessage);
}else{
    header("Location: contact.php?returnMessage=".$returnMessage);
    $returnMessage = 'You did not fill in the form correctly!';
    die();
}
?>