<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class StudentController extends Controller
{
    // Получение всех студентов, записанных на курсы
    public function index(): View
    {
        $students = User::whereHas('orders')
            ->with('orders.course')
            ->get();

        return view('students.index', ['students' => $students]);
    }
}
