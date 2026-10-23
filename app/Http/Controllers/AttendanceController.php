<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $today = Carbon::today();
        
        if ($employeeId) {
            $employee = Employee::find($employeeId);
            $attendance = Attendance::where('employee_id', $employeeId)
                ->where('date', $today)
                ->first();
        } else {
            $employee = null;
            $attendance = null;
        }

        return view('attendance.index', compact('employee', 'attendance'));
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'qr_code' => 'required|string',
        ]);

        $employee = Employee::find($request->employee_id);
        $today = Carbon::today();

        // Check if already checked in today
        $existingAttendance = Attendance::where('employee_id', $employee->id)
            ->where('date', $today)
            ->first();

        if ($existingAttendance) {
            return back()->with('error', 'You have already checked in today.');
        }

        // Determine status based on check-in time
        $checkInTime = Carbon::now();
        $status = 'present';
        
        // Consider late if after 9:00 AM (configurable)
        if ($checkInTime->hour >= 9 && $checkInTime->minute > 0) {
            $status = 'late';
        }

        $attendance = Attendance::create([
            'employee_id' => $employee->id,
            'date' => $today,
            'check_in_time' => $checkInTime->format('H:i:s'),
            'check_in_qr_code' => $request->qr_code,
            'status' => $status,
        ]);

        return redirect()->route('attendance.index', ['employee_id' => $employee->id])
            ->with('success', "Checked in successfully at {$checkInTime->format('H:i')}");
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'attendance_id' => 'required|exists:attendances,id',
            'qr_code' => 'required|string',
        ]);

        $attendance = Attendance::find($request->attendance_id);

        if ($attendance->check_out_time) {
            return back()->with('error', 'You have already checked out today.');
        }

        $checkOutTime = Carbon::now();

        $attendance->update([
            'check_out_time' => $checkOutTime->format('H:i:s'),
            'check_out_qr_code' => $request->qr_code,
        ]);

        return redirect()->route('attendance.index', ['employee_id' => $attendance->employee_id])
            ->with('success', "Checked out successfully at {$checkOutTime->format('H:i')}");
    }

    public function history(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $attendances = Attendance::with('employee')
            ->when($employeeId, function ($query) use ($employeeId) {
                return $query->where('employee_id', $employeeId);
            })
            ->orderBy('date', 'desc')
            ->paginate(30);

        return view('attendance.history', compact('attendances'));
    }
}
