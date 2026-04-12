@php

    $beneficiaries =  auth()->user()->beneficiaries ;// $member->get_beneficiary_by_owner_user_id($userId);

@endphp
<div class="card border-primary mb-3" xstyle="max-width: 20rem;">
    <div class="card-header">My Beneficiaries
        <!--<a href="#"><img class="float-right xmr-3" data-toggle="tooltip" title="Share" src="../img/icons8-share.png"
                         alt=""></a>-->
        <a href="#"
           onclick="window.open('{{ route('print_snapshot')}}?print=beneficiary');"
        ><img class="float-right mr-3" data-toggle="tooltip" title="Print"
              src="{{Config::get('constants.PROJECT_IMAGE_URL')}}icons8-print.png"
              alt=""></a>
        <!--<a href="#"><img class="float-right mr-3" data-toggle="tooltip" title="Add New"
                         src="../img/icons8-plus_math.png" alt=""></a>-->
    </div>
    <br>
    <div class="card-body member-box text-primary xmt-0 pt-0">

        @if ($beneficiaries && count($beneficiaries) > 0)
            @php   $members_in_estate = $beneficiaries; @endphp
            @include ('project.estates.Snapshots.cards.estate_members');
        @else
            <br><br>No Beneficiaries Listed
        @endif
    </div>
</div>

<!-- card-body -->
