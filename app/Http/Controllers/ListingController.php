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
}
