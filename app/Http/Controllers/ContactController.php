<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request){
        $this->validate($request, [
            'firstName' => 'required|min:2|max:30',
            'lastName' => 'required|min:2|max:30',
            'email' => 'email:rfc',
        ]);
    }
}
