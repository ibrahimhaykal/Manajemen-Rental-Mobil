<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental; // Make sure to import the User model
use App\Models\Returns; // Make sure to import the User model

class ReturnController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
        $rentals = Rental::whereNotExists(function ($query) {
        $query->select(Returns::raw(1))
              ->from('returns')
              ->whereRaw('rentals.id = returns.rental_id');
    })->get();

    return view('returns.index', compact('rentals'));
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string',
        ]);

        // Cari rental yang memiliki mobil dengan nomor plat yang diinputkan
        $rental = Rental::whereHas('car', function ($query) use ($request) {
            $query->where('license_plate', $request->license_plate);
        })->whereNotExists(function ($query) {
            $query->select(Returns::raw(1))
                  ->from('returns')
                  ->whereRaw('rentals.id = returns.rental_id')
                  ->whereNull('returns.return_date');
        })->first(); // Menggunakan first() untuk mendapatkan hasil pertama
        
        if (!$rental) {
            return back()->with('error', 'No rental found for the provided license plate number.');
        }
        
        // Hitung jumlah hari sewa
        $startDate = strtotime($rental->start_date);
        $endDate = strtotime($rental->end_date);
        $duration = ($endDate - $startDate) / (60 * 60 * 24) + 1;
        
        // Hitung biaya sewa berdasarkan tarif harian dan durasi sewa
        $rentalCost = $rental->car->rental_rate_per_day * $duration;
        
        // Simpan data pengembalian
        Returns::create([
            'rental_id' => $rental->id,
            'return_date' => now(),
            'rental_cost' => $rentalCost,
            'status' => 'RETURNED',
        ]);
        return redirect()->route('returns.index')->with('success', 'Car returned successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);

        $rental->update([
            'return_date' => now(),
            'status' => 'RETURNED',
        ]);

        return redirect()->route('returns.index')->with('success', 'Car returned successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}