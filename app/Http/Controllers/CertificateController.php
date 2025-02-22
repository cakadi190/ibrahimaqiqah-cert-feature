<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function withPhoto()
    {
        return Pdf::loadView('pdf-cert.with-photo')
            ->setPaper('a4')
            ->setWarnings(false)
            ->stream();
    }

    public function withoutPhoto()
    {
        return Pdf::loadView('pdf-cert.without-photo')
            ->setPaper('a4')
            ->setWarnings(false)
            ->stream();
    }
}

