@extends('theme')
@section('title', 'Студенты')
@section('content')
    <h1 class="mb-3">Студенты</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Email</th>
            <th>Имя</th>
            <th>Курсы</th>
            <th>Дата записи</th>
            <th>Статус оплаты</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $student->email }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->courses->implode('name', ', ') }}</td>
                <td>{{ $student->orders->map(fn($order) => $order->created_at->format('d-m-Y'))->implode(', ') }}</td>
                <td>{{ $student->orders->map(fn($order) => $order->payment_status->label())->implode(', ') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
