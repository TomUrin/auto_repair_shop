<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Workshop;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
        $services = Service::all();
        return view('services.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $workshops = Workshop::all();
        return view('services.create', ['workshops' => $workshops]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = new Service;

        $service->workshop_id = $request->workshops;
        $service->service_title = $request->title;
        $service->duration = $request->duration;
        $service->price = $request->price;
        

        $service->save();
        return redirect()->route('services-index')->with('success', 'Services information successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(int $serviceId)
    {
        $service = Service::where('id', $serviceId)->first();
        return view('services.show', ['service' => $service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $services)
    {
        return view('services.edit', ['services' => $services]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request;   $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $services)
    {
        $services->service_title = $request->newTitle;
        $services->duration = $request->newDuration;
        $services->price = $request->newPrice;
        $services->save();
        return redirect()->route('services-index')->with('infoUpdate', 'Service information have been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $services)
    {
        $services->delete();
        return redirect()->route('services-index')->with('deleted', 'Mechanics information successfully deleted.');
    }
}
