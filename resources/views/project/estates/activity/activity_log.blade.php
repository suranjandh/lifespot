{{--<table id="dtRecentActivity" class="table table-striped table-bordered table-sm" cellspacing="0"
       width="100%" ordering="true">
    <thead>
    <tr>
        <th class="th-sm">Date of Activity
            <i class="fa fa-sort float-right" aria-hidden="true"></i>
        </th>
        <th class="th-sm">Description of Activity
            <i class="fa fa-sort float-right" aria-hidden="true"></i>
        </th>
    </tr>
    </thead>
    <tbody>


    </tbody>
</table>--}}
<table id="dtRecentActivity" class="table table-striped table-bordered table-sm"
       cellspacing="0" width="100%">
    <span class="tableTitle">Activity List</span>
    <thead>
    <tr>
        <th class="th-sm">Date of Activity
            <i class="fa fa-sort float-right" aria-hidden="true"></i>
        </th>
        <th class="th-sm">Description of Activity
            <i class="fa fa-sort float-right" aria-hidden="true"></i>
        </th>
    </tr>
    </thead>
    <tbody>
    @php
    $user = auth()->user() ;
    @endphp
    <tr class="document_tr">
                <td>{{date('F d, Y h:i a' ,strtotime($user->created_at))}}</td>
    <td>{{$user->first_name}} Created User</td>
    </tr>

    <tr class="document_tr">
        <td>{{date('F d, Y h:i a' ,strtotime($user->created_at))}}</td>
        <td>{{$user->first_name}} Created Estate</td>
    </tr>

    <tr class="document_tr">
        <td>{{date('F d, Y h:i a' ,strtotime($user->created_at))}}</td>
        <td>{{$user->first_name}} Created Profile</td>
    </tr>

    @if($activities)
        @foreach($activities as $activity)
            <tr class="document_tr">
                <td>{{date('F d, Y h:i a' ,strtotime($activity->created_at))}}</td>
                @php
                    $properties = json_decode($activity->properties);
                @endphp
                <td>{{\App\User::find($activity->causer_id)->first_name}} {{$activity->description}} {{isset($properties->attributes->action_on) ? $properties->attributes->action_on : ''}} {{isset($properties->attributes->name) ? $properties->attributes->name:''}}</td>
            </tr>
        @endforeach
    @else
        <td colspan="2">No activities found</td>
    @endif
    </tbody>


</table>