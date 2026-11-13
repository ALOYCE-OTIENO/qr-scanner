@extends('layouts.app')

@section('title', 'Attendance')

@push('styles')
<style>
    #map {
        height: 300px;
        width: 100%;
        border-radius: 8px;
        margin-bottom: 1rem;
    }
    .location-info {
        background: var(--wecom-gray-light);
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
    }
    .location-info p {
        margin: 0.5rem 0;
    }
    .distance-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
    }
    .distance-valid {
        background: #d4edda;
        color: #155724;
    }
    .distance-invalid {
        background: #f8d7da;
        color: #721c24;
    }
</style>
@endpush

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY', '') }}&callback=initMap" async defer></script>
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Attendance</h1>
    <a href="{{ route('attendance.history') }}" class="btn btn-wecom-outline">View History</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- Check-in Confirmation Modal -->
@if(isset($employee) && isset($attendance))
<div class="modal fade" id="checkInConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid var(--wecom-border);">
                <h5 class="modal-title" style="font-weight: 600;">Check-In Successful! ✓</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div style="width: 80px; height: 80px; background: var(--wecom-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem; margin: 0 auto 1.5rem;">
                    <i class="bi bi-check-lg"></i>
                </div>
                <h4 style="font-weight: 600; color: #333; margin-bottom: 0.5rem;">{{ $employee->full_name }}</h4>
                <p class="text-muted mb-3">Employee ID: {{ $employee->employee_id }}</p>
                <div class="card bg-light border-0" style="background: var(--wecom-gray-light);">
                    <div class="card-body py-3">
                        <p class="mb-1" style="color: var(--wecom-gray);">Check-in Time</p>
                        <h3 style="font-weight: 600; color: var(--wecom-green); font-size: 2rem;">{{ $attendance->check_in_time }}</h3>
                        <p class="mb-0 small text-muted">{{ $attendance->date->format('l, F j, Y') }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge {{ $attendance->status === 'present' ? 'badge-success' : 'badge-warning' }} fs-6">
                        {{ ucfirst($attendance->status) }}
                    </span>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--wecom-border);">
                <button type="button" class="btn btn-wecom-primary" data-bs-dismiss="modal">
                    <i class="bi bi-check-circle me-2"></i>Got it
                </button>
            </div>
        </div>
    </div>
</div>
@endif

@if($employee)
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                @if(auth()->user()->isAdmin())
                    Employee: {{ $employee->full_name }}
                @else
                    My Attendance
                @endif
            </h5>
        </div>
        <div class="card-body">
            <!-- Location Information -->
            <div id="locationInfo">
                <div class="alert alert-info">
                    <i class="bi bi-geo-alt"></i> Getting your location...
                </div>
            </div>

            @if($attendance)
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Date:</strong> {{ $attendance->date->format('l, F j, Y') }}</p>
                        <p><strong>Check In:</strong> {{ $attendance->check_in_time }}</p>
                        @if($attendance->check_in_distance)
                            <p><strong>Check-in Distance:</strong> {{ $attendance->check_in_distance }}m from factory</p>
                        @endif
                        @if($attendance->check_out_time)
                            <p><strong>Check Out:</strong> {{ $attendance->check_out_time }}</p>
                            <p><strong>Work Hours:</strong> {{ $attendance->work_hours }}</p>
                            @if($attendance->check_out_distance)
                                <p><strong>Check-out Distance:</strong> {{ $attendance->check_out_distance }}m from factory</p>
                            @endif
                        @endif
                        <p><strong>Status:</strong>
                            <span class="badge bg-{{ $attendance->status === 'present' ? 'success' : 'warning' }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        @if(!$attendance->check_out_time)
                            @if(auth()->user()->isAdmin())
                            <form method="POST" action="{{ route('attendance.check-out') }}">
                                @csrf
                                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                                <button type="submit" class="btn btn-warning btn-lg w-100">
                                    <i class="bi bi-box-arrow-right"></i> Check Out
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('attendance.check-out') }}">
                                @csrf
                                <button type="submit" class="btn btn-wecom-primary w-100">
                                    <i class="bi bi-box-arrow-right"></i> Check Out
                                </button>
                            </form>
                            @endif
                        @else
                            <div class="alert alert-info">
                                <i class="bi bi-check-circle"></i> You have already checked out today.
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x" style="font-size: 4rem; color: #667eea;"></i>
                    <h4 class="mt-3">Not Checked In Today</h4>
                    <p class="text-muted">
                        @if(auth()->user()->isAdmin())
                            Scan employee's QR code to check in
                        @else
                        Click below to check in for your shift
                        @endif
                    </p>
                    <div id="distanceDisplay"></div>
                    <form method="POST" action="{{ route('attendance.check-in') }}">
                        @csrf
                        @if(auth()->user()->isAdmin())
                        <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                        @endif
                        <button type="submit" class="btn btn-wecom-primary btn-lg px-5">
                            <i class="bi bi-box-arrow-in-right"></i> Check In
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@else
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-qr-code-scan" style="font-size: 4rem; color: #667eea;"></i>
            <h4 class="mt-3">Scan QR Code</h4>
            <p class="text-muted">Scan an employee's QR code to manage attendance</p>
            <a href="{{ route('qr.scan') }}" class="btn btn-primary btn-lg">
                <i class="bi bi-qr-code-scan"></i> Go to QR Scanner
            </a>
        </div>
    </div>
