<?php

namespace App\Http\Controllers;

use App\Listing;
use App\Shortlist;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShortlistController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
        ]);

        $user = Auth::user();
        
        
        $newlisting = Listing::findOrFail($request->listing_id);
        // dd($newlisting);
        
        Shortlist::create([
            'listing_id' => $newlisting->id,
            'user_id' => $user->id,
            'name' => $newlisting->title,
            'email' => $user->email,
            'contact_number' => $user->contact_number ?? '', // Ensure this field exists in your user table or model
            'description' => $newlisting->description ?? '',
        ]);

        return redirect()->back()->with('success', 'Property has been added to your shortlist.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
        ]);

        Shortlist::where('listing_id', $request->listing_id)
                  ->where('user_id', auth()->id())
                  ->delete();

        return redirect()->back()->with('success', 'Property has been removed from your shortlist.');
    }
}