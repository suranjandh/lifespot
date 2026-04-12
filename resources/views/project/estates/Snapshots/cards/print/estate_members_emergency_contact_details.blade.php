<tr>
    <th colspan="2">{!! Helper::fill_empty_string($member->get_member_full_name($member)) !!}</th>
</tr>
<tr>
    <td>Roles :</td>
    <td>{!! Helper::fill_empty_string($member->get_member_role_names_string($member)) !!}</td>
</tr>
<tr>
    <td>Email:</td>
    <td>{!! Helper::fill_empty_string($member->member_email) !!}</td>
</tr>
<tr>
    <td>Phone:</td>
    <td>{!! Helper::fill_empty_string($member->member_phone, 'phone') !!}</td>
</tr>
<tr>
    <td>Notes:</td>
    <td>{!! Helper::fill_empty_string($member->member_spacial_notes) !!}</td>
</tr>
<tr>
    <td colspan="2"><br></td>
</tr>