<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Santri; // Pastikan model Santri diimport

class VerifikasiMuridMail extends Mailable
{
    use Queueable, SerializesModels;
    public $murid;

    /**
     * Create a new message instance.
     */
    public function __construct(Santri $murid)
    {
        $this->murid = $murid;
    }

    /**
     * Get the message envelope.
     */
    // public function build()
    // {
    //     return $this->view('emails.verifikasi')
    //                 ->subject('Verifikasi Berhasil')
    //                 ->with([
    //                     'nama' => $this->murid->nama,
    //                 ]);
    // }

    public function build()
    {
        return $this->view('emails.verifikasi');
    }
   
   
   
    // public function build()
    // {
    //     return $this->view('emails.verifikasi')
    //                 ->subject('Verifikasi Murid Berhasil')
    //                 ->with([
    //                     'nama' => $this->murid->nama,
    //                 ]);
    // }


    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Verifikasi Murid berhasil',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emails.verifikasi',
    //         with: [
    //             'nama' => $this->murid->nama,
    //         ],
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
