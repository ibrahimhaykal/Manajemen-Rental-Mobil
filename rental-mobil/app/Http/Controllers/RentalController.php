<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use DateTime;

class RentalController extends Controller
{
    public function index(Request $request)
{
    $rentals = Rental::all(); // atau query sesuai kebutuhan Anda
    if ($request->ajax()) {
        $data = Rental::with('user', 'car')->latest()->get(); // Eager loading user and car relationships
        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('user_id', function (Rental $rental) {
                return $rental->user->name;
            })
            ->editColumn('car_id', function (Rental $rental) {
                return $rental->car->name;
            })
            ->editColumn('start_date', function (Rental $rental) {
                return Carbon::parse($rental->start_date)->format('d F Y');
            })
            ->editColumn('end_date', function (Rental $rental) {
                return Carbon::parse($rental->end_date)->format('d F Y');
            })
            ->editColumn('total_cost', function (Rental $rental) {
                return number_format($rental->total_cost, 2);
            })
            ->addColumn('action', function(Rental $rental){
                $btn = '<a href='. route("rental.edit", $rental->id) . ' class="edit btn btn-success btn-sm"><i class="fas fa-edit"></i></a>';
                $btn .= '<form class="d-inline" action='. route("rental.destroy", $rental->id) . ' method="POST">
                            ' . method_field('DELETE') . '
                            ' . csrf_field() . '
                            <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                        </form>';
                        $btn = $btn . '<a href='. route("rental.show", $rental->id) . ' class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>';
                        $btn = $btn.'<form class="d-inline" action='. route("rental.status", $rental->id) . ' method="POST">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <input type="hidden" name="status" value="SUCCESS">
                        <button class="btn btn-outline-success btn-sm" type="submit"><i class="far fa-check-circle"></i></button>
                        </form>';
                        $btn = $btn.'<form class="d-inline" action='. route("rental.status", $rental->id) . ' method="POST">
                        <input type="hidden" name="_token" value=' . csrf_token() . '>
                        <input type="hidden" name="status" value="FAILED">
                        <button class="btn btn-outline-danger btn-sm" type="submit"><i class="far fa-times-circle"></i></button>
                        </form>';
                        return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);            
    }

    return view('rental.index');
}
    public function create()
    {
        $cars = Car::all();
        $users = User::all();
        return view('rental.create', compact('cars', 'users'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'user_id'    => 'required|exists:users,id',
            'car_id'     => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ];

        $data = $request->validate($rules);

        // Calculate total cost
        $car = Car::findOrFail($data['car_id']);
        $start_date =new DateTime($data['start_date']);
        $end_date =  new DateTime($data['end_date']);
        $duration = $start_date->diff($end_date)->days + 1;
        $data['total_cost'] = $car->rental_rate_per_day * $duration;

        // Set status
        $data['status'] = 'PENDING';

        // Create the rental record
        Rental::create($data);

        return redirect()->route('rental.index')->with('success', 'Rental created successfully.');
    }

    public function edit(Rental $rental){
        $users = User::all();
        $cars = Car::all();
        return view('rental.edit', compact('users', 'cars', 'rental'));
    }
    
    public function update(Request $request, Rental $rental){
        $data = $request->validate([
            'user_id'    =>  'required',
            'car_id'    =>  'required',
            'start_date'    =>  'required',
            'end_date'    =>  'required',
        ]);
    
        $car = Car::find($request->car_id);
        $start_date = new DateTime($request->start_date);
        $end_date = new DateTime($request->end_date);
        $duration = $start_date->diff($end_date);
        $data['total_cost'] = $car->rental_rate_per_day * $duration->days;
    
        $rental->update($data);
    
        return redirect()->route('rental.index')->with('success', 'Rental successfully updated');
    }
    

public function destroy(Rental $rental)
{
    $rental->delete();

    return redirect()->route('rental.index')->with('success', 'Rental data successfully deleted');
}
public function show(Rental $rental){
    $rental = Rental::with('user', 'car')->find($rental->id);
    return view('rental.show', compact('rental'));
}

public function status(Request $request, Rental $rental){
    $rental->update([
        'status' => $request->status
    ]);
    
    return redirect()->route('rental.index')->with('success', 'Status Rental berhasil diperbarui');
}

}