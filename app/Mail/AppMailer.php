<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Subscribe extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailer;
    protected $fromAddress = 'support@supportticket.dev';
    protected $fromName = 'Support Ticket';
    protected $to;
    protected $subject;
    protected $view;
    protected $data = [];


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mail $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendTicketInformation($user, Ticket $ticket)
    {
        $this->to = $user->email;
        $this->subject = "[Ticket ID: $ticket->ticket_id] $ticket->title";
        $this->view = 'email.ticket_info';
        $this->data = compact('user', 'ticket');

        return $this->deliver();
    }

    public function sendTicketComments($ticketOwner, $user, Ticket $ticket, $comment)
    {

    }

    public function sendTicketStatusNotifications($ticketOwner, Ticket $ticket)
    {

    }
    
    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function($message){

            $message->from($this->fromAddress, $this->fromName)
            ->to($this->to)->subject($this->subject);
        });
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.subscribers');
    }
}
