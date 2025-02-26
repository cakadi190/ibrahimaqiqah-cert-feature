<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

class GreetingCardController extends Controller
{
    public function withPhoto()
    {
        return Pdf::loadView('pdf-greeting.with-photo')
            ->setPaper('a4')
            ->setWarnings(false)
            ->stream();
    }

    public function withoutPhoto()
    {
        // return view('pdf-greeting.without-photo');
        return Pdf::loadView('pdf-greeting.without-photo')
            ->setPaper('f4', 'potrait')
            ->setWarnings(false)
            ->stream();
    }
}


