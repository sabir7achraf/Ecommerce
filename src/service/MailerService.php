<?php

namespace App\service;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(
        #[Autowire('%admin_email%')] private string $admin_email,
        private readonly MailerInterface $mailer,
    )
    {}
    public function sendMail():void{

            $email = (new Email())
                ->from($this->admin_email)
                ->to($this->admin_email)
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('Time for Symfony Mailer!')
                ->text('Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');
            $this->mailer->send($email);


        }

}
