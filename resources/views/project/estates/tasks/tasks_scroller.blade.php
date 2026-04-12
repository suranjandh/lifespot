@php
$task_obj = new TaskModel();
$random_continuous_tasks = $task_obj->get_random_continuous_tasks_all();
$intermittent_company_tasks = $task_obj->get_intermittent_company_tasks_all();
@endphp
<style>
    .task_scroller_text_set{
        color:white !important;
        font-size: 1.2em!important;
    }
</style>
<!--Carousel Wrapper-->
<div id="multi-item-example"  class="carousel slide carousel-multi-item task_scroller_carousel" data-ride="carousel">

    <!--Controls-->
    <!--<div class="controls-top">
        <a class="btn-floating" href="#multi-item-example" data-slide="prev"><i class="fas fa-chevron-left"></i></a>
        <a class="btn-floating" href="#multi-item-example" data-slide="next"><i
                class="fas fa-chevron-right"></i></a>
    </div>-->
    <!--/.Controls-->

    <!--Indicators-->
    <!--<ol class="carousel-indicators">
        <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
        <li data-target="#multi-item-example" data-slide-to="1"></li>
        <li data-target="#multi-item-example" data-slide-to="2"></li>
    </ol>-->
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner"  role="listbox">
        @php foreach ($random_continuous_tasks as $k => $random_continuous_task){ @endphp
        <!--First slide-->
        <div  class="carousel-item {{$k == 0 ? 'active':''}}">

            <div  class="col-md-12">
                <div class="card mb-12" style="background-color: transparent">

                    <div class="card-body" style="background-color: transparent;color: white">
                        <h4 class="card-title"></h4>
                        <p class="card-text task_scroller_text_set" >
                            {{ $random_continuous_task->random_continuous_task_message}}
                        </p>
                        <!--<a class="btn btn-primary">Button</a>-->
                    </div>
                </div>
            </div>

        </div>
        <!--/.First slide-->
        @php } @endphp
        @php foreach ($intermittent_company_tasks as $k => $intermittent_company_task){ @endphp
            <!--First slide-->
            <div class="carousel-item">

                <div  class="col-md-12">
                    <div class="card mb-12" style="background-color: transparent">

                        <div class="card-body" style="background-color: transparent;color: white">
                            <h4 class="card-title"></h4>
                            <p class="card-text task_scroller_text_set" >
                                {{ $intermittent_company_task->intermittent_company_task_message}}                        </p>
                            <!--<a class="btn btn-primary">Button</a>-->
                        </div>
                    </div>
                </div>

            </div>
            <!--/.First slide-->
        @php } @endphp

    </div>
    <!--/.Slides-->

</div>
<!--/.Carousel Wrapper-->