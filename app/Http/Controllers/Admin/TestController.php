<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $tests = Test::latest()->get();
        return view('admin.tests.index', compact('tests'));
    }

    public function create()
    {
        return view('admin.tests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
        ]);

        Test::create([
            'title' => $request->title,
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
            'created_by' => auth('web')->id(),
        ]);

        return redirect()->route('admin.tests.index')
            ->with('success', 'Test created successfully');
    }

    public function edit(Test $test)
    {
        return view('admin.tests.edit', compact('test'));
    }

    public function update(Request $request, Test $test)
    {
        $request->validate([
            'title' => 'required|string',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
        ]);

        $test->update($request->only('title','starts_at','ends_at'));

        return redirect()->route('admin.tests.index')
            ->with('success', 'Test updated');
    }

    public function destroy(Test $test)
    {
        $test->delete();
        return back()->with('success', 'Test deleted');
    }
}