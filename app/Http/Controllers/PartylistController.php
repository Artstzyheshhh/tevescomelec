<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partylist;
class PartylistController extends Controller
{
    //
    public function getPartylists(){
        $partylists = Partylist::with('user')->get();
        return response()->json(['partylists' => $partylists]);
    } 

    public function addPartylist(Request $request){
        $request->validate([
            'partylistname' => ['required', 'string', 'max:255'],
            'shortname' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id']   
        ]);

        $partylist = Partylist::create([
            'partylistname' => $request->partylistname,
            'shortname' => $request->shortname,
            'contact' => $request->contact,
            'platform' => $request->platform,
            'status' => $request->status,
            'user_id' => $request->user_id,
            
        ]);
        return response()->json(['message' => 'Partylist added successfully', 'partylist' => $partylist]);
    }

    public function editPartylist(Request $request, $id){
        $request->validate([
            'partylistname' => ['required', 'string', 'max:255'],
            'shortname' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'platform' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'exists:users,id']   
        ]);

        $partylist = Partylist::find($id);

        if(!$partylist){
            return response()->json(['message' => 'Partylist not found'], 404);
        }

        $partylist->update([
           'partylistname' => $request->partylistname,
            'shortname' => $request->shortname,
            'contact' => $request->contact,
            'platform' => $request->platform,
            'status' => $request->status,
            'user_id' => $request->user_id
        ]);

        return response()->json(['message' => 'Partylist updated successfully', 'partylist' => $partylist ]);
    } 

    public function deletePartylist($id){
        $partylist = Partylist::find($id);

        if(!$partylist){
            return response()->json(['message' => 'Partylist not found'], 404);
        }
        $partylist->delete();

        return response()->json(['message' => 'Partylist deleted successfully']);
    }

}
