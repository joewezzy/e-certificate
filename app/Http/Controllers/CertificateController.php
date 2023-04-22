<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function view($hash){

        $details = certificate::where('hash',$hash)->first();
        // dd($details);
    return view('certificate.view.index', compact('details'));
    }
}
