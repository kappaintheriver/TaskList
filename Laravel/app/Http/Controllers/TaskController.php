<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Task;

use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }
    
    public function index(Request $request)
    {
        return view('tasks', [
            'tasks' => $this->tasks->forUser($request->user())
        ]);
    }
    
    public function store(Request $request)
    {
        //dd($request->all());
        
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);
        
        session()->flash('message', '登録に成功しました！');
        
        return redirect('tasks');
    }
    
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);
        
        $task->delete();
        
        session()->flash('message', '削除に成功しました！');
        session()->flash('message-danger', true);
        
        return redirect('tasks');
    }
}
