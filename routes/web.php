<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\JobOutputController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// QR Code Routes
Route::get('/qr-code/generate', [QrCodeController::class, 'generate'])->name('qr.generate');
Route::get('/qr-code/scan', [QrCodeController::class, 'showScanForm'])->name('qr.scan');
Route::post('/qr-code/scan', [QrCodeController::class, 'scan'])->name('qr.scan.post');
Route::get('/qr-code/door', [QrCodeController::class, 'generateDoorQr'])->name('qr.door');
Route::get('/door-checkin', [QrCodeController::class, 'showDoorCheckIn'])->name('door.checkin');
Route::post('/door-checkin', [QrCodeController::class, 'processDoorCheckIn'])->name('door.checkin.post');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Attendance Routes
    Route::prefix('attendance')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::post('/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.check-in');
        Route::post('/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.check-out');
        Route::get('/history', [AttendanceController::class, 'history'])->name('attendance.history');
    });
    
    // Job Output Routes
    Route::prefix('job-output')->group(function () {
        Route::get('/', [JobOutputController::class, 'index'])->name('job-output.index');
        Route::get('/create', [JobOutputController::class, 'create'])->name('job-output.create');
        Route::post('/store', [JobOutputController::class, 'store'])->name('job-output.store');
        Route::get('/{id}/edit', [JobOutputController::class, 'edit'])->name('job-output.edit');
        Route::put('/{id}', [JobOutputController::class, 'update'])->name('job-output.update');
        Route::delete('/{id}', [JobOutputController::class, 'destroy'])->name('job-output.destroy');
    });
    
    // Employee Management (Admin only)
    Route::prefix('employees')->middleware(['admin'])->group(function () {
        Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/store', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/{id}', [EmployeeController::class, 'show'])->name('employees.show');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    });

    // Reports (Admin only)
    Route::prefix('reports')->middleware(['admin'])->group(function () {
        // Attendance Reports
        Route::get('/attendance', [ReportController::class, 'attendanceIndex'])->name('reports.attendance.index');
        Route::post('/attendance', [ReportController::class, 'attendanceReport'])->name('reports.attendance');
        Route::get('/attendance/export', [ReportController::class, 'exportAttendanceCsv'])->name('reports.attendance.export');

        // Job Output Reports
        Route::get('/job-output', [ReportController::class, 'jobOutputIndex'])->name('reports.job-output.index');
        Route::post('/job-output', [ReportController::class, 'jobOutputReport'])->name('reports.job-output');
        Route::get('/job-output/export', [ReportController::class, 'exportJobOutputCsv'])->name('reports.job-output.export');

        // Employee Performance Report
        Route::get('/employee-performance', [ReportController::class, 'employeePerformance'])->name('reports.employee-performance');
    });
});
