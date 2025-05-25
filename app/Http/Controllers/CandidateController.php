<?php

namespace App\Http\Controllers;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\Logs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CandidateController extends Controller
{
    //
    public function getCandidates(){
        $candidates = Candidate::with('user')->get();
        return response()->json(['candidates' => $candidates]);
    } 

    public function addCandidate(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:candidates'],
            'user_id' => ['required', 'exists:users,id']
           
        ]);

        $candidate = Candidate::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'nationality' => $request->nationality,
            'occupation' => $request->occupation,
            'contact' => $request->contact,
            'email' => $request->email,
            'user_id' => $request->user_id
        ]);
        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Created Candidate (ID: ' . $candidate->id . ')',
        ]);

        return response()->json(['message' => 'Candidate added successfully', 'candidate' => $candidate]);
    }

    public function editCandidate(Request $request, $id){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:255'],
            'birthdate' => ['required', 'date', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'nationality' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:candidates'],
            'user_id' => ['required', 'exists:users,id']
        ]);

        $candidate = Candidate::find($id);

        if(!$candidate){
            return response()->json(['message' => 'Candidate not found'], 404);
        }

        $candidate->update([
           'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'age' => $request->age,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'nationality' => $request->nationality,
            'occupation' => $request->occupation,
            'contact' => $request->contact,
            'email' => $request->email,
            'user_id' => $request->user_id
        ]);

        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Updated candidate (ID: ' . $candidate->id . ')',
        ]);

        return response()->json(['message' => 'Candidate updated successfully', 'candidate' => $candidate ]);
    }   

    public function deleteCandidate($id){
        $candidate = Candidate::find($id);

        if(!$candidate){
            return response()->json(['message' => 'Candidate not found'], 404);
        }
        $candidateId = $candidate->id;
        $candidate->delete();
        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Deleted candidate (ID: ' . $candidateId . ')',
        ]);

        return response()->json(['message' => 'Candidate deleted successfully']);
    }
}
