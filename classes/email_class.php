<?php

class email
{
    protected $_con;

    /**
     * it will initalize DBclass
     */
    public function __construct()

    {
       
    }
    public function SendOrderEmailToClient($sendto,$user,$email,$amount,$tracknumber,$weight,$status,$barcode)
    {
        $variables = array();
        $variables['email'] = $email;
        $variables['amount'] = $amount;
        $variables['trackingnumber'] = $tracknumber;
        $variables['weight'] = $weight;
        $variables['status'] = $status;
        $variables['user'] = $user;
        $variables['barcode'] = $barcode;
        $template = file_get_contents(__DIR__."/../helpers/emails/verifiedOrder.html");
        foreach ($variables as $key => $value) {

            $template = str_replace('{{ ' . $key . ' }}', $value, $template);
        }
        $to = $sendto;
        $subject = "Order Recieved and Verified";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'info@pinnacle-erp.xyz' . "\r\n";
        if (mail($to, $subject, $template, $headers)) {
          //  echo 'Email sent successfully.';
        } else {
           // echo 'Email sending failed.';
        }
    }
    public function SendOrderStatusToClient($sendto,$user,$email,$amount,$tracknumber,$weight,$status,$barcode)
    {
        $variables = array();
        $variables['email'] = $email;
        $variables['amount'] = $amount;
        $variables['trackingnumber'] = $tracknumber;
        $variables['weight'] = $weight;
        $variables['status'] = $status;
        $variables['user'] = $user;
        $variables['barcode'] = $barcode;
        $template = file_get_contents(__DIR__."/../helpers/emails/updatedOrder.html");
        foreach ($variables as $key => $value) {

            $template = str_replace('{{ ' . $key . ' }}', $value, $template);
        }
        $to = $sendto;
        $subject = "Order Recieved and Verified";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'info@pinnacle-erp.xyz' . "\r\n";
        if (mail($to, $subject, $template, $headers)) {
           // echo 'Email sent successfully.';
        } else {
           // echo 'Email sending failed.';
        }
    }
    public function SendOrderEmailToAdmin($sendto,$user,$email,$amount,$tracknumber,$weight,$status,$barcode)
    {
        $variables = array();
        $variables['email'] = $email;
        $variables['amount'] = $amount;
        $variables['trackingnumber'] = $tracknumber;
        $variables['weight'] = $weight;
        $variables['status'] = $status;
        $variables['user'] = $user;
        $variables['barcode'] = $barcode;
        $template = file_get_contents(__DIR__."/../helpers/emails/paidOrder.html");
        foreach ($variables as $key => $value) {

            $template = str_replace('{{ ' . $key . ' }}', $value, $template);
        }
        $to = $sendto;
        $subject = "Order Recieved and Verified";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'info@pinnacle-erp.xyz' . "\r\n";
        if (mail($to, $subject, $template, $headers)) {
           // echo 'Email sent successfully.';
        } else {
          //  echo 'Email sending failed.';
        }
    }
    public function SendWelcomeEmailToClient($email,$password)
    {
        $variables = array();
        $variables['email'] = $email;
        $variables['password'] = $password;
        $template = file_get_contents(__DIR__."/../helpers/emails/useremail.html");
       // echo __DIR__."/../helpers/emails/useremail.html";
        foreach ($variables as $key => $value) {

            $template = str_replace('{{ ' . $key . ' }}', $value, $template);
        }
        $to = $email;
        $subject = "Order Recieved and Verified";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'info@pinnacle-erp.xyz' . "\r\n";
        if (mail($to, $subject, $template, $headers)) {
           // echo 'Email sent successfully.';
        } else {
           // echo 'Email sending failed.';
        }
    }
    public function SendWelcomeEmailToStaff($email,$password)
    {
        $variables = array();
        $variables['email'] = $email;
        $variables['password'] = $password;
        $template = file_get_contents(__DIR__."/../helpers/emails/staffemail.html");
        foreach ($variables as $key => $value) {

            $template = str_replace('{{ ' . $key . ' }}', $value, $template);
        }
        $to = $email;
        $subject = "Order Recieved and Verified";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'info@pinnacle-erp.xyz' . "\r\n";
        if (mail($to, $subject, $template, $headers)) {
           // echo 'Email sent successfully.';
        } else {
           // echo 'Email sending failed.';
        }
    }
    public function SendContactEmail($to,$f,$e,$l,$t)
    {
        $variables = array();
        $variables['email'] = $e;
        $variables['firstname'] = $f;
        $variables['lastname'] = $l;
        $variables['message'] = $t;
        $template = file_get_contents(__DIR__."/../helpers/emails/contactus.html");
       // echo __DIR__."/../helpers/emails/useremail.html";
        foreach ($variables as $key => $value) {

            $template = str_replace('{{ ' . $key . ' }}', $value, $template);
        }
        $to = $email;
        $subject = "Contact";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'info@pinnaclemachinery.co.uk' . "\r\n";
        if (mail($to, $subject, $template, $headers)) {
           // echo 'Email sent successfully.';
        } else {
           // echo 'Email sending failed.';
        }
    }



}
