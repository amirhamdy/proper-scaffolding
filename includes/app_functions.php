<?php
require_once("app_initialize.php");

require_once ('app_config.php');
require_once ('phpmailer/5.1/class.phpmailer.php');

function completeData($arrayData = NULL) {
    if ($arrayData) {
        foreach ($arrayData as $key => $value) {
            if (empty($value)) {
                return FALSE;
            }
        }
        return TRUE;
    }
    return FALSE;
}

function out_Tip() {
    if (isset($_SESSION['tip'])) {
        ?>
        <div class = "alert alert-success">
            <button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">×</button>
            <center>
                <strong><i class = "fa fa-check">
                    </i> Done!</strong>
                <?php
                echo $_SESSION['tip'];
                unset($_SESSION['tip']);
                ?>
            </center>
        </div>
        <?php
    }
}

function out_Alert() {
    if (isset($_SESSION['alert'])) {
        ?>
        <div class = "alert alert-danger">
            <button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">×</button>
            <center>
                <strong><i class = "fa fa-ban">
                    </i> Error!</strong>
                <?php
                echo $_SESSION['alert'];
                unset($_SESSION['alert']);
                ?>
            </center>
        </div>
        <?php
    }
}

function out_Warning() {
    if (isset($_SESSION['warn'])) {
        ?>
        <div class ="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <center>
                <strong><i class="fa fa-bell-o">
                    </i> Warning!</strong>
                <?php
                echo $_SESSION['warn'];
                unset($_SESSION['warn']);
                ?>
            </center>
        </div>
        <?php
    }
}

function printMSG() {
    out_Tip();
    out_Warning();
    out_Alert();
}

function redirect_to($location = NULL) {
    if ($location != NULL) {
        header("Location: {$location}");
        exit;
    }
}

function send_mail($subject, $to, $msg_head, $msg_body, $cc = NULL) {
    $m            = new PHPMailer();
    $m->IsSMTP();
    $m->SMTPDebug = false;     // enables SMTP debug information (for testing) [default: 2]
    $m->SMTPAuth  = true;      // enable SMTP authentication
    $m->Host      = SMTP_HOST;  // sets the SMTP server
    $m->Port      = SMTP_PORT;  // set the SMTP port for the GMAIL server
    $m->Username  = SMTP_USER;  // SMTP account username
    $m->Password  = SMTP_PASS;  // SMTP account password
    $m->SingleTo  = true;
    $m->CharSet   = "UTF-8";
    $m->Subject   = $subject;
    $m->AltBody   = 'To view the message, please use an HTML compatible email viewer!';

    $m->AddAddress($to);
    if ($cc != NULL) {
        $m->AddCC($cc);
    }
    $m->AddReplyTo(REPLY_TO, 'Reutrans');
    $m->SetFrom(SMTP_USER, 'Reutrans');
    $m->MsgHTML(mail_Body($msg_head, $msg_body));

    if (SMTP_SSL === true) {
        $m->SMTPSecure = 'ssl';      // sets the prefix to the server
    }

    // @SEND MAIL
    return $m->Send() ? TRUE : FALSE;
}

function ckmail($email) {
    $email = trim(strtolower($email));
    if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', trim($email))) {
        return $email;
    } else {
        return false;
    }
}

