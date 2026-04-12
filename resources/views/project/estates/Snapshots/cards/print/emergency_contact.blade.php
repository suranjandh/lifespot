@include('project.estates.Snapshots.cards.print.styles')
@php

    // $member = new MemberModel();
    $emergency_contacts = auth()->user()->emergency_contacts ; // $member->get_emergency_contacts_by_owner_user_id($userId);

@endphp
<h4>Emergency Contacts</h4>
@if($emergency_contacts && count($emergency_contacts)> 0)
    @php  $members_in_estate =   $emergency_contacts ; @endphp
    @include('project.estates.Snapshots.cards.print.estate_members')
@else
    <br><br>No Emergency Contacts Listed
@endif