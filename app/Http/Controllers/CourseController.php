<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Http\Resources\LessonResource;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Получение всех курсов
    public function index(): JsonResponse
    {
        $courses = Course::paginate(5);

        return response()->json([
            'data' => CourseResource::collection($courses),
            'pagination' => [
                'total' => $courses->total(),
                'current' => $courses->currentPage(),
                'per_page' => $courses->perPage(),
            ],
        ]);
    }

    // Получение всех уроков курса
    public function lessons(Course $course): JsonResponse
    {
        $lessons = $course->lessons;

        return response()->json([
            'data' => LessonResource::collection($lessons),
        ]);
    }

    // Запись на курс
    public function buy(Request $request, Course $course): JsonResponse
    {
        if (now()->gt($course->start_date)) {
            return response()->json([
                'message' => 'Invalid data',
                'errors' => [
                    'course_id' => ['Invalid data'],
                ],
            ], 422);
        }

        $user = $request->user();

        $order = Order::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
        ]);

        return response()->json([
            'pay_url' => url('/pay?order_id=' . $order->id),
        ]);
    }
}
