<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LessonController extends Controller
{
    // Все уроки
    public function index(): View
    {
        $lessons = Lesson::paginate(5);

        return view('lessons.index', ['lessons' => $lessons]);
    }

    // Форма создания урока
    public function create(): View
    {
        $courses = Course::all();

        return view('lessons.create', ['courses' => $courses]);
    }

    // Создание урока
    public function store(LessonRequest $request): RedirectResponse
    {
        Lesson::create([
            'name' => $request->name,
            'description' => $request->description,
            'video' => $request->video,
            'hours' => $request->hours,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('lessons.index');
    }

    // Форма редактирования урока
    public function edit(Lesson $lesson): View
    {
        $courses = Course::all();

        return view('lessons.edit', [
            'lesson' => $lesson,
            'courses' => $courses,
        ]);
    }

    // Редактирование урока
    public function update(LessonRequest $request, Lesson $lesson): RedirectResponse
    {
        $lesson->update([
            'name' => $request->name,
            'description' => $request->description,
            'video' => $request->video,
            'hours' => $request->hours,
            'course_id' => $request->course_id,
        ]);

        return redirect()->route('lessons.index');
    }

    // Удаление урока
    public function destroy(Lesson $lesson): RedirectResponse
    {
        if (!$lesson->course->users()->exists()) {
            $lesson->delete();
        }

        return redirect()->route('lessons.index');
    }
}
