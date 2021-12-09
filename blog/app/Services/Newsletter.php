<?php

namespace App\Services;

class Newsletter{
    public function subscribe(string $email)
    {
        $mailchimp = new \MailchimpMarketing\ApiClient();

        $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20'
        ]);

        return $mailchimp->lists->addListMember(config('services.mailchimp.lists.subscribers'),[
            'email_address' => request('email'),
            'status' => 'subscribed'
        ]);
    }
}