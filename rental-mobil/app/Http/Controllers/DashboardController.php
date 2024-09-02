<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use App\Models\Returns;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $car = Car::count();
        $user = User::where('id', '!=', 1)->count();
        $rental = Rental::count();
        $returns = Returns::count();
        
        return view('dashboard.index', compact('car', 'user', 'rental', 'returns'));
    }
}
