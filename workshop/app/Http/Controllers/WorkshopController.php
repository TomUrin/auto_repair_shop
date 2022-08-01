<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\Mechanic;
use App\Models\Service;
use Illuminate\Http\Request;

class WorkshopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $workshop = match($request->sort) {
            'workshops-asc' => Workshop::orderBy('title', 'asc')->get(),
            'workshops-desc' => Workshop::orderBy('title', 'desc')->get(),
            default => Workshop::all()
        };
        return view('workshops.index', ['workshops' => $workshop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('workshops.create');
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
            'address' => 'required',
            'title' => 'required',
            'contact' => 'required|min:12|max:12'
        ]);

        $workshop = new Workshop;

        $workshop->address = $request->address;
        $workshop->title = $request->title;
        $workshop->contacts = $request->contact;

        $workshop->save();
        return redirect()->route('workshops-index')->with('success', 'Workshop successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function show(int $workshopId)
    {
        $workshop = Workshop::where('id', $workshopId)->first();
        return view('workshops.show', ['workshops' => $workshop]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function edit(Workshop $workshop)
    {
        return view('workshops.edit', ['workshop' => $workshop]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workshop $workshop)
    {
        $workshop->address = $request->newAddress;
        $workshop->title = $request->newTitle;
        $workshop->contacts = $request->newContact;
        $workshop->save();
        return redirect()->route('workshops-index')->with('infoUpdate', 'Workshops information have been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workshop  $workshop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        return redirect()->route('workshops-index')->with('deleted', 'Workshops information successfully deleted.');
    }

    public function pick(Request $request)
    {

        $workshops = match($request->sort) {
            'workshops-asc' => Workshop::orderBy('title', 'asc')->get(),
            'workshops-desc' => Workshop::orderBy('title', 'desc')->get(),
            default => Workshop::all()
        };
        $mechanics = Mechanic::all();
        $services = Service::all();
      
        return view('workshops.pick', ['workshops' => $workshops, 'mechanics' => $mechanics, 'services' => $services]);
    }

}
