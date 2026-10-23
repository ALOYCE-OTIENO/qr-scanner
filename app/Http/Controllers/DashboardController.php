<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\JobOutput;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        
        // Get today's statistics
        $totalEmployees = Employee::where('is_active', true)->count();
        $presentToday = Attendance::where('date', $today)->count();
        $lateToday = Attendance::where('date', $today)->where('status', 'late')->count();
        
        // Get job outputs for today
        $jobOutputsToday = JobOutput::whereDate('created_at', $today)->count();
        $completedJobsToday = JobOutput::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->count();

        // Recent attendances
        $recentAttendances = Attendance::with('employee')
            ->orderBy('date', 'desc')
            ->orderBy('check_in_time', 'desc')
            ->take(10)
            ->get();

        // Recent job outputs
        $recentJobOutputs = JobOutput::with(['employee', 'attendance'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Chart data - Last 7 days attendance
        $attendanceLabels = [];
        $attendanceData = [];
        $lateData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $attendanceLabels[] = $date->format('M d');
            $attendanceData[] = Attendance::where('date', $date)->count();
            $lateData[] = Attendance::where('date', $date)->where('status', 'late')->count();
        }

        // Chart data - Last 7 days job outputs
        $jobOutputLabels = [];
        $jobOutputData = [];
        $completedJobData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $jobOutputLabels[] = $date->format('M d');
            $jobOutputData[] = JobOutput::whereDate('created_at', $date)->count();
            $completedJobData[] = JobOutput::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->count();
        }

        return view('dashboard', compact(
            'totalEmployees',
            'presentToday',
            'lateToday',
            'jobOutputsToday',
            'completedJobsToday',
            'recentAttendances',
            'recentJobOutputs',
            'attendanceLabels',
            'attendanceData',
            'lateData',
            'jobOutputLabels',
            'jobOutputData',
            'completedJobData'
        ));
    }
}
