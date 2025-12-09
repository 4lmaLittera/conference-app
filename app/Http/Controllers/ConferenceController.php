<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\UpdateConferenceRequest;
use App\Models\Conference;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conferences = Conference::orderBy('date')->get();

        return view('conferences.index', compact('conferences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('conferences.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConferenceRequest $request)
    {
        Conference::create($request->validated());

        return redirect()->route('conferences.index')
            ->with('success', __('conferences.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Conference $conference)
    {
        return view('conferences.show', compact('conference'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conference $conference)
    {
        return view('conferences.edit', compact('conference'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConferenceRequest $request, Conference $conference)
    {
        $conference->update($request->validated());

        return redirect()->route('conferences.index')
            ->with('success', __('conferences.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conference $conference)
    {
        $conference->delete();

        return redirect()->route('conferences.index')
            ->with('success', __('conferences.deleted'));
    }
}
