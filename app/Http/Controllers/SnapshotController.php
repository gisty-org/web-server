<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Snapshot;

class SnapshotController extends Controller
{
    public function destroy($summaryId,$snapshotId){
        $snapshot = Snapshot::find($snapshotId);
        if(!$snapshot){
            return response()->json([
                "error" => "Snapshot not found"
            ],404);
        }
        $res = Snapshot::destroy($snapshotId);
        if($res){
            return response()->json([
                "msg" => "Successfully deleted snapshot"
            ],200);
        }else{
            return response()->json([
                "error" => "An error occurred while deleting snapshot"
            ],500);
        }
    }
}
