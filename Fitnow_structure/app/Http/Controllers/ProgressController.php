<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $progress = Progress::all();
        $data = [
            'progress' => $progress,
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function showUserProgress()
    {
        $userID = Auth::id();
        $progress = Progress::where('userID', $userID)->get();

        $data = [
            'progress' => $progress,
        ];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'weight' => 'required',
            'height' => 'required',
            'waist_line' => 'required',
            'bicep_thickness' => 'required',
            'pec_width' => 'required',
            'calve_thickness' => 'required',
        ]);

        $userID = Auth::id();

        $success = Progress::create([
            'weight' => $validatedData['weight'],
            'height' => $validatedData['height'],
            'waist_line' => $validatedData['waist_line'],
            'bicep_thickness' => $validatedData['bicep_thickness'],
            'pec_width' => $validatedData['pec_width'],
            'calve_thickness' => $validatedData['calve_thickness'],
            'userID' => $userID,
        ]);

        if ($success) {
            $data = [
                'message' => 'progress added succefully!'
            ];
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'unexpected error'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(progress $progress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(progress $progress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, progress $progress)
    {
        $userID = Auth::id();
        if ($userID == $progress->userID) {
            $validatedData = $request->validate([
                'weight' => 'required',
                'height' => 'required',
                'waist_line' => 'required',
                'bicep_thickness' => 'required',
                'pec_width' => 'required',
                'calve_thickness' => 'required',
            ]);

            $success = $progress->update([
                'weight' => $validatedData['weight'],
                'height' => $validatedData['height'],
                'waist_line' => $validatedData['waist_line'],
                'bicep_thickness' => $validatedData['bicep_thickness'],
                'pec_width' => $validatedData['pec_width'],
                'calve_thickness' => $validatedData['calve_thickness'],
            ]);

            if ($success) {
                $data = [
                    'message' => 'progress updated succefully!'
                ];
                return response()->json($data, 200);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(progress $progress)
    {
        $userID = Auth::id();
        if ($userID == $progress->userID) {

            $progress->delete();

            $data = [
                'message' => 'progress deleted succefully!'
            ];
            return response()->json($data, 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }
    }

    public function updateStatus(Request $request, progress $progress)
    {
        $userID = Auth::id();
        if ($userID == $progress->userID) {
            $validatedData = $request->validate([
                'status' => 'required',
            ]);

            $success = $progress->update([
                'status' => $validatedData['status'],
            ]);

            if ($success) {
                $data = [
                    'message' => 'status changed succefully!'
                ];
                return response()->json($data, 200);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }
    }
}
