<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // ← Add this line

class ApplicationController extends Controller
{
    public function getApplications()
    {
        $applications = Application::with('partylist', 'user', 'candidate', 'position')->get();
        return response()->json(['applications' => $applications]);
    }

    public function addApplication(Request $request)
    {
        $request->validate([
            'partylist_id' => ['required', 'exists:partylists,id'],
            'user_id' => ['required', 'exists:users,id'],
            'candidate_id' => ['required', 'exists:candidates,id'],
            'position_id' => ['required', 'exists:positions,id'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $application = Application::create([
            'partylist_id' => $request->partylist_id,
            'user_id' => $request->user_id,
            'candidate_id' => $request->candidate_id,
            'position_id' => $request->position_id,
            'status' => $request->status,
        ]);

        // Log the creation
        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Created application (ID: ' . $application->id . ')',
        ]);

        return response()->json([
            'message' => 'Application added successfully',
            'application' => $application
        ]);
    }

    public function editApplication(Request $request, $id)
    {
        $request->validate([
            'partylist_id' => ['required', 'exists:partylists,id'],
            'user_id' => ['required', 'exists:users,id'],
            'candidate_id' => ['required', 'exists:candidates,id'],
            'position_id' => ['required', 'exists:positions,id'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        $application = Application::find($id);

        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }

        $application->update([
            'partylist_id' => $request->partylist_id,
            'user_id' => $request->user_id,
            'candidate_id' => $request->candidate_id,
            'position_id' => $request->position_id,
            'status' => $request->status,
        ]);

        // Log the update
        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Updated application (ID: ' . $application->id . ')',
        ]);

        return response()->json([
            'message' => 'Application updated successfully',
            'application' => $application
        ]);
    }

    public function deleteApplication($id)
    {
        $application = Application::find($id);

        if (!$application) {
            return response()->json(['message' => 'Application not found'], 404);
        }

        $applicationId = $application->id;
        $application->delete();

        // Log the deletion
        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Deleted application (ID: ' . $applicationId . ')',
        ]);

        return response()->json(['message' => 'Application deleted successfully']);
    }
}