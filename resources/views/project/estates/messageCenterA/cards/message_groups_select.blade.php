<option value="" disabled selected>My Groups</option>
@foreach ($message_groups as $message_group)
    <option value="{{$message_group->message_group_id}}">{{$message_group->message_group_name}}</option>
@endforeach
