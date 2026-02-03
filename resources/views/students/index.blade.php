@extends('theme')
@section('title', 'Студенты')
@section('content')
    <h1 class="mb-3">Студенты</h1>

    @foreach($students as $student)
        <h3>Студент: {{ $student->name }} ({{ $student->email }})</h3>
        <ul>
            @foreach($student->orders as $order)
                <li>
                    {{ $order->course->name }}
                    - записан: {{ $order->created_at->format('d-m-Y') }}
                    - статус: {{ $order->payment_status->label() }}
                </li>
            @endforeach
        </ul>
    @endforeach
@endsection
