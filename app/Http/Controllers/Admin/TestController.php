<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestStoreRequest;
use App\Models\Submission;
use App\Models\Test;

class TestController extends Controller
{
    /**
     * Display a listing of tests.
     */
    public function index()
    {
        $tests = Test::latest()->get();
        return view('admin.tests.index', compact('tests'));
    }

    /**
     * Show the form for creating a new test.
     */
    public function create()
    {
        return view('admin.tests.create');
    }

    /**
     * Store a newly created test in storage.
     */
    public function store(TestStoreRequest $request)
    {
        Test::create([
            'title' => $request->title,
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at,
            'created_by' => auth('web')->id(),
        ]);

        notyf()->success('Test created successfully');
        return redirect()->route('admin.tests.index');
    }

    /**
     * Show the form for editing the specified test.
     */
    public function edit(Test $test)
    {
        return view('admin.tests.edit', compact('test'));
    }

    /**
     * Update the specified test in storage.
     */
    public function update(TestStoreRequest $request, Test $test)
    {
        $test->update($request->only('title', 'starts_at', 'ends_at'));

        notyf()->success('Test updated successfully');
        return redirect()->route('admin.tests.index');
    }

    /**
     * Remove the specified test from storage.
     */
    public function destroy(Test $test)
    {
        $test->delete();
        notyf()->success('Test deleted successfully');
        return back();
    }

    /**
     * show submissions for a specific test.
     */
    public function submissions($testId)
    {
        $submissions = Submission::where('test_id', $testId)->get();

        return view('admin.tests.submissions', compact('submissions'));
    }
}
