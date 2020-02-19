<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function todo(Request $request)
    {
        $task = Task::where('task_name', '=', request('taskName'))->first();
        if($task == null){
            $this->validate($request, [
                'taskName' => 'required|max:500'
            ]);
         $addedTask = Task::create([ 'task_name' => request('taskName') ]);
         return response()->json(['success'=>true, 'message' => 'Task added succesfully!', 'task' => $addedTask]);

        }else{
            return response()->json(['success'=>false, 'message' => 'User Already Exists!']);
        }
       
    }
    public function getTasks(Request $request)
    {
        return Task::latest()->get();
    }
    public function deleteTask(Request $request)
    {
        $task = Task::find(request('id'));
        $task->delete();
        return response()->json(['success'=>true,'message'=>'Deleted successfully!']);
       
    }
    public function updateTask(Request $request){
        $task = Task::find(request('taskId'));
        if($task != null){
            $task->update(['task_name' => request('task')]);
            if($task){
                return response()->json(['success'=>true, 'message' => 'Task updated succesfully!', 'task' => $task]);
            }else{
                return response()->json(['success'=>false, 'message' => 'Unable to update task']);
            }
        }
    }

    public function reset(Request $request){
        $reset = Task::truncate();
        if($reset){
            return response()->json(['success'=>true, 'message' => 'Truncate succesfully!']);
        }else{
            return response()->json(['success'=>false, 'message' => 'Task updated succesfully!']);
        }
    }
}