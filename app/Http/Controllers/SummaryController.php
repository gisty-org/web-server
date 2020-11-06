<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Database\ModalNotFoundException;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Summary;
use App\Mail\NewSummary;
use App\Mail\SummaryShared;

class SummaryController extends Controller
{
    public function index($userId){
        $user = User::find($userId);
        if(!$user){
            return response()->json([
                "error" => "User not found"
            ],404);
        }
        $summaries = User::find($userId)->summaries;
        $folders = [];
        foreach($summaries as $s){
            if(!isset($folders[$s->folder])){
                $folders[$s->folder] = [];   
                
            }
        }
        foreach($summaries as $s){
            $summary = [
                "id" => $s->id,
                "title" => $s->title,
                "content" => $s->content,
                "created_at" => $s->created_at,
                "snapshots" => $s->snapshots
            ];
            array_push($folders[$s->folder],$summary);
        }
        return response()->json(["summaries" => $folders],200);
    }

    public function create(Request $request){
        $user = User::where('email',$request->input('email'))->first();
        if(!$user){
            return response()->json([
                "error" => "User not found"
            ],404);
        }
        $summary = $user->summaries()->create([
            'title' => $request->input('title'),
            'folder' => $request->input('folder') ? $request->input('folder') : 'root',
            'content' => $request->input('content')
        ]);

        if($request->input('snapshots')){
            foreach($request->input('snapshots') as $snapshot){
                $summary->snapshots()->create([
                    "url" => $snapshot
                ]);
            }
        }   

        Mail::to($user->email)->send(new NewSummary($user,$summary));
        
        return response()->json([
            "msg" => "Successfully added summary",
        ],200);
    }

    public function share(Request $request){

        $sender = User::where('email',$request->input('from'))->first();
        $receiver = User::where('email',$request->input('to'))->first();

        if(!$receiver){
            return response()->json([
                "error" => "User not found"
            ],404);
        }

        $summary = $receiver->summaries()->create([
            'title' => $request->input('title'),
            'folder' => $request->input('folder') ? $request->input('folder') : 'root',
            'content' => $request->input('content')
        ]);

        if($request->input('snapshots')){
            foreach($request->input('snapshots') as $snapshot){
                $summary->snapshots()->create([
                    "url" => $snapshot
                ]);
            }
        }   

        Mail::to($receiver->email)->send(new SummaryShared($sender, $receiver, $summary));
        
        return response()->json([
            "msg" => "Successfully shared summary",
        ],200);
    }

    public function destroy($summaryId){
        $summary = Summary::find($summaryId);
        if(!$summary){
            return response()->json([
                "error" => "Summary not found"
            ],404);
        }
        $summary->snapshots()->delete();
        $res = Summary::destroy($summaryId);
        if($res){
            return response()->json([
                "msg" => "Successfully Deleted Summary"
            ],200);
        }else{
            return response()->json([
                "error" => "An error occurred while deleting the summary"
            ],500);
        }
    }
}
