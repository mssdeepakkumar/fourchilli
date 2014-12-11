<? 
/**
 * Mailer.php
 *
 * The Mailer class is meant to simplify the task of sending
 * emails to users. Note: this email system will not work
 * if your server is not setup to send mail.
 */
 
class MailerTest
{
   /**
    * sendNewPass - Sends the newly generated password
    * to the user's email address that was specified at
    * sign-up.
    */

   function sendTestMail($email, $receivedtime){
	   	$headers  = 'MIME-Version: 1.0' . "\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
	    $headers .= "From: Four Chillies <admin@fourchillies.com>\n";
	    //$headers .= 'Bcc: kit147@threegmedia.com' . "\r\n";
	
	  $subject = "Fourchillies Test Mailer.";
    
$message = <<<EOT
	  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #6A6A6A; font-family:Arial, Helvetica, sans-serif; font-size:12px;}

.style_note {color: #6A6A6A; font-family:Arial, Helvetica, sans-serif; font-size:11px; text-align:justify;}

.style2 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: normal; font-size:12px;
}

table.kasmot {
	border-width: 1px;
	border-spacing: 0px;
	border-style: none;
	border-color: #999999;
	border-collapse: collapse;
}

table.kasmot td {
	border-width: 1px;
	padding: 0px;
	border-style: inset;
	border-color: #999999;
	-moz-border-radius: ;
}

-->
</style>
</head>
<body>
<table width="431" height="400">
  <tr>
    <td height="50" colspan="2" align="left" valign="top">Test Mailer</td>
  </tr>
  
  <tr>
    <td height="81" colspan="2"><table width="97%" height="83">
      <tr>
        <td height="24" align="left"><div class="style2"></div></td>
        </tr>
      <tr>
        <td height="24" align="left"><div class="style2"></div></td>
        </tr>
      <tr>
        <td height="24" align="left"><div class="style2"></div></td>
        </tr>
      <tr>
        <td height="24" align="left"><div class="style2"></div></td>
        </tr>
      <tr>
        <td height="24" align="left"><div class="style2">You received this email at the time: <strong>$receivedtime</strong></div></td>
        </tr>
      <tr>
        <td height="24" align="left"><div class="style2"></div></td>
        </tr>
      <tr>
        <td height="24" align="left"><div class="style2">Thank You.</div></td>
        </tr>
      <tr>
        <td height="24" align="left"><div class="style2"></div></td>
        </tr>        
    </table></td>
  </tr>
  <tr>
    <td width="424" align="justify"><span class="style_note">This email was sent from www.fourchillies.com.</span></td>
    <td width="11">&nbsp;</td>
  </tr>
</table>

</body>
</html>

EOT;

      return mail($email,$subject,$message,$headers);
   } 
};
/* Initialize mailer object */
$mailer = new MailerTest;
 
?>
