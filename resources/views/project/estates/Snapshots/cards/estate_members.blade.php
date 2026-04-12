<style>
    .estate_member_table {
        width: 630px;
    }

    .estate_member_table tr {
        width: 630px;
    }

    .estate_member_table tr td:first-of-type {
        width: 50px;
    }

    .estate_member_table tr td:last-of-type {
        width: 150px;
    }
</style>
@foreach ($members_in_estate as $k => $member)
    @php
        $member_type = $member->member_type($member);
        $address = $member->get_member_address($member) ;
        $data_document_category = 1;
        $data_document_category_sub = 2;
        $data_document_category_sub_sub = 0;
        $data_document_category_sub_sub_sub = 0;
    @endphp

    @if ($member_type == 'spouse')
        @php
            $address = $estate->get_estate_location($estate);
            $data_document_category = 2;
            $data_document_category_sub = 4;
            $data_document_category_sub_sub = 0;
            $data_document_category_sub_sub_sub = 0;
        @endphp
    @elseif ($member_type == 'dependent')
        @php
            $data_document_category = 2;
            $data_document_category_sub = 5;
            $data_document_category_sub_sub = $member->member_id;
            $data_document_category_sub_sub_sub = 1;

        @endphp


    @elseif ($member_type == 'beneficiary')
        @php
            $data_document_category = 2;
            $data_document_category_sub = 6;
            $data_document_category_sub_sub = $member->member_id;
            $data_document_category_sub_sub_sub = 1;
        @endphp


        @elseif ($member_type == 'emergency_contact')
        @php
            $data_document_category = 1;
            $data_document_category_sub = 3;
            $data_document_category_sub_sub = $member->member_id;
            $data_document_category_sub_sub_sub = 1;

        @endphp

    @elseif ($member_type == 'member')
        @php
            $data_document_category = 7;
            $data_document_category_sub = 25;
            $data_document_category_sub_sub = $member->member_id;
            $data_document_category_sub_sub_sub = 0;
        @endphp

    @endif
    @php
        $rand = rand(1,50000);
    @endphp
    <h6 class="card-title member-title mb-2">
                              <span class="expander" data-toggle="collapse" href="#member{{$rand}}{{ $k }}"
                                    aria-expanded="false"
                                    aria-controls="member1">
                                  <span class="memName"
                                        style="width: 200px">{!! Helper::fill_empty_string($member->get_member_full_name($member))!!}</span>
                                  <span class="member_info memInfoStyle"
                                        style="width: 300px">{!! Helper::fill_empty_string($member->get_member_role_names_string($member)) !!}</span>
                              </span>
    </h6>
    <!-- class="collapse" id="member1" -->
    <div class="collapse" id="member{{$rand}}{{ $k }}" style="margin-left: 30px">
        <table class="estate_member_table">

            @if($member_type == 'beneficiary')
                @include ('project.estates.Snapshots.cards.estate_members_beneficiary_details')
            @elseif($member_type == 'emergency_contact')
                @include ('project.estates.Snapshots.cards.estate_members_emergency_contact_details')
            @else
                @include ('project.estates.Snapshots.cards.estate_members_member_details')

            @endif

        </table>


        <br>
    </div>
@endforeach
