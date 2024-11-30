<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
            //this scope filters tags and searches, it does the magic for both make sure you have an input field named search

        return response()->json(Listing::latest()->filter(request(['tag', 'search']))->get());
        // return response()->json([
        //     'heading' => 'Lastest Listing',
        //     'listings' => [
        //         [
        //             'id' => 1,
        //             'title' => 'Listing 1',
        //             'description' => 'Listing 1 Description',
        //         ],
        //         [
        //             'id' => 2,
        //             'title' => 'Listing 2',
        //             'description' => 'Listing 2 Description',
        //         ]
        //     ]
        // ]);
    }

    public function show($id)
    {

       $listing = Listing::where('id', $id)->firstOrFail(); //find($id);

       if(!$listing) {
           return response()->json([
               'message' => 'Listing not found'
           ], 404);
       }

       return response()->json($listing);
    }

    function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'email' => 'required|email',
            'company' => 'required|string',
            'tags' => 'required|string',
            'location' => 'required|string',
            'website' => 'required|url',
        ]);

        if($request->hasFile('logo')) {
            $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing = Listing::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'email' => $validatedData['email'],
            'company' => $validatedData['company'],
            'tags' => $validatedData['tags'],
            'location' => $validatedData['location'],
            'website' => $validatedData['website'],
        ]);
        if(!$listing) {
            return response()->json([
                'message' => 'Listing not created'
            ], 500);
        }

        return response()->json([
            'message' => 'Listing created'
        ], 201);
    }

    public function edit(Listing $listing){
        
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Listing  $listing
     * @return \Illuminate\Http\Response
     */
    function update(Request $request , Listing $listing)
    {
        //return response()->json("we got here mate");

        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'email' => 'email',
            'company' => 'string',
            'tags' => 'string',
            'location' => 'string',
            'website' => 'url',
            //'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',

        ]);

        // if($request->hasFile('logo')) {
        //     $validatedData['logo'] = $request->file('logo')->store('logos', 'public');
        // }

        $update = $listing->update($validatedData);
        if(!$update) {
            return response()->json([
                'message' => 'There was a problem updating the listing'
            ], 500);
        }

        return response()->json([
            'message' => 'Listing updated successfully'
        ], 201);
    }

    public function updateListing(Request $request, $id) {
           // Log incoming data
        \Log::info('Updating Listing', ['id' => $id, 'data' => $request->all()]);

        // Validate incoming request
        $validatedData = $request->validate([
            'field_name' => 'required|string', // Replace 'field_name' with actual fields
            // Add more fields as needed
        ]);

        // Find the listing
        $listing = Listing::find($id);

        if (!$listing) {
            \Log::error('Listing not found', ['id' => $id]);
            return response()->json(['message' => 'Listing not found'], 404);
        }

        // Update the listing
        $listing->update($validatedData);

        // Return the updated data
        return response()->json($listing->fresh(), 200);
    }


/**
 * Remove the specified listing from storage.
 *
 * @param  \App\Models\Listing  $listing
 * @return void
 */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return response()->json(['message' => 'Listing deleted']);
    }
}
