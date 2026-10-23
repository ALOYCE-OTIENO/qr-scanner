<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class QrCodeController extends Controller
{
    public function generate(Request $request)
    {
        $employeeId = $request->input('employee_id');
        
        if (!$employeeId) {
            return back()->with('error', 'Employee ID is required');
        }

        $employee = Employee::where('employee_id', $employeeId)->first();
        
        if (!$employee) {
            return back()->with('error', 'Employee not found');
        }

        // Generate unique QR code if not exists
        if (!$employee->qr_code) {
            $employee->qr_code = Str::uuid()->toString();
            $employee->save();
        }

        // Generate QR code image
        $qrCode = QrCode::format('svg')
            ->size(300)
            ->margin(10)
            ->errorCorrection('H')
            ->encoding('UTF-8')
            ->generate($employee->qr_code);

        $fileName = 'qr_codes/' . $employee->employee_id . '.svg';
        \Storage::disk('public')->put($fileName, $qrCode);

        return view('qr-code.generate', [
            'employee' => $employee,
            'qrCodeUrl' => \Storage::url($fileName)
        ]);
    }

    public function showScanForm()
    {
        return view('qr-code.scan');
    }

    public function scan(Request $request)
    {
        $qrData = $request->input('qr_data');
        
        if (!$qrData) {
            return back()->with('error', 'QR code data is required');
        }

        $employee = Employee::where('qr_code', $qrData)->first();
        
        if (!$employee) {
            return back()->with('error', 'Invalid QR code or employee not found');
        }

        if (!$employee->is_active) {
            return back()->with('error', 'Employee account is inactive');
        }

        return redirect()->route('attendance.index', ['employee_id' => $employee->id])
            ->with('success', "Welcome, {$employee->full_name}!");
    }

    public function generateDoorQr(QrCodeService $qrCodeService)
    {
        $qrCodeUrl = $qrCodeService->generateDoorQrCode();
        
        return view('qr-code.door', compact('qrCodeUrl'));
    }

    public function showDoorCheckIn()
    {
        return view('qr-code.door-checkin');
    }

    public function processDoorCheckIn(Request $request, QrCodeService $qrCodeService)
    {
        $request->validate([
            'qr_data' => 'required|string',
            'employee_id' => 'required|string',
        ]);

        // Validate that it's the correct door QR code
        if (!$qrCodeService->validateDoorQrCode($request->qr_data)) {
            return back()->with('error', 'Invalid door QR code');
        }

        // Find employee by employee_id
        $employee = Employee::where('employee_id', $request->employee_id)->first();
        
        if (!$employee) {
            return back()->with('error', 'Employee not found');
        }

        if (!$employee->is_active) {
            return back()->with('error', 'Employee account is inactive');
        }

        return redirect()->route('attendance.index', ['employee_id' => $employee->id])
            ->with('success', "Door QR validated. Welcome, {$employee->full_name}!");
    }
}
