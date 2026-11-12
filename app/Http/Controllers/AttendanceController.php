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
        $user = Auth::user();

        // If admin and no specific employee selected, show all employees' attendance
        if ($user->isAdmin() && !$employeeId) {
            $employees = Employee::with(['attendances' => function($query) use ($today) {
                $query->where('date', $today);
            }])->get();
            return view('attendance.admin-index', compact('employees', 'today'));
        }

        // Regular employees or admin with specific employee selection
        if ($user->isAdmin() && $employeeId) {
            // Admin viewing specific employee
            $employee = Employee::find($employeeId);
        } else {
            // Regular employee - automatically find their employee record
            $employee = Employee::where('email', $user->email)->first();
        }

        if ($employee) {
            $attendance = Attendance::where('employee_id', $employee->id)
                ->where('date', $today)
                ->first();
        } else {
            $attendance = null;
        }

        return view('attendance.index', compact('employee', 'attendance'));
    }

    public function checkIn(Request $request)
    {
        $user = Auth::user();

        // Regular employees must check in for themselves
        if (!$user->isAdmin()) {
            $employee = Employee::where('email', $user->email)->first();
            if (!$employee) {
                return back()->with('error', 'No employee record found for your account.');
            }
        } else {
            // Admin can check in for any employee
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
            ]);
            $employee = Employee::find($request->employee_id);
        }

        $today = Carbon::today();

        // Check if already checked in today
        $existingAttendance = Attendance::where('employee_id', $employee->id)
            ->where('date', $today)
            ->first();

        if ($existingAttendance) {
            return back()->with('error', 'You have already checked in today.');
        }

        // Get factory location from config (default: Kenya coordinates)
        $factoryLat = env('FACTORY_LATITUDE', -1.286389);
        $factoryLng = env('FACTORY_LONGITUDE', 36.817223);
        $maxDistance = env('MAX_CHECKIN_DISTANCE', 10); // 10 meters

        // Capture GPS coordinates if provided
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $distance = null;

        // Validate location if GPS is provided
        if ($latitude && $longitude) {
            $distance = $this->calculateDistance($latitude, $longitude, $factoryLat, $factoryLng);

            if ($distance > $maxDistance) {
                return back()->with('error', "You are {$distance} meters away from the factory. Check-in is only allowed within {$maxDistance} meters.");
            }
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
            'check_in_qr_code' => $employee->qr_code ?? 'self',
            'status' => $status,
            'check_in_latitude' => $latitude,
            'check_in_longitude' => $longitude,
            'check_in_distance' => $distance,
        ]);

        return redirect()->route('attendance.index')
            ->with('success', "Checked in successfully at {$checkInTime->format('H:i')}" . ($distance ? " ({$distance}m from factory)" : ""));
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();

        // Regular employees check out for themselves
        if (!$user->isAdmin()) {
            $employee = Employee::where('email', $user->email)->first();
            if (!$employee) {
                return back()->with('error', 'No employee record found for your account.');
            }
            $attendance = Attendance::where('employee_id', $employee->id)
                ->where('date', Carbon::today())
                ->first();
        } else {
            // Admin can check out for any attendance
            $request->validate([
                'attendance_id' => 'required|exists:attendances,id',
            ]);
            $attendance = Attendance::find($request->attendance_id);
        }

        if (!$attendance) {
            return back()->with('error', 'No active attendance record found.');
        }

        if ($attendance->check_out_time) {
            return back()->with('error', 'You have already checked out today.');
        }

        // Get factory location from config
        $factoryLat = env('FACTORY_LATITUDE', -1.286389);
        $factoryLng = env('FACTORY_LONGITUDE', 36.817223);
        $maxDistance = env('MAX_CHECKIN_DISTANCE', 10); // 10 meters

        // Capture GPS coordinates if provided
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $distance = null;

        // Validate location if GPS is provided
        if ($latitude && $longitude) {
            $distance = $this->calculateDistance($latitude, $longitude, $factoryLat, $factoryLng);

            if ($distance > $maxDistance) {
                return back()->with('error', "You are {$distance} meters away from the factory. Check-out is only allowed within {$maxDistance} meters.");
            }
        }

        $checkOutTime = Carbon::now();

        $attendance->update([
            'check_out_time' => $checkOutTime->format('H:i:s'),
            'check_out_qr_code' => $attendance->employee->qr_code ?? 'self',
            'check_out_latitude' => $latitude,
            'check_out_longitude' => $longitude,
            'check_out_distance' => $distance,
        ]);

        return redirect()->route('attendance.index')
            ->with('success', "Checked out successfully at {$checkOutTime->format('H:i')}" . ($distance ? " ({$distance}m from factory)" : ""));
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

    /**
     * Calculate distance between two coordinates using Haversine formula
     * Returns distance in meters
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // Earth's radius in meters

        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
