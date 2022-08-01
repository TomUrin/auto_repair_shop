<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use App\Models\Workshop;
use Illuminate\Http\Request;

class MechanicController extends Controller
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
        $mechanics = Mechanic::all();
        return view('mechanics.index', ['mechanics' => $mechanics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workshops = Workshop::all();
        return view('mechanics.create', ['workshops' => $workshops]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mechanic = new Mechanic;

        if ($request->file('mechanic_photo')) {
            $photo = $request->file('mechanic_photo');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name . '-' . rand(100000, 999999) . '.' . $ext;
            $photo->move(public_path() . '/images', $file);
            $mechanic->image_path = asset('/images') . '/' . $file;
        }
        
        $mechanic->name = $request->name;
        $mechanic->surname = $request->surname;
        $mechanic->workshop_id = $request->workshops;
        $mechanic->rating = 0;
        $mechanic->avrRating = 0;
        $mechanic->rate_count = 0;


        $mechanic->save();
        return redirect()->route('mechanics-index')->with('success', 'Mechanics information successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function show(int $mechanicId)
    {
        $mechanic = Mechanic::where('id', $mechanicId)->first();
        return view('mechanics.show', ['mechanic' => $mechanic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function edit(Mechanic $mechanic)
    {
        $workshops = Workshop::all();
        return view('mechanics.edit', ['mechanics' => $mechanic, 'workshops' => $workshops]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mechanic $mechanic)
    {
        if ($request->file('mechanic_photo')) {

            $name = pathinfo($mechanic->image_path, PATHINFO_FILENAME);
            $ext = pathinfo($mechanic->image_path, PATHINFO_EXTENSION);

            $path = public_path('/images') . '/' . $name . '.' . $ext;
        
            if (file_exists($path)) {
                unlink($path);
            }
        
            $photo = $request->file('mechanic_photo');

            $ext = $photo->getClientOriginalExtension();

            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);

            $file = $name . '-' . rand(100000, 999999) . '.' . $ext;

            $photo->move(public_path() . '/images', $file);

            $mechanic->image_path = asset('/images') . '/' . $file;

        }

        

        if ($request->newRating) {
            $mechanic->name = $mechanic->name;
        $mechanic->surname = $request->newSurname;
        $mechanic->workshop_id = $request->newWorkshop;
            $mechanic->rating += $request->newRating;
            $mechanic->rate_count++;
            $mechanic->avrRating = ($mechanic->rating / $mechanic->rate_count);
        } else {
            $mechanic->name = $mechanic->name;
        $mechanic->surname = $request->newSurname;
        $mechanic->workshop_id = $request->newWorkshop;
            $mechanic->rating = $mechanic->rating;
            $mechanic->rate_count = $mechanic->rate_count;
            $mechanic->avrRating = $mechanic->avrRating;
        };

        $mechanic->name = $request->newName;
        $mechanic->surname = $request->newSurname;
        $mechanic->workshop_id = $request->newWorkshop;
        
        $mechanic->save();
        return redirect()->route('mechanics-index')->with('infoUpdate', 'Mechanics information have been successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mechanic  $mechanic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mechanic $mechanic)
    {
        $mechanic->delete();
        return redirect()->route('mechanics-index')->with('deleted', 'Mechanics information successfully deleted.');
    }
}
