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
        $path = $this->convertImage($request->file('image'));

        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'hours' => $request->hours,
            'price' => $request->price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => $path,
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
            $path = $this->convertImage($request->file('image'));
        }

        $course->update([
            'name' => $request->name,
            'description' => $request->description,
            'hours' => $request->hours,
            'price' => $request->price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'image' => $path ?? $course->image,
        ]);

        return redirect()->route('courses.index');
    }

    // Удаление курса
    public function destroy(Course $course): RedirectResponse
    {
        if ($course->orders()->exists()) {
            return back()->withErrors(['course' => 'Удаление невозможно. Есть активные записи на курс.']);
        }

        Storage::disk('public')->delete($course->image);
        $course->delete();

        return redirect()->route('courses.index');
    }

    private function convertImage(UploadedFile $image): string
    {
        // Получаем временный путь к загружаемому файлу
        $tempPath = $image->getPathname();

        // Загружаем исходное изображение как ресурс GD
        $src = imagecreatefromjpeg($tempPath);

        // Определяем исходную ширину и высоту изображения
        $origW = imagesx($src);
        $origH = imagesy($src);

        // Задаем максимальный размер стороны миниатюры (300 пикселей)
        $maxSize = 300;

        // Вычисляем коэффициент масштабирования так,
        // чтобы изображение полностью поместилось в квадрат 300x300,
        // сохранив пропорции (аналог CSS object-fit: contain)
        $ratio = min($maxSize / $origW, $maxSize / $origH);

        // Рассчитываем новые размеры с учетом пропорций
        $newW = (int)($origW * $ratio);
        $newH = (int)($origH * $ratio);

        // Создаем новое "чистое" изображение (холст) нужного размера
        $dst = imagecreatetruecolor($newW, $newH);

        // Копируем и масштабируем исходное изображение на новый холст
        imagecopyresampled(
            $dst, // целевое изображение
            $src, // исходное изображение
            0, 0, // смещение на целевом изображении (x, y)
            0, 0, // смещение на исходном изображении (x, y)
            $newW, $newH, // размеры целевого изображения
            $origW, $origH // размеры исходного изображения
        );

        // Формируем уникальное имя файла: mpic_ + уникальный ID + оригинальное расширение
        $path = 'images/mpic_' . uniqid() . '.' . $image->extension();

        // Преобразуем относительный путь (для диска 'public') в абсолютный путь файловой системы
        $absolutePath = Storage::disk('public')->path($path);

        // Получаем путь к директории, в которую будем сохранять файл
        $directory = dirname($absolutePath);

        // Если директория не существует - создаем её рекурсивно
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Сохраняем обработанное изображение как JPEG
        imagejpeg($dst, $absolutePath);

        // Освобождаем память, занятую GD-ресурсами (важно для предотвращения утечек)
        imagedestroy($src);
        imagedestroy($dst);

        // Возвращаем относительный путь (например: "images/mpic_69820abc123.jpg")
        return $path;
    }
}
