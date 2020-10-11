<?php

namespace App\Http\Controllers;

use App\Task;
use App\Tag;
use App\User;
use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $filters = optional($request->only('filter'))['filter'];

        $tasks = QueryBuilder::for(Task::class)
            ->with(['status', 'tags', 'assignedTo', 'creator'])
            ->allowedFilters(
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('creator_id'),
                AllowedFilter::exact('assigned_to_id'),
                AllowedFilter::exact('tags.id')
            )->get();

        $statusItems  = TaskStatus::pluck('name', 'id');
        $userItems = User::pluck('name', 'id');
        $tagItems = Tag::pluck('name', 'id');

        return view('task.index', compact('tasks', 'statusItems', 'userItems', 'filters', 'tagItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $task = new Task();
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $tags = Tag::all();

        return view('task.create', compact('users', 'task', 'taskStatuses', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:tasks',
            'status_id' => 'required|exists:task_statuses,id',
            'description' => 'nullable|string',
            'assigned_to_id' => 'nullable|integer',
        ]);
        $task = Auth::user()->createdTasks()->make($data);
        $task->save();
        $task->tags()->attach($request->input('tags'));

        flash()->success(__('flashes.task.store'));

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     * @return Response
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Task  $task
     * @return Response
     */
    public function edit(Task $task)
    {

        $taskStatuses  = TaskStatus::all();
        $users = User::all();
        $tags = Tag::all();

        return view('task.edit', compact('task', 'taskStatuses', 'users', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $this->validate($request, [
            'name' => 'required|unique:tasks,name,' . $task->id,
            'description' => 'nullable|string',
            'assigned_to_id' => 'nullable|integer',
            'status_id' => 'required|integer',
        ]);

        $task->tags()->sync($request->input('tags'));
        $task->fill($data);
        $task->save();

        flash()->success(__('flashes.task.update'));

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('destroy', $task);
        $task->tags()->detach();
        $task->delete();

        flash()->success(__('flashes.task.destroy'));

        return redirect()->route('tasks.index');
    }
}
