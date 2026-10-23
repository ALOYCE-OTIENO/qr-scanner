<?php

namespace App\Http\Controllers;

use App\Models\JobOutput;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JobOutputController extends Controller
{
    public function index(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $jobOutputs = JobOutput::with(['employee', 'attendance'])
            ->when($employeeId, function ($query) use ($employeeId) {
                return $query->where('employee_id', $employeeId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('job-output.index', compact('jobOutputs'));
    }

    public function create(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $attendanceId = $request->input('attendance_id');
        
        return view('job-output.create', compact('employeeId', 'attendanceId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'attendance_id' => 'nullable|exists:attendances,id',
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'quality_score' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:pending,completed,rejected',
            'remarks' => 'nullable|string',
        ]);

        $data = $request->all();
        
        if ($request->status === 'completed') {
            $data['completed_at'] = Carbon::now();
        }

        JobOutput::create($data);

        return redirect()->route('job-output.index', ['employee_id' => $request->employee_id])
            ->with('success', 'Job output recorded successfully.');
    }

    public function edit($id)
    {
        $jobOutput = JobOutput::with(['employee', 'attendance'])->findOrFail($id);
        
        return view('job-output.edit', compact('jobOutput'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'unit' => 'required|string|max:50',
            'quality_score' => 'nullable|numeric|min:0|max:100',
            'status' => 'required|in:pending,completed,rejected',
            'remarks' => 'nullable|string',
        ]);

        $jobOutput = JobOutput::findOrFail($id);
        $data = $request->all();
        
        if ($request->status === 'completed' && !$jobOutput->completed_at) {
            $data['completed_at'] = Carbon::now();
        }

        $jobOutput->update($data);

        return redirect()->route('job-output.index', ['employee_id' => $jobOutput->employee_id])
            ->with('success', 'Job output updated successfully.');
    }

    public function destroy($id)
    {
        $jobOutput = JobOutput::findOrFail($id);
        $employeeId = $jobOutput->employee_id;
        $jobOutput->delete();

        return redirect()->route('job-output.index', ['employee_id' => $employeeId])
            ->with('success', 'Job output deleted successfully.');
    }
}
