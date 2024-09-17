<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Job;
use App\Models\Offer;
use App\Models\Application;
use App\Models\Interview;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalJobs = Job::count();
        $totalOffers = Offer::count();
        $totalApplications = Application::count();
        $totalInterviews = Interview::count();

        return response()->json([
            'totalUsers' => $totalUsers,
            'totalJobs' => $totalJobs,
            'totalOffers' => $totalOffers,
            'totalApplications' => $totalApplications,
            'totalInterviews' => $totalInterviews,
        ]);
    }
}