<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TextEditorController extends Controller
{
    public function rulesIndex()
    {
        $content = Storage::exists('/upload/rules.txt') ? Storage::get('/upload/rules.txt') : '';

        return view('rules.index', ['content' => $content]);
    }

    public function rulesEdit()
    {
        $content = Storage::exists('/upload/rules.txt') ? Storage::get('/upload/rules.txt') : '';

        return view('rules.edit', ['content' => $content]);
    }

    public function rulesSave(Request $request)
    {
        $content = $request->input('content');
        Storage::put('/upload/rules.txt', $content);

        return redirect()->route('rules.edit');
    }

    public function loyaltyIndex()
    {
        $content = Storage::exists('/upload/loyalty.txt') ? Storage::get('/upload/loyalty.txt') : '';

        return view('loyalty.index', ['content' => $content]);
    }

    public function loyaltyEdit()
    {
        $content = Storage::exists('/upload/loyalty.txt') ? Storage::get('/upload/loyalty.txt') : '';

        return view('loyalty.edit', ['content' => $content]);
    }

    public function loyaltySave(Request $request)
    {
        $content = $request->input('content');
        Storage::put('/upload/loyalty.txt', $content);

        return redirect()->route('loyalty.edit');
    }
}
