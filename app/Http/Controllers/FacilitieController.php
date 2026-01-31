<?php

namespace App\Http\Controllers;

use App\Models\Facilitie;
use Illuminate\Http\Request;

class FacilitieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $data = Facilitie::get();
        return view('backend.facilitie.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Facilitie $facilitie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facilitie $facilitie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facilitie $facilitie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facilitie $facilitie)
    {
        //
    }
}
