<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all Listings
    public function index(Request $request) {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(['tag' => $request->tag, 'search' => $request->search])->paginate(6)
        ]);
    }

    // Show a specific listing
    public function show($id) {
        $listing = Listing::find($id);

        if($listing) {
            return view('listings.show', [
                'listing' => Listing::find($id)
            ]);
        } else {
            abort('404');
        }
    }

    // Show Create form page
    public function create() {
        return view('listings.create');
    }

    // Store the listing
    public function store(Request $request) {

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        // validate logo file
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        // dd($formFields);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // Show Create form page
    public function edit($id) {

        $listing = Listing::find($id);

        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    //
    public function update(Request $request, $id) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        // validate logo file
        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // dd($formFields);

        Listing::where('id', '=', $id)->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete a listing
    public function destroy($id) {
        Listing::where('id', '=', $id)->delete();
        return back()->with('message', "Listing deleted successfully!");
    }
 
    // Show manage page
    public function manage() {
        return view('listings.manage',[
            'listings' => auth()->user()->listings()->get()
        ]);
    }
}
