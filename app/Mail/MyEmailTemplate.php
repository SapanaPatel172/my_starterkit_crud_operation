<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplates;

class MyEmailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    protected $slug;
    protected $emailTemplate;
    protected $name;
    protected $link;
    protected $email;
    protected $user;

    public function __construct($user)
    {
        $this->user=$user;
        $this->slug = 'notification';
        // Fetch data based on the provided slug
        $this->emailTemplate = EmailTemplates::where('slug', $this->slug)->first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'My Email Template',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Check if template was found
        if ($this->emailTemplate) {
            $template = $this->getTemplate();

            return (new Content)
                ->markdown('emails.registration_email_verify') // Markdown content
                ->with(['template' => $template]); // Data to be passed to the view
        }

        // For example, throw an exception or provide a default template
        throw new \Exception("Email template with slug '{$this->slug}' not found.");
    }

    public function getTemplate()
    {
        $template = $this->emailTemplate;
        if (!empty($template)) {
            $template = $template->template;
            $data = $this->getData();
            foreach ($data as $key => $value) {
                $template = str_replace($key, $value, $template);
            }
        }
        return $template;
    }

    public function getData()
    {
        $this->name = $this->user->name;
        $this->link = route('dashboard');
        $this->email=$this->user->email;

        // Return the data as an array
        return [
            '{name}' => $this->name,
            '{link}' => $this->link,
            '{email}'=>$this->email,
        ];
    }

    public function attachments(): array
    {
        return [];
    }
}
