<?php
//
//namespace App\Observers;
//
//use App\Models\Task;
//
//class TaskObserver
//{
//    /**
//     * Handle the Task "created" event.
//     *
//     * @param  \App\Models\Task  $task
//     * @return void
//     */
//    public function created(Task $task)
//    {
//        $task->recordActivity('created_task');
//    }
//    /**
//     * Handle the Task "updating" event.
//     *
//     * @param  \App\Models\Task  $task
//     * @return void
//     */
////    public function updating(Task $task)
////    {
////        $task->old = $task->getRawOriginal();
////    }
//
//    /**
//     * Handle the Task "updated" event.
//     *
//     * @param  \App\Models\Task  $task
//     * @return void
//     */
//    public function updated(Task $task)
//    {
//        //
//    }
//
//    /**
//     * Handle the Task "deleted" event.
//     *
//     * @param  \App\Models\Task  $task
//     * @return void
//     */
//    public function deleted(Task $task)
//    {
//        $task->recordActivity('deleted_task');
//    }
//
//    /**
//     * Handle the Task "restored" event.
//     *
//     * @param  \App\Models\Task  $task
//     * @return void
//     */
//    public function restored(Task $task)
//    {
//        //
//    }
//
//    /**
//     * Handle the Task "force deleted" event.
//     *
//     * @param  \App\Models\Task  $task
//     * @return void
//     */
//    public function forceDeleted(Task $task)
//    {
//        //
//    }
//}
