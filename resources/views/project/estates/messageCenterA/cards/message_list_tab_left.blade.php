@php
    // $userId =  $_SESSION->loggedInUser;
    $message_obj = new \App\Message();
    $users_data = $message_obj->get_message_enable_users_data();
    $message_groups_data = $message_obj->get_users_message_groups_data();

    $message_li_search_array = array();

@endphp
<ul class="px-0 message_member_ul">
    @foreach ($users_data as $user_data_item)
        @php
            $user_data_item = (object)$user_data_item ;
            $message_list_id = "message_member_li_1_" . $user_data_item->user_id;
            $message_li_search_array[$message_list_id] = array(
                $user_data_item->full_name,$user_data_item->user_role_in_estate
            );
    @endphp
    <li
            data-member-user-id="{{ $user_data_item->user_id }}"
            data-member-image="{{ $user_data_item->image_path }}"
            data-member-full-name="{{ $user_data_item->full_name }}"
            data-member-role-main="{{ $user_data_item->user_role_in_estate }}"
            class="message_member_li message_li_set" id="{{ $message_list_id }}">
            <span class="list-group-item list-group-item-action name member-id-item tablink"
            >
                  <div class="row">
                      <img src="{{ $user_data_item->image_path }}" class="rounded-circle mem-msg-pic" alt="">
                      <span class="msg-tab-name">{{ $user_data_item->full_name }}</span>
                      <span class="msg-member-role">{{ $user_data_item->user_role_in_estate }}</span>
                      <span class="mt-3"
                            id="message_count_1_{{ $user_data_item->user_id }}"></span>
                  </div>
                </span>
    </li>
@endforeach
        @foreach ($message_groups_data as $message_group_data_item)
     @php   $message_group_data_item = (object)$message_group_data_item ;
            $message_group_members = $message_obj->get_message_group_members($message_group_data_item->group_id);
            $message_list_id = "message_member_li_2_" . $message_group_data_item->group_id;
            $message_li_search_array[$message_list_id] = array(
                $message_group_data_item->group_name
            );
    @endphp
    <li
            data-group-id="{{ $message_group_data_item->group_id }}"
            class="message_group_li message_li_set"
            id="{{ $message_list_id }}"
    >
            <span class="list-group-item list-group-item-action name member-id-item tablink"
            >
                  <div class="row">
                      <div><span class="message-group-name">{{ $message_group_data_item->group_name }}</span><span
                                  style="float: right"
                                  data-toggle="tooltip" data-placement="top" title="Delete Group"
                                  class="message_group_delete"><i class="fa fa-trash" aria-hidden="true"></i></span><br>
                      @foreach ($message_group_members as $message_group_member)
                        @php  $data = array(
                              'user_id' => '',
                              'full_name' => '',
                              'image_path' => '',
                              'user_role_in_estate' => ''
                          );
                          @endphp
                          @if ($message_group_member->user_id == $userId) @php continue; @endphp
                          @endif
                          @if ($message_group_member->member_owner_user_id > 0 && $message_group_member->user_id != $message_group_member->member_owner_user_id)  {{--// is a member  get data of member object--}}
                             @php $data->full_name = $message_group_member->member_first_name . ' ' . $message_group_member->member_last_name;
                              $member = \App\Member::find($message_group_member->member_id);
                              $data->image_path = $member->get_member_image($member);
                        @endphp
                          @else  {{--// is a user account - get data of  user object--}}
                            @php  $data->user_id = $message_group_member->user_id;
                              //$profile_obj = new ProfileModel();
                              $profile = \App\Profile::where('profile_user_id',$message_group_member->user_id)->first();
                              //$profile = $profile_obj->get_profile_by_profile_user_id();
                              $data->full_name = $profile->profile_first_name . ' ' . $profile->profile_last_name;
                              $data->image_path = $profile->get_profile_image($profile);
                          @endphp
                          @endif



                          <span class="msg-member-role"><img style="width: 20px;height: 20px"
                                                             src="{{ $data->image_path }}"
                                                             class="mem-msg-pic-board group-message-member-img rounded-circle"
                              > {{ $data->full_name }}</span><br>
@endforeach
                      </div>
                      <span class="mt-3"
                            id="message_count_2_{{ $message_group_data_item->group_id }}"></span>
                  </div>
                </span>
    </li>

    @endforeach
</ul>
<script>
    var message_li_search_json = @php echo json_encode($message_li_search_array) @endphp

</script>
