@extends('theme')
@section('title', 'Изменить курс')
@section('content')
    <form action="{{ route('courses.update', $course) }}" method="post" class="w-25 m-auto"
          enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <h1 class="mb-3">Изменить курс</h1>

        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $course->name }}">
            @error('name') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" class="form-control">{{ $course->description }}</textarea>
            @error('description') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="hours" class="form-label">Длительность (в часах)</label>
            <input type="number" name="hours" id="hours" class="form-control" value="{{ $course->hours }}">
            @error('hours') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ $course->price }}">
            @error('price') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Дата начала</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
                   value="{{ $course->start_date->format('Y-m-d') }}">
            @error('start_date') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Дата окончания</label>
            <input type="date" name="end_date" id="end_date" class="form-control"
                   value="{{ $course->end_date->format('Y-m-d') }}">
            @error('end_date') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Обложка</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image') <p class="text text-danger">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-success w-100 mb-2">Изменить</button>
        <a href="{{ url()->previous() }}" class="btn btn-danger w-100">Отмена</a>
    </form>
@endsection
