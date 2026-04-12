@include('project.estates.Snapshots.cards.print.styles')
@php

    // $member = new MemberModel();
    $beneficiaries =  auth()->user()->beneficiaries  // $member->get_beneficiary_by_owner_user_id($userId);

@endphp
<h4>Beneficiaries</h4>
@if($beneficiaries && count($beneficiaries)> 0)
    @php   $members_in_estate =   $beneficiaries  @endphp
    @include('project.estates.Snapshots.cards.print.estate_members')
@else
    <br><br>No Emergency Contacts Listed
@endif