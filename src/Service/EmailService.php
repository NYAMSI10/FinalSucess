<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;

class EmailService
{
    public function __construct(MailerInterface $mailer)
    {
         $this->mailer = $mailer;
    }

    public function sendEmail($emailuser, $firstname,$password)
    {
        $email = (new TemplatedEmail())
            ->from('fabien@example.com')
            ->to($emailuser)
            ->subject('Thanks for signing up!')

            // path of the Twig template to render
            ->htmlTemplate('emails/signup.html.twig')

            // pass variables (name => value) to the template
            ->context([
                'emails' => $emailuser,
                'password' => $password,
                'firstname' => $firstname,
            ])
        ;
        $this->mailer->send($email);


    }
}