<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $to_address;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($to_address, $subject, $view, $data, $attach)
    {
        $this->to_address   = $to_address;
        $this->subject      = $subject;
        $this->view         = $view;
        $this->data         = $data;
        $this->attach       = $attach;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        if ($this->attach != "") {
            $ext = pathinfo($this->attach, PATHINFO_EXTENSION);
            return $this
                ->to($this->to_address)
                ->subject($this->subject)
                ->view($this->view)
                ->with(['data' => $this->data])
                ->attach($this->attach, [
                    'as'   => 'File_Attachment.' . $ext,
                    'mime' => 'application/pdf,image/*'
                ]);
            } else {
            return $this
                ->to($this->to_address)
                ->subject($this->subject)
                ->view($this->view)
                ->with(['data' => $this->data]);
            }
    }
}
