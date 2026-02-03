@extends('theme')
@section('title', 'Курсы')
@section('content')
    <h1 class="mb-3">Курсы</h1>
    <a href="{{ route('courses.create') }}" class="mb-3 btn btn-primary">Создать курс</a>

    @error('course')
    <div class="mb-3 alert alert-danger">{{ $message }}</div>
    @enderror

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Длительность (в часах)</th>
            <th>Цена</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
            <th>Изображение</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->hours }}</td>
                <td>{{ $course->price }}</td>
                <td>{{ $course->start_date->format('d-m-Y') }}</td>
                <td>{{ $course->end_date->format('d-m-Y') }}</td>
                <td>
                    <img src="{{ $course->image_path }}" alt="{{ $course->name }}">
                </td>
                <td><a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Изменить</a></td>
                <td>
                    <form action="{{ route('courses.destroy', $course) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $courses->links() }}
@endsection
