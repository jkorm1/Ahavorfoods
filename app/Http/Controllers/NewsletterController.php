<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ], [
            'email.unique' => 'This email is already subscribed!',
        ]);
        

        NewsletterSubscriber::create([
            'email' => $request->input('email'),
        ]);

        return redirect()->back()->with('newsletter_success', 'Thank you for subscribing to our newsletter!');
    }
}
