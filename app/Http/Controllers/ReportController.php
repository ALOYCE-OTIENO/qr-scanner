<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\JobOutput;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display attendance reports page
     */
    public function attendanceIndex()
    {
        $employees = Employee::where('is_active', true)->get();
        $departments = Employee::select('department')->distinct()->pluck('department')->filter();
        
        return view('reports.attendance-index', compact('employees', 'departments'));
    }

    /**
     * Generate attendance report
     */
    public function attendanceReport(Request $request)
    {
        $type = $request->get('type', 'daily');
        $startDate = $request->get('start_date') ?? Carbon::today()->format('Y-m-d');
        $endDate = $request->get('end_date') ?? Carbon::today()->format('Y-m-d');
        $employeeId = $request->get('employee_id');
        $department = $request->get('department');

        $query = Attendance::with('employee');

        // Filter by date range
        if ($type === 'daily') {
            $query->where('date', $startDate);
        } elseif ($type === 'weekly') {
            $start = Carbon::parse($startDate)->startOfWeek();
            $end = Carbon::parse($startDate)->endOfWeek();
            $query->whereBetween('date', [$start, $end]);
        } elseif ($type === 'monthly') {
            $start = Carbon::parse($startDate)->startOfMonth();
            $end = Carbon::parse($startDate)->endOfMonth();
            $query->whereBetween('date', [$start, $end]);
        } elseif ($type === 'custom') {
            $query->whereBetween('date', [$startDate, $endDate]);
        }

        // Filter by employee
        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }

        // Filter by department
        if ($department) {
            $query->whereHas('employee', function ($q) use ($department) {
                $q->where('department', $department);
            });
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        // Calculate statistics
        $totalDays = $attendances->count();
        $presentDays = $attendances->where('status', 'present')->count();
        $lateDays = $attendances->where('status', 'late')->count();
        $absentDays = $attendances->where('status', 'absent')->count();

        // Calculate total work hours
        $totalWorkHours = 0;
        foreach ($attendances as $attendance) {
            if ($attendance->check_in_time && $attendance->check_out_time) {
                $checkIn = Carbon::parse($attendance->check_in_time);
                $checkOut = Carbon::parse($attendance->check_out_time);
                $totalWorkHours += $checkOut->diffInMinutes($checkIn) / 60;
            }
        }

        // Get unique employees
        $employees = Employee::where('is_active', true)->get();
        $departments = Employee::select('department')->distinct()->pluck('department')->filter();

        return view('reports.attendance', compact(
            'attendances',
            'type',
            'startDate',
            'endDate',
            'employeeId',
            'department',
            'employees',
            'departments',
            'totalDays',
            'presentDays',
            'lateDays',
            'absentDays',
            'totalWorkHours'
        ));
    }

    /**
     * Export attendance report to CSV
     */
    public function exportAttendanceCsv(Request $request)
    {
        $type = $request->get('type', 'daily');
        $startDate = $request->get('start_date') ?? Carbon::today()->format('Y-m-d');
        $endDate = $request->get('end_date') ?? Carbon::today()->format('Y-m-d');
        $employeeId = $request->get('employee_id');
        $department = $request->get('department');

        $query = Attendance::with('employee');

        if ($type === 'daily') {
            $query->where('date', $startDate);
        } elseif ($type === 'weekly') {
            $start = Carbon::parse($startDate)->startOfWeek();
            $end = Carbon::parse($startDate)->endOfWeek();
            $query->whereBetween('date', [$start, $end]);
        } elseif ($type === 'monthly') {
            $start = Carbon::parse($startDate)->startOfMonth();
            $end = Carbon::parse($startDate)->endOfMonth();
            $query->whereBetween('date', [$start, $end]);
        } elseif ($type === 'custom') {
            $query->whereBetween('date', [$startDate, $endDate]);
        }

        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }

        if ($department) {
            $query->whereHas('employee', function ($q) use ($department) {
                $q->where('department', $department);
            });
        }

        $attendances = $query->orderBy('date', 'desc')->get();

        $filename = "attendance_report_{$type}_{$startDate}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($attendances) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Date',
                'Employee ID',
                'Employee Name',
                'Department',
                'Position',
                'Check In',
                'Check Out',
                'Work Hours',
                'Status',
                'Notes'
            ]);

            foreach ($attendances as $attendance) {
                $workHours = null;
                if ($attendance->check_in_time && $attendance->check_out_time) {
                    $checkIn = Carbon::parse($attendance->check_in_time);
                    $checkOut = Carbon::parse($attendance->check_out_time);
                    $hours = $checkOut->diffInMinutes($checkIn) / 60;
                    $workHours = number_format($hours, 2) . ' hours';
                }

                fputcsv($file, [
                    $attendance->date,
                    $attendance->employee->employee_id,
                    $attendance->employee->full_name,
                    $attendance->employee->department,
                    $attendance->employee->position,
                    $attendance->check_in_time,
                    $attendance->check_out_time,
                    $workHours,
                    $attendance->status,
                    $attendance->notes,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Display job output reports page
     */
    public function jobOutputIndex()
    {
        $employees = Employee::where('is_active', true)->get();
        $departments = Employee::select('department')->distinct()->pluck('department')->filter();
        
        return view('reports.job-output-index', compact('employees', 'departments'));
    }

    /**
     * Generate job output report
     */
    public function jobOutputReport(Request $request)
    {
        $type = $request->get('type', 'daily');
        $startDate = $request->get('start_date') ?? Carbon::today()->format('Y-m-d');
        $endDate = $request->get('end_date') ?? Carbon::today()->format('Y-m-d');
        $employeeId = $request->get('employee_id');
        $department = $request->get('department');
        $status = $request->get('status');

        $query = JobOutput::with(['employee', 'attendance']);

        // Filter by date range
        if ($type === 'daily') {
            $query->whereDate('created_at', $startDate);
        } elseif ($type === 'weekly') {
            $start = Carbon::parse($startDate)->startOfWeek();
            $end = Carbon::parse($startDate)->endOfWeek();
            $query->whereBetween('created_at', [$start, $end]);
        } elseif ($type === 'monthly') {
            $start = Carbon::parse($startDate)->startOfMonth();
            $end = Carbon::parse($startDate)->endOfMonth();
            $query->whereBetween('created_at', [$start, $end]);
        } elseif ($type === 'custom') {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Filter by employee
        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }

        // Filter by department
        if ($department) {
            $query->whereHas('employee', function ($q) use ($department) {
                $q->where('department', $department);
            });
        }

        // Filter by status
        if ($status) {
            $query->where('status', $status);
        }

        $jobOutputs = $query->orderBy('created_at', 'desc')->get();

        // Calculate statistics
        $totalTasks = $jobOutputs->count();
        $completedTasks = $jobOutputs->where('status', 'completed')->count();
        $pendingTasks = $jobOutputs->where('status', 'pending')->count();
        $rejectedTasks = $jobOutputs->where('status', 'rejected')->count();

        // Calculate total quantity and average quality score
        $totalQuantity = $jobOutputs->sum('quantity');
        $avgQualityScore = $jobOutputs->whereNotNull('quality_score')->avg('quality_score');

        // Get unique employees
        $employees = Employee::where('is_active', true)->get();
        $departments = Employee::select('department')->distinct()->pluck('department')->filter();

        return view('reports.job-output', compact(
            'jobOutputs',
            'type',
            'startDate',
            'endDate',
            'employeeId',
            'department',
            'status',
            'employees',
            'departments',
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'rejectedTasks',
            'totalQuantity',
            'avgQualityScore'
        ));
    }

    /**
     * Export job output report to CSV
     */
    public function exportJobOutputCsv(Request $request)
    {
        $type = $request->get('type', 'daily');
        $startDate = $request->get('start_date') ?? Carbon::today()->format('Y-m-d');
        $endDate = $request->get('end_date') ?? Carbon::today()->format('Y-m-d');
        $employeeId = $request->get('employee_id');
        $department = $request->get('department');
        $status = $request->get('status');

        $query = JobOutput::with(['employee', 'attendance']);

        if ($type === 'daily') {
            $query->whereDate('created_at', $startDate);
        } elseif ($type === 'weekly') {
            $start = Carbon::parse($startDate)->startOfWeek();
            $end = Carbon::parse($startDate)->endOfWeek();
            $query->whereBetween('created_at', [$start, $end]);
        } elseif ($type === 'monthly') {
            $start = Carbon::parse($startDate)->startOfMonth();
            $end = Carbon::parse($startDate)->endOfMonth();
            $query->whereBetween('created_at', [$start, $end]);
        } elseif ($type === 'custom') {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }

        if ($department) {
            $query->whereHas('employee', function ($q) use ($department) {
                $q->where('department', $department);
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        $jobOutputs = $query->orderBy('created_at', 'desc')->get();

        $filename = "job_output_report_{$type}_{$startDate}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($jobOutputs) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Date',
                'Employee ID',
                'Employee Name',
                'Department',
                'Task Name',
                'Description',
                'Quantity',
                'Unit',
                'Quality Score',
                'Status',
                'Completed At',
                'Remarks'
            ]);

            foreach ($jobOutputs as $jobOutput) {
                fputcsv($file, [
                    $jobOutput->created_at->format('Y-m-d'),
                    $jobOutput->employee->employee_id,
                    $jobOutput->employee->full_name,
                    $jobOutput->employee->department,
                    $jobOutput->task_name,
                    $jobOutput->description,
                    $jobOutput->quantity,
                    $jobOutput->unit,
                    $jobOutput->quality_score,
                    $jobOutput->status,
                    $jobOutput->completed_at ? $jobOutput->completed_at->format('Y-m-d H:i:s') : 'N/A',
                    $jobOutput->remarks,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Display employee performance report
     */
    public function employeePerformance(Request $request)
    {
        $startDate = $request->get('start_date') ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->get('end_date') ?? Carbon::now()->endOfMonth()->format('Y-m-d');

        $employees = Employee::where('is_active', true)->get();

        $employeeData = [];

        foreach ($employees as $employee) {
            $attendances = Attendance::where('employee_id', $employee->id)
                ->whereBetween('date', [$startDate, $endDate])
                ->get();

            $jobOutputs = JobOutput::where('employee_id', $employee->id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();

            $totalWorkHours = 0;
            foreach ($attendances as $attendance) {
                if ($attendance->check_in_time && $attendance->check_out_time) {
                    $checkIn = Carbon::parse($attendance->check_in_time);
                    $checkOut = Carbon::parse($attendance->check_out_time);
                    $totalWorkHours += $checkOut->diffInMinutes($checkIn) / 60;
                }
            }

            $employeeData[] = [
                'employee' => $employee,
                'attendance_count' => $attendances->count(),
                'present_days' => $attendances->where('status', 'present')->count(),
                'late_days' => $attendances->where('status', 'late')->count(),
                'total_work_hours' => round($totalWorkHours, 2),
                'job_output_count' => $jobOutputs->count(),
                'completed_tasks' => $jobOutputs->where('status', 'completed')->count(),
                'total_quantity' => $jobOutputs->sum('quantity'),
                'avg_quality_score' => $jobOutputs->whereNotNull('quality_score')->avg('quality_score'),
            ];
        }

        // Sort by total work hours descending
        usort($employeeData, function ($a, $b) {
            return $b['total_work_hours'] <=> $a['total_work_hours'];
        });

        return view('reports.employee-performance', compact(
            'employeeData',
            'startDate',
            'endDate'
        ));
    }
}