function mail_Body($msg_head, $msg_body) {

    $body = '<div style="font-family:HelveticaNeue-Light, Arial, sans-serif;
    background-color:#eeeeee">
    <table align = "center" width = "100%" border = "0" cellspacing = "0" cellpadding = "0" bgcolor = "#eeeeee">
    <tbody>
    <tr>
    <td>
    <table align = "center" width = "750px" border = "0" cellspacing = "0" cellpadding = "0" bgcolor = "#eeeeee" style = "width:750px!important">
    <tbody>
    <tr>
    <td>
    <table width = "690" align = "center" border = "0" cellspacing = "0" cellpadding = "0" bgcolor = "#eeeeee">
    <tbody>
    <tr style = "height: 30px;"> </tr>
    <tr>
    <td colspan = "3" height = "80" align = "center" bgcolor = "#eeeeee" style = "padding:0;margin:0;font-size:0;line-height:0">
    <table width = "690" align = "center" border = "0" cellspacing = "0" cellpadding = "0">
    <tbody>
    <tr>
    <td width = "30"></td>
    <td align = "left" valign = "middle" style = "padding:0;margin:0;font-size:0;line-height:0">
    <a href = "http://www.reutrans.com/" target = "_blank">
    <img src = "http://www.reutrans.com/wp-content/uploads/2015/08/16717-01-1-e1438737463884.jpg"
    alt = "Reutrans" width = "700" >
    </a>
    </td>
    <td width = "30"></td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td colspan = "3" align = "center">
    <table width = "630" align = "center" border = "0" cellspacing = "0" cellpadding = "0">
    <tbody>
    <tr>
    <td colspan = "3" height = "30"></td></tr>
    <tr>
    <td width = "25"></td>
    <td align = "center">
    <h1 style = "font-family:HelveticaNeue-Light,arial,sans-serif;font-size:40px;color:#404040;line-height:40px;font-weight:bold;margin:0;padding:0">' . $msg_head . '</h1>
    </td>
    <td width = "25"></td>
    </tr>
    <tr><td colspan = "3" height = "30"></td></tr>
    </tbody>
    </table>
    </td>
    </tr>

    <tr bgcolor = "#ffffff">
    <td width = "30" bgcolor = "#eeeeee"></td>
    <td>
    <table width = "570" align = "center" border = "0" cellspacing = "0" cellpadding = "0">
    <tbody>
    <tr style = "height: 30px;"></tr>
    <tr>
    <td>
    <h2 style = "color:#404040;font-size:22px;font-weight:bold;line-height:26px;padding:0;margin:0">&nbsp;
    </h2>
    <div style = "color:#404040;font-size:16px;line-height:24px;font-weight:lighter;padding:0;margin:0">
    ' . $msg_body . '
</div>
</td>
</tr>
<tr>
    <td align="center">
        <div style="text-align:center;width:100%;padding:40px 0">
            <table align="center" cellpadding="0" cellspacing="0" style="margin:0 auto;padding:0">
                <tbody>
                    <tr>
                        <td align="center" style="margin:0;text-align:center">
                            <a href="http://portal.reutrans.com/"
                               style="font-size:18px;
                               font-family:HelveticaNeue-Light,Arial,sans-serif;
                               line-height:22px;text-decoration:none;color:#ffffff;
                               font-weight:bold;border-radius:2px;background-color:#00a3df;
                               padding:14px 40px;display:block"
                               target="_blank">
                                View Now!
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </td>
</tr><tr><td>&nbsp;</td>
</tr></tbody></table></td>
<td width="30" bgcolor="#eeeeee"></td>
</tr>
</tbody>
</table>
<table align="center" width="750px" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="width:750px!important">
    <tbody>
        <tr>
            <td>
                <table width="630" align="center" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee">
                    <tbody>
                        <tr><td colspan="2" height="30"></td></tr>
<tr>
                                                                <td width="360" valign="top">
                                                                    <div style="color:#686868;font-size:14px;line-height:14px;padding:0;margin:0">
                                                                        This is an automated email please do not reply. If you have any comments/feedback, <br>
                                                                        Please reply to <b>project@reutrans.com</b>
                                                                    </div>
                                                                    <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                                                </td>
                        </tr>
<tr>
                            <td width="360" valign="top">
                                <div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">
                                    &copy; 2016 Reutrans. All rights reserved.</div>
                                <div style="line-height:5px;padding:0;margin:0">&nbsp;</div>
                                <div style="color:#a3a3a3;font-size:12px;line-height:12px;padding:0;margin:0">Tel: +44 (0)207 993 2325</div>
                            </td>
                        </tr>
                        <tr><td colspan="2" height="15"></td></tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</div>
';
    return $body;
}

function isMail($email) {
    $email = trim(strtolower($email));
    if (preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', trim($email))) {
        return $email;
    } else {
        return false;
    }
}

function ip() {
    if (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif (getenv('HTTP_X_FORWARDED')) {
        $ip = getenv('HTTP_X_FORWARDED');
    } elseif (getenv('HTTP_FORWARDED_FOR')) {
        $ip = getenv('HTTP_FORWARDED_FOR');
    } elseif (getenv('HTTP_FORWARDED')) {
        $ip = getenv('HTTP_FORWARDED');
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
