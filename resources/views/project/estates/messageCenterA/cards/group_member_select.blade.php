<option value="0" disabled>Group Text ~ Build Groups</option>
@foreach ($message_enabled_users as $user)
    @php $user = (object)$user ; @endphp
    <option value="{{$user->user_id}}">{{$user->full_name}}</option>
@endforeach