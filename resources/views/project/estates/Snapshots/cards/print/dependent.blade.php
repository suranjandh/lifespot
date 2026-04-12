@include('project.estates.Snapshots.cards.print.styles')
@php
    $id = \Illuminate\Support\Facades\Input::get('id');
    // $member = new MemberModel();
    // $dependent_medical = new DependentMedicalModel();
    // $dependent_school = new DependentSchoolModel();
    // $guardian_member = new GuardianMemberModel();
    $dependent = \App\Member::find($id); ; // $member->get_member_by_id($_GET->member_id);
@endphp
@if ($dependent)
    <table id="table_pdf" class="table_members">


        <tr>
            <th>Dependent :</th>
            <th>{!! $member->get_member_full_name($dependent) !!}</th>
        </tr>
        <tr>
            <td>Roles :</td>
            <td>{!! Helper::fill_empty_string($member->get_member_role_names_string($dependent)) !!}</td>
        </tr>
        <tr>
            <td>Address:</td>
            <td>{!! Helper::fill_empty_string($member->get_member_address($dependent)) !!}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{!! Helper::fill_empty_string($dependent->member_email) !!}</td>
        </tr>
        <tr>
            <td>Phone:</td>
            <td>{!! Helper::fill_empty_string($dependent->member_phone, 'phone') !!}</td>
        </tr>
        @if (trim($dependent->member_phone2) != '')
            <tr>
                <td>Phone:</td>
                <td>{!! Helper::fill_empty_string($dependent->member_phone2, 'phone') !!}</td>
            </tr>
        @endif
        <tr>
            <td>Birthday:</td>
            <td>{!! Helper::fill_empty_string($member->get_member_birth_day($dependent), 'date') !!}</td>
        </tr>
        <tr>
            <td>Notes:</td>
            <td>{!! Helper::fill_empty_string($dependent->member_spacial_notes) !!}</td>
        </tr>

        @php
            $dependent_medical = $dependent->dependent_medical ;
             $dependent_medical_primary_doctor = $dependent_medical ? $dependent_medical->dependent_medical_primary_care : '';
             $dependent_medical_phone = $dependent_medical ? $dependent_medical->dependent_medical_phone : '';

             $guardian_member = $dependent->guardian;

            $guardian_member_full_name = $guardian_member ? $dependent->get_member_full_name($guardian_member) : '';
            $guardian_member_phone = $guardian_member ? $guardian_member->member_phone : '';

             $dependent_school = $dependent->dependent_school;
             $dependent_school_phone = $dependent_school ? $dependent_school->dependent_school_phone : '';
             $dependent_school_name = $dependent_school ? $dependent_school->dependent_school_name : '';

        @endphp
        <tr>
            <td>Medical:</td>
            <td>Primary Doctor: {!! Helper::fill_empty_string($dependent_medical_primary_doctor) !!}<br>
                Phone: {!! Helper::fill_empty_string($dependent_medical_phone, 'phone') !!}</td>
        </tr>
        <tr>
            <td>Guardian:</td>
            <td>Name: {!! Helper::fill_empty_string($guardian_member_full_name) !!}<br>
                Phone: {!! Helper::fill_empty_string($guardian_member_phone, 'phone') !!}</td>
        </tr>
        <tr>
            <td>School:</td>
            <td>Name: {!! Helper::fill_empty_string($dependent_school_name) !!}<br>
                Phone: {!! Helper::fill_empty_string($dependent_school_phone, 'phone') !!}</td>
        </tr>
        <tr>
            <td colspan="2"><br></td>

        </tr>


    </table>
@endif