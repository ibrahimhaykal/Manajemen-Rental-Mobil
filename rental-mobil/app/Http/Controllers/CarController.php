<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Car;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', ''); // Initialize search to an empty string if not provided
        $cars = Car::query()
            ->when($search, function ($query, $search) {
                if (strtolower($search) === 'available') {
                    return $query->where('availability', 1); // Only available cars
                } elseif (strtolower($search) === 'not available') {
                    return $query->where('availability', 0); // Only not available cars
                } else {
                    return $query->where('brand', 'like', "%{$search}%")
                                 ->orWhere('model', 'like', "%{$search}%")
                                 ->orWhere('license_plate', 'like', "%{$search}%");
                }
            })
            ->get();
    
        return view('cars.index', compact('cars', 'search'));
    }
    

    

    public function create()
{
   return view('cars.create');
}

public function store(Request $request)
{
    // Validate the incoming request data
    $data = $request->validate([
        'brand' => 'required',
        'model' => 'required',
        'license_plate' => 'required',
        'rental_rate_per_day' => 'required|numeric',
        'availability' => 'required|boolean',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
    ]);

    // Handle the image upload
    if ($request->file('image')) {
        $data['image'] = $request->file('image')->store('cars');
    }

    // Create a new car entry in the database
    Car::create($data);

    // Redirect to the car index page with a success message
    return redirect()->route('car.index')->with('success', 'Car data added successfully');
}

    
public function edit(Car $car)
{
    return view('cars.edit', ['car' => $car]);
}

public function update(Request $request, Car $car)
{
    $data = $request->validate([
        'brand' => 'required',
        'model' => 'required',
        'license_plate' => 'required',
        'rental_rate_per_day' => 'required|numeric',
        'availability' => 'required|boolean',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->file('image')) {
        if ($car->image) {
            Storage::delete($car->image);
        }
        $data['image'] = $request->file('image')->store('cars');
    }

    $car->update($data);

    return redirect()->route('car.index')->with('success', 'Car data successfully updated');
}
    public function destroy(Car $car)
    {
        if ($car->image) {
            Storage::delete($car->image);
        }
        $car->delete();
        return redirect()->route('car.index')->with('success', 'Data mobil berhasil dihapus');
    }
}
