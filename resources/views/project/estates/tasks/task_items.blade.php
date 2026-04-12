<style>
     .task_container button {
        margin-left: 10px;
    }
    .task_card{
        border: 1px solid rgb(58, 113, 183);
        /* border: 2px solid rgb(58, 127, 183); */
        padding: 8px;
        border-radius: 5px;
    }
</style>
@php
    //$task_skip_ignore_types = array('random_continuous_task','no_doc_main');
@endphp
@if ($task_items['task_messages'])
    @foreach ($task_items['task_messages'] as $task)
{{--
        @foreach ($task_item as $task)
--}}
            @if ($task)
                <div class="card task_container task_container_set"
                     data-task-id="{{ isset($task['task_id']) && $task['task_id'] ? $task['task_id'] : 0 }}"
                     data-task_category="{{ isset($task['task_row']) && isset($task['task_row']['task_category']) && $task['task_row']['task_category'] ? $task['task_row']['task_category'] : 0 }}"
                     data-task_main_url="{{ isset($task['task_row']) && isset($task['task_row']['task_main_url']) && $task['task_row']['task_main_url'] ? $task['task_row']['task_main_url'] : 0 }}"
                     data-task_popup_id="{{ isset($task['task_row']) && isset($task['task_row']['task_popup_id']) && $task['task_row']['task_popup_id'] ? $task['task_row']['task_popup_id'] : 0 }}"
                     data-task_popup_title="{{ isset($task['task_row']) && isset($task['task_row']['task_popup_title']) && $task['task_row']['task_popup_title'] ? $task['task_row']['task_popup_title'] : 0 }}"
                     data-task_popup_body="{{ isset($task['task_row']) && isset($task['task_row']['task_popup_body']) && $task['task_row']['task_popup_body'] ? $task['task_row']['task_popup_body'] : 0 }}"
                     data-task_more_tasks="{{ isset($task['task_row']) && isset($task['task_row']['task_button_text']) && $task['task_row']['task_button_text'] == 'More Tasks' ? 1 : 0 }}"
                     data-task_skip_sub_category="{{ isset($task['task_skip_sub_category']) && $task['task_skip_sub_category'] != '' ? $task['task_skip_sub_category'] : 0 }}"
                     data-task-type="{{ isset($task['task_type']) ? $task['task_type'] : 0 }}"
                >
                    <div class="card-body">
                        <div class="row task_card">
                            <div class="col-1">
                                <p><img src="{{Config::get('constants.PROJECT_LOGO_IMAGE_URL')}}lifespot-leaf.png" style="height:53px; width:auto;" alt=""></p>
                            </div>
                            <div class="col-9 xml-1">
                                <p class="py-3">{{ $task['message'] }}</p>
                            </div>
                            <div class="col-2">
                                {{-- @php $task_type = isset($task['task_type']) ? $task['task_type'] : '' @endphp--}}
                                {{--@php if (!in_array($task_type, $task_skip_ignore_types)) { @endphp--}}
                                <button type="button" class="close skip_task">
                                    <span class="skip" aria-hidden="true">Skip</span>
                                </button>
                                {{--@php } @endphp--}}
                            <!-- <button  type="button" class="close delete_task" >
                                 <span class="skip" aria-hidden="true" >Delete</span>
                             </button>-->
                                <br><br>
                                @if (isset($task['open_data']['class']))
                                    @php
                                    $member_member_id = isset($task['open_data']['member-member-id']) ? $task['open_data']['member-member-id'] : 0;
                                    $member_id  = isset($task['open_data']['member-id']) ? $task['open_data']['member-id'] : 0;
                                    $member_id = $member_id > 0 ? $member_id : ($member_member_id > 0 ? $member_member_id: 0) ;
                                    @endphp
                                    <a
                                            data-member-member-id="{{ $member_id }}"
                                            data-member-id="{{ $member_id }}"
                                            data-member-type="{{ isset($task['open_data']['member-type']) ? $task['open_data']['member-type'] : 0 }}"

                                            data-document-category="{{ isset($task['open_data']['document-category']) ? $task['open_data']['document-category'] : 0 }}"
                                            data-document-category-sub="{{ isset($task['open_data']['document-category-sub']) ? $task['open_data']['document-category-sub'] : 0 }}"
                                            data-document-category-sub-sub="{{ isset($task['open_data']['document-category-sub-sub']) ? $task['open_data']['document-category-sub-sub'] : 0 }}"
                                            data-document-content-type="{{ isset($task['open_data']['document-content-type']) ? $task['open_data']['document-content-type'] : 0 }}"
                                            href="#" class="btn btnLink-dashboard {{ $task['open_data']['class'] }}"

                                            style="color: #FFFFFF">{{ $task['task_row']['task_button_text'] }}</a>
                                @else
                                    <a class="btn btnLink-dashboard switch_tab_to_update"
                                       style="color: #FFFFFF">{{ $task['task_row']['task_button_text'] }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
{{--
    @endforeach
--}}
@endif

