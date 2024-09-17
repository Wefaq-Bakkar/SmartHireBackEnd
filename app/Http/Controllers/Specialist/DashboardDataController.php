<?php
// app/Http/Controllers/Specialist/DashboardDataController.php

namespace App\Http\Controllers\Specialist;

use App\Http\Controllers\Controller;
use App\Http\Resources\ApplicationResource;
use App\Http\Resources\InterviewResource;
use App\Models\Job;
use App\Models\Offer;
use App\Models\Application;
use App\Models\Interview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardDataController extends Controller
{
    public function index()
    {
        $specialistId = Auth::id();
        $totalJobs = Job::where('user_id', $specialistId)->count();
        $totalOffers = Offer::where('specialist_id', $specialistId)->count();
        $totalApplications = Application::where('specialist_id', $specialistId)->count();
        $totalInterviews = Interview::where('specialist_id', $specialistId)->count();

        $recentApplications = Application::where('specialist_id', $specialistId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recentInterviews = Interview::where('specialist_id', $specialistId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'totalJobs' => $totalJobs,
            'totalOffers' => $totalOffers,
            'totalApplications' => $totalApplications,
            'totalInterviews' => $totalInterviews,
            'recentApplications' => ApplicationResource::collection($recentApplications),
            'recentInterviews' => InterviewResource::collection($recentInterviews),
        ]);
    }
}