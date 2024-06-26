<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    Listing, Realtor, User
};

use Illuminate\Support\Facades\Auth;


class ListingRealtorController extends Controller
{

    // public function index()
    // {
    //     $listings = Listing::orderBy('id', 'DESC')->get();
    //     $published_listings = $listings->where('is_published', '1');
    //     $unpublished_listings = $listings->where('is_published', '0');
    //     $listings = Listing::where('is_published', '1')->orderBy('id', 'DESC')->get();
    //     return view('agents.listings.createlisting', compact('published_listings','unpublished_listings'));

    // }

    public function index()
    {

    if(Auth::user()->role == 1){
    
    $user = Auth::user();

    // Get all listings for the authenticated user, ordered by ID in descending order
    // $listings = Listing::where('realtor_id', $user->id)->orderBy('id', 'DESC')->get();

    $listings = Listing::orderBy('id', 'DESC')->get();
    // dd($listings);

    // Filter listings based on publication status
    $published_listings = $listings->where('is_published', '1');
    $unpublished_listings = $listings->where('is_published', '0');

    return view('agents.listings.mylisting', compact('published_listings', 'unpublished_listings'));

    }
    else {
        return route("becomerealtor");
    };
    
    }
    // Pass the filtered listings to the view




    public function create()
    {
        $realtors = Realtor::all();
        
        $user = auth()->user();
        $roleEmail = $user -> email;
        $newrealtor = Realtor::where('email', $roleEmail)->firstOrFail();
        return view('agents.listings.add-listing', compact('newrealtor'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'square_feet' => 'required',
            'lot_size' => 'required',
            'lot_size' => 'required',
            'garage' => 'required',
            'bedroom' => 'required',
            'bathroom' => 'required',
            'city' => 'required',
            'country' => 'required',
            'realtor_id' => 'required',
            'is_published' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $listing = new Listing([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'square_feet' => $request->get('square_feet'),
            'lot_size' => $request->get('lot_size'),
            'bedroom' => $request->get('bedroom'),
            'bathroom' => $request->get('bathroom'),
            'garage' => $request->get('garage'),
            'city' => $request->get('city'),
            'country' => $request->get('country'),
            'realtor_id' => $request->get('realtor_id'),
            'is_published' => $request->get('is_published'),

        ]);


        //call custom file upload function
        $isSuccess = $this->massimageUploadHandler($request, $listing);

        if ($isSuccess) {
            
            $listing->save();
            return redirect(route('mylisting.index'))->with('success', 'Listing Added!');
        } else {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }


    public function show($id)
    {
        $listing = Listing::findOrFail($id);
        return view('agents.listings.single-listing', compact('listing'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $listing = Listing::findOrFail($id);


        $listing->title = $request->get('title');
        $listing->description = $request->get('description');
        $listing->price = $request->get('price');
        $listing->square_feet = $request->get('square_feet');
        $listing->lot_size = $request->get('lot_size');
        $listing->garage = $request->get('garage');
        $listing->bedroom = $request->get('bedroom');
        $listing->bathroom = $request->get('bathroom');
        $listing->city = $request->get('city');
        $listing->country = $request->get('country');
        $listing->realtor_id = $request->get('realtor_id');
        $listing->is_published = $request->get('is_published');


        //function for image upload
        $this->massimageUploadHandler($request, $listing);
        $listing->save();
        return redirect(route('mylisting.index'))->with('success', 'Listing Updated Successfully!');
    }


    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);

        $isSuccess = $listing->delete();

        if ($isSuccess) {
            $this->imageDeleteHandler($listing);
        }
        return redirect(route('mylisting.index'))->with('success', 'Listing Deleted Successfully!');
    }


    //method for mass image upload
    private function massimageUploadHandler($request, $listing)
    {
        $isSuccess = FALSE;
        $images = array(
            $request->image,
            $request->image_one,
            $request->image_two,
            $request->image_three,
            $request->image_four,
            $request->image_five,
            $request->image_six,
        );

        foreach ($images as $key => $image) {


            if (file_exists($image)) {

                $isSuccess = $this->imageUploadHandler($image, $listing, $key);
            }
        }
        return $isSuccess;
    }

    //method for image upload

    private function imageUploadHandler($image, $listing, $key)
    {
        $image_new_name = time() . '.' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();
        //$image_new_name = $name.'.'.time().'.'.$image->getClientOriginalExtension(); 
        $isScucess = $image->move(public_path('images/listing'), $image_new_name);
        if ($isScucess) {
            $image_url = 'images/listing/' . $image_new_name;
            $table_name = 'thumbnail_' . $key;
            if (file_exists($listing->$table_name)) {
                unlink($listing->$table_name);
            }
            $listing->$table_name = $image_url;

            return TRUE;
            return FALSE;
        }
    }

    //method for delete image from folder
    private function imageDeleteHandler($listing)
    {
        $images = array(
            $listing->thumbnail_0,
            $listing->thumbnail_1,
            $listing->thumbnail_2,
            $listing->thumbnail_3,
            $listing->thumbnail_4,
            $listing->thumbnail_5,
            $listing->thumbnail_6,
        );
        foreach ($images as $image) {
            if (file_exists($image)) {
                unlink($image);
            }
        }
    }
}
