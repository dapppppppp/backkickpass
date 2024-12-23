<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaceRecognition;

class FaceRecognitionController extends Controller
{
    public function index()
    {
        $faces = FaceRecognition::all();
        return response()->json($faces);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nik' => 'required|string|unique:face_recognitions',
            'name' => 'required|string',
            'address' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan foto ke storage
        $path = $request->file('photo')->store('face_photos', 'public');

        $faceRecognition = FaceRecognition::create([
            'user_id' => $request->user_id,
            'nik' => $request->nik,
            'name' => $request->name,
            'address' => $request->address,
            'photo' => $path,
        ]);

        return response()->json(['message' => 'Face recognition data saved successfully', 'data' => $faceRecognition], 201);
    }

    public function show($id)
    {
        $face = FaceRecognition::find($id);
        if (!$face) {
            return response()->json(['message' => 'Face recognition data not found'], 404);
        }
        return response()->json($face);
    }

    public function update(Request $request, $id)
    {
        $face = FaceRecognition::find($id);
        if (!$face) {
            return response()->json(['message' => 'Face recognition data not found'], 404);
        }

        $face->update($request->all());
        return response()->json(['message' => 'Face recognition data updated successfully', 'data' => $face]);
    }

    public function destroy($id)
    {
        $face = FaceRecognition::find($id);
        if (!$face) {
            return response()->json(['message' => 'Face recognition data not found'], 404);
        }

        $face->delete();
        return response()->json(['message' => 'Face recognition data deleted successfully']);
    }
}