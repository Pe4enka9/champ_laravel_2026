<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>@yield('title')</title>
</head>
<body>

<header class="mb-5 py-3 container d-flex justify-content-center">
    <nav class="d-flex gap-3">
        <a href="{{ route('courses.index') }}" class="btn btn-primary">Курсы</a>
        <a href="{{ route('lessons.index') }}" class="btn btn-primary">Уроки</a>
        <a href="{{ route('students.index') }}" class="btn btn-primary">Студенты</a>
    </nav>
</header>

<main class="container">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
