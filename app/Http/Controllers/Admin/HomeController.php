<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Event;

class HomeController
{
    public function index()
    {
        $totalUsers = User::count();

        // Logic to get total events count
        $totalEvents = Event::count();

        // Logic to get total approved events count
        $totalApprovedEvents = Event::where('states', '1')->count();

        // Logic to get total refused events count
        $totalRefusedEvents = Event::where('states', '0')->count();

        // Logic to get total in-progress events count
        $totalInProgressEvents = Event::where('states', '2')->count();


        return view('home', compact(
            'totalUsers',
            'totalEvents',
            'totalApprovedEvents',
            'totalRefusedEvents',
            'totalInProgressEvents'
        ));
    }
}
