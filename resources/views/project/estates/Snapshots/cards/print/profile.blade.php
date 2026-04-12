@include('project.estates.Snapshots.cards.print.styles')
@php
// $profile = new ProfileModel();
// $member = new MemberModel();
// $estate = new EstateModel();
$estate = auth()->user()->estate ; // $estate->get_estate_by_estate_user_id($userId);
$profile = auth()->user()->profile ; // $profile->get_profile_by_profile_user_id($userId);
$members_in_profile = auth()->user()->members ; // $member->get_members_by_owner_user_id($userId);
// $display_print = isset($print_content) && $print_content ? '' : 'display:none;';
@endphp
<table id="table_pdf">
    <tr>
        <th colspan="2">Co-Trustees & Estate Owner(s): {!! Helper::fill_empty_string($profile->get_profile_full_name($profile)) !!}</th>
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
        <td>{!! Helper::fill_empty_string($profile->profile_email) !!}</td>
    </tr>
    <tr>
        <td>Phone:</td>
        <td>{!! Helper::fill_empty_string($profile->profile_phone, 'phone') !!} &nbsp;
            &nbsp;     @if (trim($profile->profile_phone2) != '')
            {!! Helper::fill_empty_string($profile->profile_phone2, 'phone') !!}@endif</td>
    </tr>
    <tr>
        <td>About:</td>
        <td>Birthday {!! Helper::fill_empty_string($profile->get_profile_birthday($profile), 'date')!!}
            <br>{!! Helper::fill_empty_string(Helper::get_marital_status_name($profile->profile_maritalStatus)) !!}
            <br>{!! Helper::fill_empty_string($profile->profile_dependents, 'number') !!} Dependents &nbsp;
            <br>No Pets</td>
    </tr>
    <tr>
        <td>Notes:</td>
        <td>{!! Helper::fill_empty_string($profile->profile_profile_notes); !!}</td>
    </tr>
</table>
