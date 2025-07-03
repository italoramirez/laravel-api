<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $user = User::with(['image'])
                ->findOrFail(auth()->user()->idk, ['id', 'name', 'email']);
            return response()->json([
                'status' => Response::HTTP_OK,
                'data' => $user,
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Error fetching user images: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
    //        $user = User::findOrFail($id);
            $user = auth()->user();
            $image = $user->image()->create([
                'imageable_id' => $user->id,
                'url' => $request->input('url'),
            ]);

    //        $image = Image::create([
    //            'url' => $request->input('url'),
    //            'imageable_id' => $user->id,
    //            'imageable_type' => User::class,
    //        ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Error saving image: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'status' => Response::HTTP_CREATED,
            'data' => $image
        ], Response::HTTP_CREATED);
    }
}
