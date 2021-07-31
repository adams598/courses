<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    
    public function index()
    {
        $courses = Course::with('user')
        ->select('courses.*', DB::raw(
            '(
                SELECT COUNT(DISTINCT(user_id))
                FROM completions
                INNER JOIN episodes ON completions.episode_id = episode_id
                WHERE episodes.course_id = courses.id
            ) AS participants'
        ))
        ->withCount('episodes')->latest()->get();
        

        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }

    public function show(int $id) 
    {
        $course = Course::where('id', $id)->with('episodes')->first();
        $watched = auth()->user()->episode;
        
        return Inertia::render('Courses/Show', [
            'course' => $course,
            'watched' => $watched
        ]);
    }

    public function toggleProgress(Request $request)
    {
        $id = $request->input('episodeId');
        $user = auth()->user();

        $user->episodes()->toggle($id);

        return $user->episodes;
    }
}
