<?php

use PHPMailer\PHPMailer\PHPMailer;

// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\OAuth;

use League\OAuth2\Client\Provider\Google;


/**
 * Class Mailer.
 */
class Mailer
{
    /**
     * PHPMailer instance.
     *
     * @var PHPMailer
     */
    private $_mailer;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_mailer = new PHPMailer();
        $this->_mailer->isSMTP();
        $this->_mailer->SMTPDebug = SMTP_DEBUG;
        if (SMTP_DEBUG) {
            $this->_mailer->Debugoutput = 'html';
        }
        $this->_mailer->CharSet = CHARSET;
        $this->_mailer->Host = MAIL_HOST;
        $this->_mailer->Port = MAIL_PORT;
        $this->_mailer->SMTPSecure = SMTP_SECURE;
        $this->_mailer->SMTPAuth = SMTP_AUTH;
        
        
        $this->_mailer->AuthType = SMTP_AUTHTYPE;
        
        if ($this->_mailer->SMTPAuth && $this->_mailer->SMTP_AUTHTYPE = 'PLAIN') {
            $this->_mailer->Username = MAIL_USERNAME;
            $this->_mailer->Password = MAIL_PASSWORD;
        }

        if ($this->_mailer->SMTPAuth && $this->_mailer->SMTP_AUTHTYPE = 'XOAUTH2') {
            $this->_mailer->provider = new Google(
                [
                    'clientId' => OAUTH_CLIENTID,
                    'clientSecret' => OAUTH_CLIENT_SECRET,
                ]
            );
            
            $this->_mailer->setOAuth(
                new OAuth(
                    [
                        'provider' => $this->_mailer->provider,
                        'clientId' => OAUTH_CLIENTID,
                        'clientSecret' => OAUTH_CLIENT_SECRET,
                        'refreshToken' => OAUTH_REFRESH_TOKEN,
                        'userName' => OAUTH_USEREMAIL,
                    ]
                )
            );
        }

        $this->_mailer->isHTML(HTML_BODY);
        $this->_mailer->SMTPKeepAlive = SMTP_ALIVE;
    }

    /**
     * Send email with PDF certificate as attachment.
     *
     * @param string $to                recipient email
     * @param string $subject           email subject
     * @param string $message           email message
     * @param string $from              sender email
     * @param string $from_name         sender name
     * @param string $reply_to          reply to email
     * @param string $attachment        main attachment (certificate)
     * @param array  $other_attachments additional attachments
     */
    public function send_mail($to, $subject, $message, $from, $from_name = '', $reply_to = MAIL_REPLY_TO, $attachment = '', $other_attachments = [])
    {
        $this->_mailer->setFrom($from, $from_name);
        $this->_mailer->addReplyTo($reply_to, $from_name);
        $this->_mailer->addAddress($to, '');
        $this->_mailer->Subject = $subject;
        $this->_mailer->Body = $message;
        $this->_mailer->addAttachment($attachment);

        foreach ($other_attachments as $attch) {
            $this->_mailer->addAttachment($attch);
        }

        //send the message, check for errors
        if (!$this->_mailer->send()) {
            // echo 'Mailer Error: '.$this->_mailer->ErrorInfo;
            return false;
        }else{
            return true;
        }

        $this->_mailer->clearAddresses();
        $this->_mailer->clearReplyTos();
        $this->_mailer->clearAttachments();
        $this->_mailer->clearAllRecipients();
    }
}