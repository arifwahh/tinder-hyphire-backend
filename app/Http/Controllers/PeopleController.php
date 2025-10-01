<?php
// app/Http/Controllers/PeopleController.php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    /**
     * Get recommended people with pagination
     * Excludes people the user has already liked/disliked
     */
    public function recommended(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        
        // Get IDs of people the user has already swiped on
        $swipedPersonIds = Like::where('user_id', $userId)
            ->pluck('person_id')
            ->toArray();
        
        // Get recommended people (not swiped by user)
        $people = Person::with(['pictures' => function($query) {
                $query->orderBy('position');
            }])
            ->whereNotIn('id', $swipedPersonIds)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'data' => $people->items(),
            'pagination' => [
                'current_page' => $people->currentPage(),
                'last_page' => $people->lastPage(),
                'per_page' => $people->perPage(),
                'total' => $people->total(),
            ]
        ]);
    }

    /**
     * Like a person
     */
    public function like(Request $request, $id): JsonResponse
    {
        $userId = $request->user()->id;
        $person = Person::findOrFail($id);

        return DB::transaction(function () use ($userId, $person) {
            // Check if already swiped
            $existingLike = Like::where('user_id', $userId)
                ->where('person_id', $person->id)
                ->first();

            if ($existingLike) {
                return response()->json([
                    'message' => 'You have already swiped on this person'
                ], 400);
            }

            // Create like record
            Like::create([
                'user_id' => $userId,
                'person_id' => $person->id,
                'type' => 'like'
            ]);

            // You can add additional logic here like:
            // - Check for mutual likes
            // - Send notifications
            // - Update match statistics

            return response()->json([
                'message' => 'Person liked successfully',
                'match' => false // You can implement mutual match logic here
            ]);
        });
    }

    /**
     * Dislike a person
     */
    public function dislike(Request $request, $id): JsonResponse
    {
        $userId = $request->user()->id;
        $person = Person::findOrFail($id);

        return DB::transaction(function () use ($userId, $person) {
            // Check if already swiped
            $existingLike = Like::where('user_id', $userId)
                ->where('person_id', $person->id)
                ->first();

            if ($existingLike) {
                return response()->json([
                    'message' => 'You have already swiped on this person'
                ], 400);
            }

            // Create dislike record
            Like::create([
                'user_id' => $userId,
                'person_id' => $person->id,
                'type' => 'dislike'
            ]);

            return response()->json([
                'message' => 'Person disliked successfully'
            ]);
        });
    }

    /**
     * Get list of liked people
     */
    public function likedList(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        
        $likedPeople = Person::with(['pictures' => function($query) {
                $query->orderBy('position');
            }])
            ->whereHas('likes', function($query) use ($userId) {
                $query->where('user_id', $userId)
                      ->where('type', 'like');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'data' => $likedPeople,
            'count' => $likedPeople->count()
        ]);
    }

    /**
     * Check if there's a mutual like (match)
     */
    public function checkMatch(Request $request, $personId): JsonResponse
    {
        $userId = $request->user()->id;
        
        $mutualLike = Like::where('user_id', $personId) // The other person liked you
            ->where('person_id', $userId)
            ->where('type', 'like')
            ->exists();

        return response()->json([
            'is_match' => $mutualLike
        ]);
    }
}