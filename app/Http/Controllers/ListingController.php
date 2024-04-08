<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public function index(Request $request){
        
        return view('listings.index', [
            'heading' => 'Latest listings',
            'listings' => Listing::latest()->filter(request(['tag','search']))->paginate(4)
        ]
    );
    }

    public function show(Listing $listing){
        return view("listings.show",[
            'listings' => $listing
        ]
        );
    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request){
       
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required',Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        Listing::create($formFields);
        return redirect("/")->with('message','Listing created succesfully!');
    }

    //Update listing data 
    public function update(Request $request, Listing $listing){
       
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required','email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

       $listing->update($formFields);
        return back()->with('message','Gig updated successfully');
    }



    //Show edit form 
    public function edit(Listing $listing){
       
        return view('listings.edit', ['listings'=>$listing]);
    
    }

    // Delete a listing
    public function destroy(Listing $listing){
    $listing->delete();
    return redirect('/')->with('message','Gig deleted successfully');
    
    }

}
