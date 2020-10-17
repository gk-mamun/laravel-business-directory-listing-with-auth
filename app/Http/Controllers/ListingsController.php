<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingsController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show', 'showout']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::orderBy('created_at', 'desc')->paginate(5);

        return view('listings')->with('listings', $listings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('listings/create_listing');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the inputs
        $this->validate($request, [
            'user-id' => 'required',
            'company-name' => 'required',
            'contact-email' => 'required',
            'company-website' => 'required',
            'contact-phone' => 'required',
            'address' => 'required',
            'company-image' => 'image|max:1999',
            'bio' => 'required'
        ]);


        // File name with extension
        $fileNamewithExt = $request->file('company-image')->getClientOriginalName();

        // Get just file name
        $fileName = pathinfo($fileNamewithExt, PATHINFO_FILENAME);

        // Get file extension
        $fileExtension = $request->file('company-image')->getClientOriginalExtension();

        // Create new file name
        $newFileName = $fileName . '_' . time() . '.' . $fileExtension;

        // Upload Image
        $path = $request->file('company-image')->storeAs('/public/company_images', $newFileName);


        $listing = New Listing();

        $listing->user_id = request('user-id');
        $listing->business_name = request('company-name');
        $listing->address = request('address');
        $listing->website = request('company-website');
        $listing->email = request('contact-email');
        $listing->phone = request('contact-phone');
        $listing->bio = request('bio');
        $listing->business_image = $newFileName;

        $listing->save();

        // php artisan storage:link => use this command to link images into public folder

        return redirect('/dashboard')->with('message', 'New Business Directory has been added');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listing = Listing::findOrFail($id);

        return view('/listings/showlisting')->with('listing', $listing);
    }

    public function showout($id) {

        $listing = Listing::findOrFail($id);

        return view('/showoutlisting')->with('listing', $listing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listing = Listing::findOrFail($id);

        return view('/listings/editlisting')->with('listing', $listing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $listing = Listing::find($id);

        $listing->user_id = request('user-id');
        $listing->business_name = request('company-name');
        $listing->address = request('address');
        $listing->website = request('company-website');
        $listing->email = request('contact-email');
        $listing->phone = request('contact-phone');
        $listing->bio = request('bio');

        if($request->hasfile('company-image')) {
            // File name with extension
            $fileNamewithExt = $request->file('company-image')->getClientOriginalName();

            // Get just file name
            $fileName = pathinfo($fileNamewithExt, PATHINFO_FILENAME);

            // Get file extension
            $fileExtension = $request->file('company-image')->getClientOriginalExtension();

            // Create new file name
            $newFileName = $fileName . '_' . time() . '.' . $fileExtension;

            // Upload Image
            $path = $request->file('company-image')->storeAs('/public/company_images', $newFileName);

            $listing->business_image = $newFileName;
        }

        $listing->save();

        return redirect('/dashboard')->with('message', 'Business Directory has been Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the row to delete
        $listing = Listing::find($id);

        // Delete the row
        $listing->delete();

        return redirect('/dashboard')->with('message', 'Directory has been deleted');
    }
}
