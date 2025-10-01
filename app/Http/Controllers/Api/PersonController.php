<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Like;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Tinder Lite API",
 *      description="API documentation for Tinder-like app",
 *      @OA\Contact(
 *          email="support@example.com"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Local API Server"
 * )
 */
class PersonController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/people",
     *     tags={"People"},
     *     summary="Get list of recommended people",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $people = Person::with('pictures')->paginate(10);
        return response()->json($people);
    }

    /**
     * @OA\Post(
     *     path="/api/people/{id}/like",
     *     tags={"People"},
     *     summary="Like a person",
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Person ID",
     *          required=true
     *     ),
     *     @OA\Response(response=200, description="Person liked")
     * )
     */
    public function like(Request $request, $id)
    {
        $userId = $request->user()->id ?? 1;

        $like = Like::updateOrCreate(
            ['user_id' => $userId, 'person_id' => $id],
            ['type' => 'like']
        );

        return response()->json(['message' => 'Person liked!', 'data' => $like]);
    }

    /**
     * @OA\Post(
     *     path="/api/people/{id}/dislike",
     *     tags={"People"},
     *     summary="Dislike a person",
     *     @OA\Response(response=200, description="Person disliked")
     * )
     */
    public function dislike(Request $request, $id)
    {
        $userId = $request->user()->id ?? 1;

        $dislike = Like::updateOrCreate(
            ['user_id' => $userId, 'person_id' => $id],
            ['type' => 'dislike']
        );

        return response()->json(['message' => 'Person disliked!', 'data' => $dislike]);
    }

    /**
     * @OA\Get(
     *     path="/api/people/liked/list",
     *     tags={"People"},
     *     summary="Get list of liked people",
     *     @OA\Response(response=200, description="List of liked people")
     * )
     */
    public function likedPeople(Request $request)
    {
        $userId = $request->user()->id ?? 1;

        $liked = Like::where('user_id', $userId)
            ->where('type', 'like')
            ->with('person.pictures')
            ->get();

        return response()->json($liked);
    }
}
