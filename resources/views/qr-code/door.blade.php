@extends('layouts.app')

@section('title', 'Door QR Code')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Company Door QR Code</h1>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Back to Dashboard</a>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="bi bi-qr-code" style="font-size: 4rem; background: linear-gradient(135deg, #00ff88 0%, #00c8ff 50%, #ff0080 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"></i>
                </div>
                <h4 class="mb-4" style="color: white; font-weight: 700;">Print this QR code and post it at the company entrance</h4>
                <p class="mb-4" style="color: #94a3b8;">Employees will scan this code to check in/out</p>
                
                <div class="my-5 p-4" style="background: rgba(0, 255, 136, 0.1); border: 2px solid rgba(0, 255, 136, 0.3); border-radius: 20px; display: inline-block;">
                    <img src="{{ $qrCodeUrl }}" alt="Door QR Code" class="img-fluid" style="max-width: 400px; border: 3px solid rgba(0, 255, 136, 0.5); border-radius: 16px;">
                </div>
                
                <div class="alert alert-info">
                    <strong style="color: #00c8ff;"><i class="bi bi-info-circle me-2"></i>Instructions:</strong>
                    <ul class="mb-0 mt-2 text-start" style="color: #cbd5e1;">
                        <li>Print this QR code in large size (recommended: A4 or larger)</li>
                        <li>Post it at the main company entrance/door</li>
                        <li>Ensure it's easily scannable by mobile devices</li>
                        <li>Employees will scan this and enter their employee ID to check in/out</li>
                    </ul>
                </div>
                
                <div class="mt-4">
                    <a href="{{ $qrCodeUrl }}" download="company_door_qr.svg" class="btn btn-primary btn-lg">
                        <i class="bi bi-download me-2"></i> Download Door QR Code
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
