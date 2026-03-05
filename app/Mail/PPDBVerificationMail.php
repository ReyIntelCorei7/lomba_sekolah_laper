<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PPDBVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Student $student;
    public string $verificationUrl;

    public function __construct(Student $student)
    {
        $this->student = $student;
        $this->verificationUrl = route('ppdb.verify-email', [
            'token' => $student->email_verification_token
        ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verifikasi Email Pendaftaran PPDB - ' . config('app.name', 'SMK Metland'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ppdb-verification',
        );
    }
}
