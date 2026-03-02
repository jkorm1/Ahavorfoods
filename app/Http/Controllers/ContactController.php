<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $faqs = Faq::all(); // Fetch FAQs dynamically from the database
        return view('contact', compact('faqs'));
    }

    public function submit(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string',
        'department' => 'required|string',
        'message' => 'required|string',
        'privacy' => 'required|accepted',
    ], [
        'privacy.accepted' => 'You must accept the privacy policy.',
    ]);


    // ✅ Store message in database
    $contactMessage = ContactMessage::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'subject' => $request->input('subject'),
        'department' => $request->input('department'),
        'message' => $request->input('message'),
        'privacy' => $request->boolean('privacy'),
    ]);

    if (!$contactMessage) {
        return redirect()->back()->with('error', '❌ Message could not be saved!');
    }

    return redirect()->back()->with('success', '✅ Your message has been sent successfully!');
}

}
