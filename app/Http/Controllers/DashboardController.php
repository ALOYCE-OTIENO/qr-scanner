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
        $user = Auth::user();

        if ($user->isAdmin()) {
            // Admin Dashboard - Company-wide stats
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

            return view('dashboard.admin', compact(
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
        } else {
            // Employee Dashboard - Personal stats only
            $employee = Employee::where('email', $user->email)->first();
            
            if (!$employee) {
                // User without employee record - show minimal dashboard
                $myPendingTasks = \App\Models\Task::where('assignee_id', $user->id)
                    ->where('status', 'pending')
                    ->count();
                
                $myCompletedTasks = \App\Models\Task::where('assignee_id', $user->id)
                    ->where('status', 'completed')
                    ->count();

                $myPendingApprovals = \App\Models\Approval::where('requester_id', $user->id)
                    ->where('status', 'pending')
                    ->count();

                return view('dashboard.user', compact(
                    'employee',
                    'myPendingTasks',
                    'myCompletedTasks',
                    'myPendingApprovals'
                ));
            }

            // Personal attendance stats
            $myAttendanceToday = Attendance::where('employee_id', $employee->id)
                ->where('date', $today)
                ->first();
            
            $myAttendancesThisMonth = Attendance::where('employee_id', $employee->id)
                ->whereMonth('date', $today->month)
                ->whereYear('date', $today->year)
                ->count();
            
            $myLateCountThisMonth = Attendance::where('employee_id', $employee->id)
                ->whereMonth('date', $today->month)
                ->whereYear('date', $today->year)
                ->where('status', 'late')
                ->count();

            // Personal job outputs
            $myJobOutputsToday = JobOutput::where('employee_id', $employee->id)
                ->whereDate('created_at', $today)
                ->count();
            
            $myJobOutputsThisMonth = JobOutput::where('employee_id', $employee->id)
                ->whereMonth('created_at', $today->month)
                ->whereYear('created_at', $today->year)
                ->count();

            // Recent personal activity
            $myRecentAttendances = Attendance::where('employee_id', $employee->id)
                ->orderBy('date', 'desc')
                ->orderBy('check_in_time', 'desc')
                ->take(5)
                ->get();

            $myRecentJobOutputs = JobOutput::where('employee_id', $employee->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Personal tasks
            $myPendingTasks = \App\Models\Task::where('assignee_id', $user->id)
                ->where('status', 'pending')
                ->count();
            
            $myCompletedTasks = \App\Models\Task::where('assignee_id', $user->id)
                ->where('status', 'completed')
                ->count();

            // Pending approvals
            $myPendingApprovals = \App\Models\Approval::where('requester_id', $user->id)
                ->where('status', 'pending')
                ->count();

            return view('dashboard.user', compact(
                'employee',
                'myAttendanceToday',
                'myAttendancesThisMonth',
                'myLateCountThisMonth',
                'myJobOutputsToday',
                'myJobOutputsThisMonth',
                'myRecentAttendances',
                'myRecentJobOutputs',
                'myPendingTasks',
                'myCompletedTasks',
                'myPendingApprovals'
            ));
        }
    }
}
