<?php

namespace App\Http\Controllers;

use App\Mail\CertificateEmail;
use App\Models\certificate;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Mail;
use Alert;

use App\Imports\CertImport;
use Excel;
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

        $config = [
            'table' => 'certificates',
            'field' => 'unique_code',
            'length' => 15,
            'prefix' => 'OAHF/AT/'.date('ym'),
            // 'reset_on_prefix_change' => true
        ];
        $unique_code = IdGenerator::generate($config);

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



public function import_cert(Request $request) 
    {
        $category = $request->category;
        Excel::import(new CertImport($category), $request->file('file'));
        Alert::success('Success', 'Import Completed');
        
        return redirect()->back();
    }


}