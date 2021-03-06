<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Lowongan;
use App\Models\Pelamar;
use App\Models\User;

class ApplicantMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * int id pelamar
     * @return void
     */
    public function __construct($id)
    {
        $this->id_pelamar = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Get data pelamar
        $pelamar = Pelamar::find($this->id_pelamar);
        $pelamar->posisi = Lowongan::find($pelamar->posisi);
        $user = User::find($pelamar->id_user);

        return $this->from('administrator@psikologanda.com')->markdown('email/applicant')->subject('Notifikasi')->with([
            'pelamar' => $pelamar,
            'user' => $user,
        ]);
    }
}
