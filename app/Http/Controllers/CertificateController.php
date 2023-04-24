<?php

namespace App\Http\Controllers;

use App\Mail\CertificateEmail;
use App\Models\certificate;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Mail;

class CertificateController extends Controller
{
    public function view($hash){

        $details = certificate::where('hash',$hash)->first();

        $d = $details->link_click_count + 1;


        certificate::where('hash',$hash)->update([
            'link_click_count' =>  $d
        ]);

    return view('certificate.view.index', compact('details'));
    }

    public function create(Request $request){

            // $unique_code = IdGenerator::generate(['table' => 'certificate', 'length' => 15, 'prefix' => 'OAHF/AT/'.date('ym')]);

            $unique_code = "OAHF/AT/2304003";
            certificate::create([
                'name' => ucwords($request->input('name')),
                'email' => $request->input('email'),
                'type' => $request->input('category'),
                'unique_code' => $unique_code,
                'hash' => sha1(rand()),
                'isActive' => 1
            ]) ;
    return redirect()->back();
    }


public function sendCertificate($id){
    $cert = certificate::find($id);
    $mailData = [
        'name' => $cert->name,
        'link' => url('/public',$cert->hash),
        'body' => 'This is for testing email using smtp.'
    ];
   if(Mail::to($cert->email)->send(new CertificateEmail($mailData)))
    $cert->update([
        'isEmailSent' => $cert->isEmailSent + 1
    ]);

    return redirect()->back();
}
}
