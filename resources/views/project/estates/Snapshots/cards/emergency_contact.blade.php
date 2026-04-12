@php

    $emergency_contacts = auth()->user()->emergency_contacts ; // $member->get_emergency_contacts_by_owner_user_id($userId);

@endphp
<div class="card border-danger mb-3" xstyle="max-width: 20rem;">
    <div class="card-header">My Emergency Contacts
        <!--<a href="#"><img class="float-right xmr-3" data-toggle="tooltip" title="Share" src="../img/icons8-share.png"
                         alt=""></a>-->
        <a href="#"
           onclick="window.open('{{ route('print_snapshot') }}?print=emergency_contact');"
        ><img class="float-right mr-3" data-toggle="tooltip" title="Print"
              src="{{ Config::get('PROJECT_IMG_URL') }}icons8-print.png"
              alt=""></a>
        <!--<a href="#"><img class="float-right mr-3" data-toggle="tooltip" title="Add New"
                         src="../img/icons8-plus_math.png" alt=""></a>-->
    </div>
    <br>
    <div class="card-body member-box text-primary xmt-0 pt-0">

        @if (count($emergency_contacts) > 0)
            @php $members_in_estate = $emergency_contacts @endphp
            @include ('project.estates.Snapshots.cards.estate_members')
        @else
            <br><br>No Emergency Contacts Listed
        @endif
    </div>
</div>

<!-- card-body -->
