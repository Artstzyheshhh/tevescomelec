<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
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

        return response()->json(['message' => 'Position updated successfully', 'position' => $position ]);
    } 

    public function deletePosition($id){
        $position = Position::find($id);

        if(!$position){
            return response()->json(['message' => 'Position not found'], 404);
        }

        $position->delete();

        return response()->json(['message' => 'Position deleted successfully']);
    }
}
