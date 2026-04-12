@include('project.estates.Snapshots.cards.print.styles')
<table id="table_pdf" class="table_members">
    @php
   // $member_id = $_GET->member_id;
       $id = \Illuminate\Support\Facades\Input::get('id');

  //  $member = new MemberModel();
    $member =  \App\Member::find($id);// $member->get_member_by_id($member_id);
    @endphp

    <tr>
        <th colspan="2">Member : {!! Helper::fill_empty_string($member->get_member_full_name($member)); !!}</th>
    </tr>
    <tr>
        <td>Roles :</td>
        <td>{!! Helper::fill_empty_string($member->get_member_role_names_string($member)) !!}</td>
    </tr>
    <tr>
        <td>Address:</td>
        <td>{!! Helper::fill_empty_string($member->get_member_address($member)) !!}</td>
    </tr>
    <tr>
        <td>Email:</td>
        <td>{!! Helper::fill_empty_string($member->member_email) !!}</td>
    </tr>
    <tr>
        <td>Phone:</td>
        <td>{!! Helper::fill_empty_string($member->member_phone, 'phone') !!}</td>
    </tr>
    @php if (trim($member->member_phone2) != '') { @endphp
        <tr>
            <td>Phone:</td>
            <td>{!! Helper::fill_empty_string($member->member_phone2, 'phone') !!}</td>
        </tr>
    @php } @endphp
    <tr>
        <td>Birthday:</td>
        <td>{!! Helper::fill_empty_string($member->get_member_birth_day($member), 'date') !!}</td>
    </tr>
    <tr>
        <td>Notes:</td>
        <td>{!! Helper::fill_empty_string($member->member_spacial_notes) !!}</td>
    </tr>
    <tr>
        <td colspan="2"><br></td>

    </tr>


</table>