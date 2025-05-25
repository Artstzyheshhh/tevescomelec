<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 
use App\Models\Logs;
class PositionController extends Controller
{
    //
    public function getPositions(){
        $positions = Position::all();
        return response()->json(['positions' => $positions]);
    } 

    public function addPosition(Request $request){
        $request->validate([
            'positionname' => ['required', 'string', 'max:255'],
            'term' => ['required', 'string', 'max:255'],
            
           
        ]);

        $position = Position::create([
            'positionname' => $request->positionname,
            'term' => $request->term,
            
        ]);

        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Created position (ID: ' . $position->id . ')',
        ]);
        return response()->json(['message' => 'User added successfully', 'position' => $position]);
    }

    public function editPosition(Request $request, $id){
        $request->validate([
            'positionname' => ['required', 'string', 'max:255'],
            'term' => ['nullable', 'string', 'max:255'],
            
        ]);

        $position = Position::find($id);

        if(!$position){
            return response()->json(['message' => 'Position not found'], 404);
        }

        $position->update([
            'positionname' => $request->positionname,
            'term' => $request->term,
            
        ]);

        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Updated position (ID: ' . $position->id . ')',
        ]);

        return response()->json(['message' => 'Position updated successfully', 'position' => $position ]);
    } 

    public function deletePosition($id){
        $position = Position::find($id);

        if(!$position){
            return response()->json(['message' => 'Position not found'], 404);
        }
        $positionId = $position->id;
        $position->delete();
        $logs = Logs::create([
            'user_id' => Auth::id(),
            'action' => 'Deleted position (ID: ' . $positionId . ')',
        ]);
        return response()->json(['message' => 'Position deleted successfully']);
    }
}
