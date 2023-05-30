<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail(string $to, string $subject, string $body)
    {
        $email = (new Email())
            ->from('lalaland@univ-reims.fr')
            ->to($to)
            ->subject($subject)
            ->html($body);

        $this->mailer->send($email);
    }
}