<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Workshop;
use App\Models\Mechanic;
use App\Models\Service;
use Post;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $orders = Order::orderBy('id', 'desc')->get();


        return view('orders.allOrders', [
            'orders' => $orders,
            'statuses' => Order::STATUSES
        
        ]);
    }

    public function setStatus(Request $request, Order $order)
    {
        // $selected = SelectedServices::first();
        // $selectedServices->workshop_id = $selected->workshop_id;
        // $selectedServices->mechanic_id = $selected->mechanic_id;
        // $selectedServices->service_id = $selected->service_id;
        // $selectedServices->user_id = $selected->user_id;
        // $selectedServices->date = $selected->date;
        // $selectedServices->time = $selected->time;
        $order->status = $request->status;
        $order->save();
        return redirect()->back();
    }
    
    
    public function add(Request $request)
    {
        $workshops = Workshop::all();
        $mechanics = Mechanic::all();
        $services = Service::all();

        $order = new Order;

        $order->workshop_id = $request->workshop_id;
        $order->mechanic_id = $request->mechanic_id;
        $order->service_id = $request->service_id;
        $order->date = $request->date;
        $order->time = 0;
        $order->user_id = Auth::user()->id;

        $order->save();

        return redirect()->route('my-orders', ['workshops' => $workshops, 'mechanics' => $mechanics, 'services' => $services]);

    }

    public function showMyOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();


        $orders = $orders->map(function($o) {
            $time = Carbon::create($o->created_at)->setTimezone('Europe/Vilnius');

            // $time->next('Monday')->addHours(12);
            // dd($time);
            $o->time = $time->format('Y-m-d') . '&nbsp;&nbsp;&nbsp' . $time->format('H:i');
            // $o->time = '<script>alert("batai")</script>';
            return $o;
        });
        $mechanics = Mechanic::all();
       

        return view('orders.index', [
            'mechanics' => $mechanics,
            'orders' => $orders,
            'statuses' => Order::STATUSES
        ]);
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
        
       return redirect()->route('my-orders', ['workshops' => $workshops, 'mechanics' => $mechanics, 'services' => $services]);
    }
}
