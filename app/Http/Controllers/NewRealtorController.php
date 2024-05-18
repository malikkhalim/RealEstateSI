<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Realtor;
use App\Listing;
use Session;
use App\User;
use Illuminate\Support\Facades\Auth;


class NewRealtorController extends Controller{

    public function index()
{
    // Get the authenticated user's email
    $user = Auth::user();
    $userEmail = $user->email;

    // Check if the email already exists in the realtor table
    $existingRealtor = Realtor::where('email', $userEmail)->first();

    if ($existingRealtor) {
        // If the email exists, pass a message to the view
        return redirect()->back()->with('message', 'You have already registered as a realtor. Please wait until the admin accepts you.');
    }

    // If the email doesn't exist, just return the view
    return view('site.layouts.becomerealtor');
}


    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'email'=>'required',
            'contact_number'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $realtor = new Realtor([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'email' => $request->get('email'),
            'contact_number' => $request->get('contact_number'),
        
        ]);
    
        //call custom file upload function
        $isSuccess = $this -> imageUploadHandler($request->image, $request->name, $realtor);
        
        if($isSuccess){
            return redirect(route('realtors.index'))->with('success', 'Realtor Added!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    private function imageUploadHandler($image,$name, $realtor)
    {

        $image_new_name = $name.'.'.time().'.'.$image->getClientOriginalExtension();  
        $isScucess = $image->move(public_path('images/realtor'), $image_new_name);
    
        if($isScucess){
            $image_url = 'images/realtor/'.$image_new_name;
            $realtor->image = $image_url;
            $realtor->save();
            
            return TRUE;
        return FALSE;
            
        }
    }
}