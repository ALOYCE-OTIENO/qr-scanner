@extends('layouts.app')

@section('title', 'QR Scanner')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>QR Scanner</h1>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Back to Dashboard</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center">
                <i class="bi bi-qr-code-scan" style="font-size: 4rem; color: #667eea;"></i>
                <h4 class="mt-3">Scan QR Code</h4>
                <p class="text-muted">Enter the QR code data or scan using a QR scanner</p>
                
                <form method="POST" action="{{ route('qr.scan.post') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" id="qr_data" name="qr_data" placeholder="Enter QR code data" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">
                        <i class="bi bi-check-circle"></i> Submit QR Code
                    </button>
                </form>
                
                <hr class="my-4">
                
                <p class="text-muted small">Or generate a QR code for an employee</p>
                <form method="GET" action="{{ route('qr.generate') }}" class="d-flex gap-2">
                    <input type="text" class="form-control" name="employee_id" placeholder="Enter Employee ID" required>
                    <button type="submit" class="btn btn-outline-primary">Generate</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
