<?php

require_once("../includes/app_initialize.php");

//$action = FALSE;
$action = TRUE;

if (isset($_POST['send'])) {
    $action = TRUE;
}

if ($action) {
    $arrayData = array(
        $name    = $_POST['name'],
        $mail    = isMail($_POST['mail']),
        $subject = $_POST['subject'],
        $message = $_POST['message']);

    if (completeData($arrayData)) {
        if ($mail) {
            $to = SITE_MAIL;

            $msg_head = 'Contact US Form Was Submitted!';

            $msg_body = 'You have added a new message from:<br/>';
            $msg_body .='<b>Name:</b>' . $name . '<br/>';
            $msg_body .='<b>Subject:</b>: ' . $subject . '<br/>';
            $msg_body .='<b>Email:</b>' . $mail . '<br/><br/>';
            $msg_body .='<b>Message:</b>: ' . $message . '<br/>';

            $mail_result = send_mail($subject, $to, $msg_head, $msg_body);
            if ($mail_result) {
                $_SESSION['tip'] = " Your message was successfully sent. Thank you!";
                redirect_to("../contact.php");
            } else {
                $_SESSION['warn'] = " Failed to send email. Please try again later.";
                redirect_to("../contact.php");
            }
        } else {
            $_SESSION['alert'] = "Invalid Email.";
            redirect_to("../contact.php");
        }
    } else {
        $_SESSION['alert'] = " 400 -- Missing data";
        redirect_to("../contact.php");
    }
} else {
    redirect_to("../404.php");
}



