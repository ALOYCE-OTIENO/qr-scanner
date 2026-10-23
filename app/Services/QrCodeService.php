<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    public function generateForEmployee(Employee $employee): string
    {
        if (!$employee->qr_code) {
            $employee->qr_code = Str::uuid()->toString();
            $employee->save();
        }

        $qrCode = QrCode::format('svg')
            ->size(300)
            ->margin(10)
            ->errorCorrection('H')
            ->encoding('UTF-8')
            ->generate($employee->qr_code);

        $fileName = 'qr_codes/' . $employee->employee_id . '.svg';
        \Storage::disk('public')->put($fileName, $qrCode);

        return \Storage::url($fileName);
    }

    public function validateQrCode(string $qrData): ?Employee
    {
        return Employee::where('qr_code', $qrData)
            ->where('is_active', true)
            ->first();
    }

    public function generateDailyCheckInQr(): string
    {
        $today = now()->format('Y-m-d');
        $secret = config('app.key');
        $qrData = hash('sha256', $today . $secret);
        
        $qrCode = QrCode::format('svg')
            ->size(300)
            ->margin(10)
            ->errorCorrection('H')
            ->encoding('UTF-8')
            ->generate($qrData);

        $fileName = 'daily_qr/' . $today . '.svg';
        \Storage::disk('public')->put($fileName, $qrCode);

        return \Storage::url($fileName);
    }

    public function generateDoorQrCode(): string
    {
        // Generate a permanent QR code for the company door
        $secret = config('app.key');
        $doorId = 'COMPANY_DOOR_' . env('APP_NAME', 'QR_SCANNER');
        $qrData = hash('sha256', $doorId . $secret);
        
        $qrCode = QrCode::format('svg')
            ->size(500)
            ->margin(10)
            ->errorCorrection('H')
            ->encoding('UTF-8')
            ->generate($qrData);

        $fileName = 'door_qr/door_code.svg';
        \Storage::disk('public')->put($fileName, $qrCode);

        return \Storage::url($fileName);
    }

    public function validateDoorQrCode(string $qrData): bool
    {
        $secret = config('app.key');
        $doorId = 'COMPANY_DOOR_' . env('APP_NAME', 'QR_SCANNER');
        $expectedQrData = hash('sha256', $doorId . $secret);
        
        return hash_equals($expectedQrData, $qrData);
    }
}
