<?php

namespace App\Http\Controllers\Library;

use App\Models\UserLibrary;
use Illuminate\Http\Request;
use App\Enums\BookCondition;
use App\Enums\BookStatus;

class UserLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $request->validate([
            'name' => 'required',
            'book_id' => 'required',
            'condition' => ['required', new EnumValue(BookCondition::class)],
            'status' => ['required', new EnumValue(BookStatus::class)]
        ]);

        try {
            UserLibrary::create($request->all());
    
            return response()->json([ "success" => true]);
        } catch (\Throwable $th) {
            return response()->json([ "success" => false, "message" => $th]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserLibrary  $userLibrary
     * @return \Illuminate\Http\Response
     */
    public function show(UserLibrary $userLibrary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserLibrary  $userLibrary
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLibrary $userLibrary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserLibrary  $userLibrary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserLibrary $userLibrary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserLibrary  $userLibrary
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLibrary $userLibrary)
    {
        //
    }
}
