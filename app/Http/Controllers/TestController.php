<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\TestEnrollment;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function send()
    {
        $user = User::first();

        $enrollmentData = [
            'body' => 'you received new notification',
            'enrollmentText' => 'you are allowed',
            'url' => url('/'),
            'thankyou' => 'thank you for the view'
        ];

        $user->notify(new TestEnrollment($enrollmentData));
    }
}
