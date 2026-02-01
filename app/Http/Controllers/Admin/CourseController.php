<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\CreateCourseRequest;
use App\Http\Requests\Admin\Course\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class CourseController extends Controller
{
    // Все курсы
    public function index(): View
    {
        $courses = Course::paginate(5);

        return view('courses.index', ['courses' => $courses]);
    }

    // Форма создания курса
    public function create(): View
    {
        return view('courses.create');
    }

    // Создание курса
    public function store(CreateCourseRequest $request): RedirectResponse
    {
        $imagePath = $this->resizeImage($request->file('image'));

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'hours' => $request->hours,
            'price' => $request->price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => $imagePath,
        ]);

        return redirect()->route('courses.index');
    }

    // Форма редактирования курса
    public function edit(Course $course): View
    {
        return view('courses.edit', ['course' => $course]);
    }

    // Редактирование курса
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($course->image);
            $imagePath = $this->resizeImage($request->file('image'));
        }

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'hours' => $request->hours,
            'price' => $request->price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => $imagePath ?? $course->image,
        ]);

        return redirect()->route('courses.index');
    }

    // Удаление курса
    public function destroy(Course $course): RedirectResponse
    {
        Storage::disk('public')->delete($course->image);
        $course->delete();

        return redirect()->route('courses.index');
    }

    // Конвертация изображения
    private function resizeImage(UploadedFile $image): string
    {
        $imageName = 'mpic_' . uniqid() . '.' . $image->extension();
        $manager = new ImageManager(new Driver());
        $processed = $manager->read($image)->cover(300, 300)->toJpeg();
        Storage::disk('public')->put('images/' . $imageName, $processed->toString());

        return 'images/' . $imageName;
    }
}
