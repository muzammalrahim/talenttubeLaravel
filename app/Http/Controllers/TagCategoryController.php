<?php

namespace App\Http\Controllers;

use App\TagCategory;
use Illuminate\Http\Request;

class TagCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('com');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TagCategory  $tagCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TagCategory $tagCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TagCategory  $tagCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TagCategory $tagCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TagCategory  $tagCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TagCategory $tagCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TagCategory  $tagCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TagCategory $tagCategory)
    {
        //
    }
}
