<?php
// app/Http/Controllers/Auth/EditUserController.php
// app/Http/Controllers/Auth/EditUserController.php
// app/Http/Controllers/Auth/EditUserController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;

class EditUserController extends Controller
{
    public function update(Request $request, $id)
    {
        // Validate the request data
        $data = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|max:255',
            'image' => 'nullable|string', // Expecting base64 string
        ]);

        try {
            // Find the user by ID
            $user = User::findOrFail($id);

            // Handle file upload
            if (isset($data['image'])) {
                $relativePath = $this->saveImage($data['image']);
                $data['image'] = $relativePath;

                // Delete old image if exists
                if ($user->image) {
                    $absolutePath = public_path($user->image);
                    File::delete($absolutePath);
                }
            }

            // Update user details
            $user->update($data);

            // Return a response
            return response()->json(['message' => 'Profile updated successfully', 'user' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to update profile', 'error' => $e->getMessage()], 500);
        }
    }

    private function saveImage($image)
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('Invalid image type', 400);
            }

            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed', 400);
            }
        } else {
            throw new \Exception('Invalid image', 400);
        }

        $dir = 'images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;

        if (!file_exists($absolutePath)) {
            mkdir($absolutePath, 0777, true);
        }

        file_put_contents($absolutePath . '/' . $file, $image);

        return $relativePath;
    }
}