@endif

<!-- Location Capture Form (Hidden) -->
<form id="locationForm" method="POST" style="display: none;">
    @csrf
    <input type="hidden" id="latitude" name="latitude">
    <input type="hidden" id="longitude" name="longitude">
</form>

<script>
let userLocation = null;
const factoryLat = {{ env('FACTORY_LATITUDE', -1.286389) }};
const factoryLng = {{ env('FACTORY_LONGITUDE', 36.817223) }};
const maxDistance = {{ env('MAX_CHECKIN_DISTANCE', 10) }};

// Get user's current location
function getUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                document.getElementById('latitude').value = userLocation.lat;
                document.getElementById('longitude').value = userLocation.lng;

                const distance = calculateDistance(userLocation.lat, userLocation.lng, factoryLat, factoryLng);
                updateLocationDisplay(distance, userLocation.lat, userLocation.lng);
            },
            function(error) {
                console.error('Error getting location:', error);
                showLocationError(error.message);
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    } else {
        showLocationError('Geolocation is not supported by this browser.');
    }
}

// Calculate distance between two points (Haversine formula)
function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371000; // Earth's radius in meters
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
              Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
              Math.sin(dLon/2) * Math.sin(dLon/2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    return R * c;
}

// Update location display
function updateLocationDisplay(distance, lat, lng) {
    const distanceDisplay = document.getElementById('distanceDisplay');
    const locationInfo = document.getElementById('locationInfo');

    if (distanceDisplay) {
        const isValid = distance <= maxDistance;
        distanceDisplay.innerHTML = `
            <span class="distance-badge ${isValid ? 'distance-valid' : 'distance-invalid'}">
                ${distance.toFixed(2)}m from factory
            </span>
        `;
    }

    if (locationInfo) {
        locationInfo.innerHTML = `
            <div class="location-info">
                <p><strong>Your Location:</strong> ${lat.toFixed(6)}, ${lng.toFixed(6)}</p>
                <p><strong>Factory Location:</strong> ${factoryLat.toFixed(6)}, ${factoryLng.toFixed(6)}</p>
                <p><strong>Distance:</strong> ${distance.toFixed(2)} meters</p>
                <p><strong>Status:</strong> ${distance <= maxDistance ? '✓ Within range' : '✗ Out of range'}</p>
            </div>
        `;
    }
}

// Show location error
function showLocationError(message) {
    const locationInfo = document.getElementById('locationInfo');
    if (locationInfo) {
        locationInfo.innerHTML = `
            <div class="alert alert-warning">
                <i class="bi bi-exclamation-triangle"></i> Location error: ${message}
            </div>
        `;
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Get location when page loads
    getUserLocation();

    // Update location periodically
    setInterval(getUserLocation, 30000); // Every 30 seconds

    // Add location data to check-in/check-out forms
    const checkInForm = document.querySelector('form[action*="check-in"]');
    const checkOutForm = document.querySelector('form[action*="check-out"]');

    if (checkInForm) {
        checkInForm.addEventListener('submit', function(e) {
            if (userLocation) {
                const distance = calculateDistance(userLocation.lat, userLocation.lng, factoryLat, factoryLng);
                if (distance > maxDistance) {
                    e.preventDefault();
                    alert(`You are ${distance.toFixed(2)} meters away from the factory. Check-in is only allowed within ${maxDistance} meters.`);
                    return false;
                }
                // Add location fields to form
                const latInput = document.createElement('input');
                latInput.type = 'hidden';
                latInput.name = 'latitude';
                latInput.value = userLocation.lat;
                checkInForm.appendChild(latInput);

                const lngInput = document.createElement('input');
                lngInput.type = 'hidden';
                lngInput.name = 'longitude';
                lngInput.value = userLocation.lng;
                checkInForm.appendChild(lngInput);
            }
        });
    }

    if (checkOutForm) {
        checkOutForm.addEventListener('submit', function(e) {
            if (userLocation) {
                const distance = calculateDistance(userLocation.lat, userLocation.lng, factoryLat, factoryLng);
                if (distance > maxDistance) {
                    e.preventDefault();
                    alert(`You are ${distance.toFixed(2)} meters away from the factory. Check-out is only allowed within ${maxDistance} meters.`);
                    return false;
                }
                // Add location fields to form
                const latInput = document.createElement('input');
                latInput.type = 'hidden';
                latInput.name = 'latitude';
                latInput.value = userLocation.lat;
                checkOutForm.appendChild(latInput);

                const lngInput = document.createElement('input');
                lngInput.type = 'hidden';
                lngInput.name = 'longitude';
                lngInput.value = userLocation.lng;
                checkOutForm.appendChild(lngInput);
            }
        });
    }
});
</script>
@endsection

@if($employee && $attendance && session('success'))
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = new bootstrap.Modal(document.getElementById('checkInConfirmModal'));
    modal.show();
});
</script>
@endif
