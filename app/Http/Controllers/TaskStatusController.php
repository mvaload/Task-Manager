<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskStatus;
use Illuminate\Http\Response;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_status.index', compact('taskStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('task_status.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:task_statuses',
        ]);
        $taskStatus = new TaskStatus();
        $taskStatus->fill($validatedData);
        $taskStatus->save();

        flash()->success(__('flashes.taskStatus.store'));
        return redirect()->route('task_statuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TaskStatus  $taskStatus
     * @return Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('task_status.edit', compact('taskStatus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  TaskStatus  $taskStatus
     * @return Response
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:task_statuses,' . $taskStatus->id,
        ]);
        $taskStatus->fill($validatedData)->save();

        flash()->success(__('flashes.taskStatus.update'));

        return redirect()->route('task_statuses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TaskStatus  $taskStatus
     * @return Response
     */
    public function destroy(TaskStatus $taskStatus)
    {
        $taskStatus->delete();
        flash()->success(__('flashes.taskStatus.destroy'));

        return back();
    }
}
