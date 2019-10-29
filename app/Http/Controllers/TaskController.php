<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use App\Filters\FiltersTaskAssignedTo;
use App\Filters\FiltersTaskTags;
use App\Task;
use App\TaskStatus;
use App\User;
use App\Tag;

class TaskController extends Controller
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
    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)->allowedFilters([
            AllowedFilter::exact('status_id'),
            AllowedFilter::custom('assigned_to_id', new FiltersTaskAssignedTo()),
            AllowedFilter::custom('tags', new FiltersTaskTags())])
            ->allowedIncludes(['status', 'creator', 'assignedTo'])->paginate(10);

        $users = User::orderBy('name')->withTrashed()->get();
        $statuses = TaskStatus::orderBy('name')->withTrashed()->get();
        $tags = Tag::orderBy('name')->get();
        
        return view('tasks.index', [
            'users' => $users,
            'statuses' => $statuses,
            'tags' => $tags,
            'tasks' => $tasks,
            'filter' => [
                'status_id' => $request->input('filter.status_id'),
                'assigned_to_id' => $request->input('filter.assigned_to_id'),
                'tags' => $request->input('filter.tags'),
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $tags = Tag::all();
        return view('tasks.create', [
            'statuses' => $taskStatuses,
            'users' => $users,
            'tags' => $tags
        ]);
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
            'name' => ['required', 'string', 'max:255'],
            'description' => [],
            'status_id' => ['exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id']
        ]);
        $data['creator_id'] = auth()->user()->id;
        $tags = Tag::getIds($request->tags);
        Task::create($data)->tags()->sync($tags);
        return redirect()->route('tasks.index')->with('success', __('The task has been created!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Craftworks\TaskManager\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Craftworks\TaskManager\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $taskStatuses = TaskStatus::all();
        $users = User::all();
        $tags = Tag::all();
        return view('tasks.edit', [
            'task' => $task,
            'statuses' => $taskStatuses,
            'users' => $users,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Craftworks\TaskManager\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => [],
            'status_id' => ['exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id']
        ]);
        $tags = Tag::getIds($request->tags);
        $task->name = $data['name'];
        $task->description = $data['description'];
        $task->status_id = $data['status_id'];
        $task->assigned_to_id = $data['assigned_to_id'];
        $task->tags()->sync($tags);
        $task->save();
        return redirect()->route('tasks.index')->with('success', __('The task has been updated!'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Craftworks\TaskManager\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->tags()->detach();
        $task->delete();
        return redirect()->route('tasks.index')->with('success', __('The task has been deleted'));
    }
}
