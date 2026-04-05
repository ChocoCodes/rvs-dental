<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $rawAppointments = Appointment::with('patient')
            ->orderBy('scheduled_at', 'asc')
            ->paginate(10); // Initial fetch 10

        $rawAppointments->getCollection()->transform(function ($appointment) {
            $color = match($appointment->status) {
                'Completed' => 'text-success',
                'Scheduled' => 'text-pending',
                'Cancelled' => 'text-danger',
                'No Show'   => 'text-muted',
                default     => 'text-blue-500',
            };

            return [
                'appointment_id' => $appointment->appointment_id,
                'date'        => Carbon::parse($appointment->scheduled_at)->format('F j, Y'),
                'name'        => $appointment->patient
                    ? "{$appointment->patient->first_name} {$appointment->patient->last_name}"
                    : 'Unknown Patient',
                'remarks' => $appointment->remarks ?? 'No remarks provided.',
                'status'      => $appointment->status,
                'color'       => $color,
            ];
        });

        if ($request->ajax()) {
            $grouped = $rawAppointments->getCollection()->groupBy('date');

            if ($grouped->isEmpty()) {
                return response('', 204);
            }

            return view('components.appointments.list', ['appointments' => $grouped])->render();
        }

        return view('pages.appointments', [
            'appointments' => $rawAppointments->groupBy('date'),
            'hasMore' => $rawAppointments->hasMorePages()
        ]);
    }

    public function show($id)
    {
        $appointment = Appointment::with('patient', 'dentist')->findOrFail($id);

        return response()->json([
            'id' => $appointment->appointment_id,
            'patient_name' => "{$appointment->patient->first_name} {$appointment->patient->last_name}",
            'dentist_name' => "{$appointment->dentist->first_name} {$appointment->dentist->last_name}"?? 'N/A',
            'remarks' => $appointment->remarks,
            'status' => $appointment->status,
            'scheduled_at' => Carbon::parse($appointment->scheduled_at)->format('F j, Y g:i A'),
        ]);
    }

}
