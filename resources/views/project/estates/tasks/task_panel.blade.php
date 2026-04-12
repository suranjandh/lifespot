<!-- Task List -->
<!--Panel 1-->
<div class="tab-pane fade in show active" id="panel_task" role="tabpanel">
    <div  class="scrollspy-example taskList" id="task-list">
        <!-- task items set -->

    @include('project.estates.tasks.task_items')

    <!-- task items set-->
    </div>
    <div  class="secondaryTaskList" id="taskListScroller">
        {{--@php include 'tasks/tasks_scroller.php'@endphp--}}
        {{-- @include('project.estates.tasks.tasks_scroller')--}}
    </div>
</div>
<!--/.Panel 1-->
<!-- ?Task List -->
<!-- Skipped Tasks -->
<!--Panel 2-->
<div class="tab-pane fade" id="panel_task_skip" role="tabpanel">
    <div class="scrollspy-example" id="skipped-tasks">
        <!-- task items set -->
    @include('project.estates.tasks.task_skip_items')
    <!-- task items set-->
    </div>
</div>
<!--/.Panel 2-->
<!-- /Skipped Tasks -->
