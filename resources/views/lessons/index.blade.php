@extends('theme')
@section('title', 'Уроки')
@section('content')
    <h1 class="mb-3">Уроки</h1>

    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('lessons.create') }}" class="btn btn-primary">Создать урок</a>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Курсы</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th>Описание</th>
            <th>Ссылка на видео</th>
            <th>Длительность (в часах)</th>
            <th>Курс</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lessons as $lesson)
            <tr>
                <td>{{ $lesson->name }}</td>
                <td>{{ $lesson->description }}</td>
                <td>{{ $lesson->video }}</td>
                <td>{{ $lesson->hours }}</td>
                <td>{{ $lesson->course->name }}</td>
                <td><a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-primary">Изменить</a></td>
                <td>
                    <form action="{{ route('lessons.destroy', $lesson) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $lessons->links() }}
@endsection
