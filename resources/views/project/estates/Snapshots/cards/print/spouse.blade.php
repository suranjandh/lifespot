@include('project.estates.Snapshots.cards.print.styles')
@php

// $profile = new ProfileModel();
if (!(\App\Profile::is_married())) {
    die();
}
// $member = new MemberModel();
$spouse = auth()->user()->spouse ;// $member->find_spouse($userId);
// $estate = new EstateModel();
$estate =  auth()->user()->estate ; // $estate->get_estate_by_estate_user_id($userId);
@endphp
<table id="table_pdf">
    <tr>
        <th colspan="2">My Spouse : {!! Helper::fill_empty_string($member->get_member_full_name($spouse)); !!}</th>
    </tr>
    @php
    $estate_address = $estate->get_estate_location($estate);
    @endphp
    <tr>
        <td>Address:</td>
        <td>{!! Helper::fill_empty_string($estate_address) !!}</td>
    </tr>
    <tr>
        <td>Email:</td>
        <td>{!! Helper::fill_empty_string($spouse->member_email) !!}</td>
    </tr>
    <tr>
        <td>Phone:</td>
        <td>{!! Helper::fill_empty_string($spouse->member_phone, 'phone') !!}
            &nbsp; &nbsp; @if (trim($spouse->member_phone2) != '') 
                {!! Helper::fill_empty_string($spouse->member_phone2, 'phone') !!} @endif </td>
    </tr>
    <tr>
        <td>About:</td>
        <td>Birthday {!! Helper::fill_empty_string($member->get_member_birth_day($spouse), 'date') !!}</td>
    </tr>
    <tr>
        <td>Notes:</td>
        <td>{!! Helper::fill_empty_string($spouse->member_spacial_notes) !!}</td>
    </tr>
</table>
