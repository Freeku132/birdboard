<?php
//
//namespace App\Observers;
//
//use App\Models\Project;
//
//
//class ProjectObserver
//{
//    /**
//     * Handle the Project "created" event.
//     *
//     * @param  \App\Models\Project  $project
//     * @return void
//     */
//    public function created(Project $project)
//    {
//        $project->recordActivity( 'created');
//    }
//
//    /**
//     * Handle the Project "updating" event.
//     *
//     * @param  \App\Models\Project  $project
//     * @return void
//     */
////    public function updating(Project $project)
////    {
////        $project->old = $project->getRawOriginal();
////    }
//    /**
//     * Handle the Project "updated" event.
//     *
//     * @param  \App\Models\Project  $project
//     * @return void
//     */
//    public function updated(Project $project)
//    {
//        $project->recordActivity( 'updated');
//    }
//
//
//
//    /**
//     * Handle the Project "deleted" event.
//     *
//     * @param  \App\Models\Project  $project
//     * @return void
//     */
//    public function deleted(Project $project)
//    {
//        //
//    }
//
//    /**
//     * Handle the Project "restored" event.
//     *
//     * @param  \App\Models\Project  $project
//     * @return void
//     */
//    public function restored(Project $project)
//    {
//        //
//    }
//
//    /**
//     * Handle the Project "force deleted" event.
//     *
//     * @param  \App\Models\Project  $project
//     * @return void
//     */
//    public function forceDeleted(Project $project)
//    {
//        //
//    }
////    protected function recordActivity($type, $project)
////    {
////        Activity::create([
////            'project_id' => $project->id,
////            'description' => $type
////            ]);
////    }
//}
