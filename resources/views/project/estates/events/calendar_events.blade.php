{{--<table id="dtEventCalendar" class="table table-striped table-bordered table-sm" cellspacing="0"
       width="100%"
       ordering="true">
    <thead>
    <tr>
        <th class="th-sm">Event date
            <i class="fa fa-sort float-right" aria-hidden="true"></i>
        </th>
        <th class="th-sm">Description of Event
            <i class="fa fa-sort float-right" aria-hidden="true"></i>
        </th>
    </tr>
    </thead>
    <tbody id="dtEventCalendarTbody">
    </tbody>
</table>--}}
<table id="dtEventCalendar" class="table table-striped table-bordered table-sm"
       cellspacing="0" width="100%">
    <thead>
    <tr>
        <th class="th-sm">Event date
            <i class="fa fa-sort float-right" aria-hidden="true"></i>
        </th>
        <th class="th-sm">Description of Event
            <i class="fa fa-sort float-right" aria-hidden="true"></i>
        </th>
    </tr>
    </thead>
    <tbody>
    @if($calendar_events)
        @foreach($calendar_events as $calendar_event)
            <tr class="document_tr">
                <td>{{$calendar_event['date']}}</td>
                <td>{{$calendar_event['message']}}</td>
                @endforeach
                @else
                    <td colspan="2">No events found</td>
            @endif
    </tbody>


</table>