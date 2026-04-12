@include('project.estates.Snapshots.cards.print.styles')
@php


// $estate = new EstateModel();
// $member = new MemberModel();
$estate =  auth()->user()->estate ; // $estate->get_estate_by_estate_user_id($userId);
$members_in_estate =  auth()->user()->members ;// $member->get_members_by_owner_user_id($userId);

@endphp
<table id="table_pdf">
    <tr>
        <th colspan="2">{!!$estate->get_estate_name($estate)!!}</th>
    </tr>
    <tr>
        <td>Co-Trustees & Estate Owner(s):</td><td>{!!$estate->estate_owner_name!!}</td>
    </tr>
    <tr>
        <td>Location:</td><td>{!!Helper::fill_empty_string($estate->get_estate_location($estate))!!}</td>
    </tr>
    <tr>
        <td>Notes:</td><td>{!!Helper::fill_empty_string($estate->estate_notes)!!}</td>
    </tr>
</table>
<br><br>
<h4>Members of My Estate</h4>
{{--
@php include 'estate_members.php'@endphp
--}}
@include('project.estates.Snapshots.cards.print.estate_members')
