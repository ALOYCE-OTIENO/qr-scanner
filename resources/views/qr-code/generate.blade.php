@extends('layouts.app')

@section('title', 'Generate QR Code')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>QR Code Generated</h1>
    <a href="{{ route('qr.scan') }}" class="btn btn-outline-primary">Back to Scanner</a>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body text-center">
                <h4 class="mb-4">{{ $employee->full_name }}</h4>
                <p class="text-muted">Employee ID: {{ $employee->employee_id }}</p>
                
                <div class="my-4">
                    <img src="{{ $qrCodeUrl }}" alt="QR Code" class="img-fluid" style="max-width: 300px;">
                </div>
                
                <p class="text-muted small">QR Code: {{ $employee->qr_code }}</p>
                
                <div class="mt-4">
                    <a href="{{ $qrCodeUrl }}" download="qr_{{ $employee->employee_id }}.png" class="btn btn-primary">
                        <i class="bi bi-download"></i> Download QR Code
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
