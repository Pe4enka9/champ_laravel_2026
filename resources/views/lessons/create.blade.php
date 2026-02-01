@extends('theme')
@section('title', 'Создать урок')
@section('content')
    <form action="{{ route('lessons.store') }}" method="post" class="w-25 m-auto">
        @csrf
        <h1 class="mb-3">Создать урок</h1>

        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" name="name" id="name" class="form-control">
            @error('name') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" class="form-control"></textarea>
            @error('description') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="video" class="form-label">Ссылка на видео</label>
            <input type="url" name="video" id="video" class="form-control">
            @error('video') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="hours" class="form-label">Длительность (в часах)</label>
            <input type="number" name="hours" id="hours" class="form-control">
            @error('hours') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Курс</label>
            <select name="course_id" id="course_id" class="form-select">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
            @error('course_id') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-success w-100 mb-2">Создать</button>
        <a href="{{ url()->previous() }}" class="btn btn-danger w-100">Отмена</a>
    </form>
@endsection
