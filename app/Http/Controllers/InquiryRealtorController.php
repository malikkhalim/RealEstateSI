<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class InquiryRealtorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //->latest()
        $inquiries = Contact::orderBy('id', 'DESC')->paginate(1);
        return view('agents.inquiry.inquiry', compact('inquiries'));
    }


    public function show($id)
    {
        $inquiry = Contact::findOrFail($id);
        return view('agents.inquiry.single-inquiry', compact('inquiry'));
    }

}
