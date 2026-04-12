@include('project.estates.Snapshots.cards.print.styles')
<table id="table_pdf" class="table_members">
    @foreach ($members_in_estate as $k => $member)
       @php
           $member_type = $member->member_type($member);
        @endphp
        @if($member_type == 'beneficiary')
            @include('project.estates.Snapshots.cards.print.estate_members_beneficiary_details')
        @elseif($member_type == 'emergency_contact')
            @include('project.estates.Snapshots.cards.print.estate_members_emergency_contact_details')
        @else
            @include('project.estates.Snapshots.cards.print.estate_members_member_details')
        @endif
    @endforeach
</table>