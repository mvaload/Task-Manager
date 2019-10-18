<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskStatus;

class TaskStatusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskStatuses = TaskStatus::paginate(10);
        return view('task_statuses.index', [
            'taskStatuses' => $taskStatuses,
            'initIteration' => ($taskStatuses->currentPage() - 1) * $taskStatuses->perPage()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        TaskStatus::create($data);
        return redirect()->route('task_statuses.index')->with('success', __('The task status has been created!'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Craftworks\TaskManager\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('task_statuses.edit', ['taskStatus' => $taskStatus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Craftworks\TaskManager\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskStatus $taskStatus)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        $taskStatus->name = $data['name'];
        $taskStatus->save();
        return redirect()->route('task_statuses.index')->with('success', __('The task status has been updated!'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Craftworks\TaskManager\TaskStatus  $taskStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskStatus $taskStatus)
    {
        $taskStatus->delete();
        return redirect()->route('task_statuses.index')->with('success', __('The task status has been deleted'));
    }
}
