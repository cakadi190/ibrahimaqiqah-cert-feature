<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UploadImageController extends Controller
{
    public function index(Request $request)
    {
        return view('upload-image.index');
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $path = $request->file('image')->store('babies', 'public');

            return response()->json([
                'success' => true,
                'message' => 'File berhasil diupload',
                'data' => [
                    'path' => $path
                ]
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat upload file',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
