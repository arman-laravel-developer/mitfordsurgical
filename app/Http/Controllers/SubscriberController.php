<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::orderBy('id', 'desc')->get();
        return view('admin.subscriber.index', compact('subscribers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        // Save email to database (assuming you have a Subscriber model)
        Subscriber::create(['email' => $request->email]);

        return back()->with('success', 'You have successfully subscribed to our newsletter!');
    }

    public function delete($id)
    {
        Subscriber::find($id)->delete();
        return back()->with('success', 'Subscriber delete successfully!');
    }
}
