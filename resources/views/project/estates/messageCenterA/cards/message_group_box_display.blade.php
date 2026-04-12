<div id="Member 1" class="msg-mem-board msg-center groupEmail">
    <div class="row d-flex">
        <h4 style="float: left" class="h4-responsive ml-3 mt-4"
        >{{$message_group->message_group_name}}</h4>
        @foreach ($message_group_members as $message_group_member)
           @php $data = (object)array(
                'user_id' => '',
                'full_name' => '',
                'image_path' => '',
                'user_role_in_estate' => ''
            );
            @endphp
            @if($message_group_member->user_id == auth()->user()->id)
             @php continue ; @endphp
            @endif
            @if ($message_group_member->member_owner_user_id > 0 && $message_group_member->user_id != $message_group_member->member_owner_user_id)
                @php    // is a member  get data of member object
               $data->full_name = $message_group_member->member_first_name . ' ' . $message_group_member->member_last_name;
                $member = \App\Member::find($message_group_member->member_id);
                $data->image_path = $member->get_member_image_url($member);
                $main_role  = $member->main_role($member->roles);
                $data->user_role_in_estate = $main_role->role_name ; @endphp
            @else
             @php   //is a user account - get data of  user object
              $data->user_id = $message_group_member->user_id;
                $profile = \App\Profile::where('profile_user_id',$message_group_member->user_id)->get();
                //$profile = $profile_obj->get_profile_by_profile_user_id($message_group_member->user_id);
                $data->full_name = $profile->profile_first_name . ' ' . $profile->profile_last_name;
                $data->image_path = $profile->get_profile_image($message_group_member->user_id); @endphp
            @endif


            <div class="msg-member-role"><img style="width: 20px;height: 20px" src="{{ $data->image_path }}" class="mem-msg-pic-board group-message-member-img rounded-circle"
                > {{ $data->full_name }}</div><br>
        @endforeach

    </div>
    <hr>
    <!-- //this img insert is just a temp holding spot until the live message center texts are active -->
    <!--<div class="row middleRow"><img src="../img/text_msg.png" width="95%" alt=""></div>-->
    <div class="message_set_container">
    {{--@php include 'group_messages_set.php'; @endphp--}}
        @include('project.estates.messageCenterA.cards.group_messages_set')
    </div>
    <hr>
    @php
    $message_group_display = true ;
    /*include 'message_input_form.php';*/
    @endphp
    @include('project.estates.messageCenterA.cards.message_input_form')
</div>