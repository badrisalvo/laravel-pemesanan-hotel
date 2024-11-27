<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all About records
        $abouts = About::all();
        return view('admin.about', compact('abouts'));
    }
    
    public function home()
    {
        // Get all About records
        $abouts = About::all();
        return view('frontend.home', ['abouts' => $abouts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create a new About record
        About::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route('about.index')->with('success', 'About added successfully.');
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
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Find the About record and update it
        $about = About::findOrFail($id);
        $about->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // Redirect back to the index page with a success message
        return redirect()->route('about.index')->with('success', 'About updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the About record and delete it
        $about = About::findOrFail($id);
        $about->delete();

        // Redirect back to the index page with a success message
        return redirect()->route('about.index')->with('success', 'About deleted successfully.');
    }

}
