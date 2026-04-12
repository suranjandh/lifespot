@php
use App\Role;
/*
$member = new MemberModel();
$pet_obj = new PetModel();
*/
@endphp
<style>
    .docCenter {
        color: rgb(193, 52, 46);
        font-weight: 400;
        font-size: 3.2rem;
    }

    .docCenter_line {
        background-color: rgb(193, 52, 46);
        padding: 0;
        margin: 0;
    }

    .docCenterMsg {
        color: black;
        font-weight: 700;
        font-size: 1.9rem;
    }

    .learningCenter {
        list-style: none;
        /* margin-left: 0; */
        padding-left: 5px;
    }

    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
        bottom: .5em;
    }

    table .th-sm {
        width: 3px !important;
        min-width: 3px !important;
    }

    .docTableFull a {
        margin-right: 0 !important;
    }

    .theDocList {
        list-style: none;
    }

    .tableTitle {
        font-weight: 700;
        color: black;
    }

</style>

<!--Modal: modalRelatedContent-->
<div class="modal fade xright" style="overflow: auto !important;"  id="modalDocCenterFullList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" data-backdrop="true">
    <div class="modal-dialog xmodal-side modal-bottom-left modal-notify modal-info modal-fluid xml-1 mr-2"
         role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <p class="heading">LifeSpot Document Center</p>
                <!-- <img src="../img/FAQs.jpg" alt=""> -->
                <button type="button" class="close mr-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">

                <div class="row">
                    <div class="col-7">
                        <span class="umentCenter">Document Center</span>
                        <hr class="docCenter_line">
                        <span class="docCenterMsg">What would you like to see?</span>
                        <p><i>Click the links below to see suggested documents for your estate.</i><br>
                            <a class="text-info ml-4 mr-4 document_list_trigger" id="all_docs"
                               data-type="" data-table-title="All Documents"
                            >Show All</a>
                            <a class="text-info mr-4 document_list_trigger"
                               data-type="missing_docs"  data-table-title="Missing Documents" >Show Missing</a>
                            <a class="text-info mr-4 document_list_trigger"
                               data-type="not_applicable_docs" data-table-title="N/A Documents" >Show N/A</a>
                            <a class="text-info mr-4 document_list_trigger"
                               data-type="no_data" data-table-title="Custom Documents"
                            >Add Custom List +</a>
                        </p>

                    </div>
                    <div class="col-2 xml-1 my-3">
                        <i class="far fa-folder-open fa-3x"></i>
                        <!-- <img src="../img/question.png" alt=""> -->
                    </div>
                    <div class="col-3"></div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <ul class="theDocList">
                            <li><a class="text-info document_list_trigger" data-toggle="collapse"
                                   data-type="estate_key_docs"
                                   data-table-title="Estate Key Legal Documents"   >Estate Key Legal Documents</a></li>
                            <li>
                                <a class="text-info document_list_trigger"
                                   data-type="no_data" data-toggle="collapse" href="#collapseKeyRoles"
                                   aria-expanded="false" aria-controls="collapseKeyRoles"
                                   data-table-title="Key Roles Documents"
                                >By Key Roles</a>
                                <div class="collapse" id="collapseKeyRoles">
                                    <ul class="theDocList">
                                        <li>
                                            @php
                                            $member_ids_set_for_roles = \App\Member::get_member_ids_set_for_roles(array(Role::get_role_executor(), Role::get_role_co_executor()));
                                            $members_set_for_roles = \App\Member::get_members_set_for_roles(array(Role::get_role_executor(), Role::get_role_co_executor()));
                                            @endphp
                                            <a class="text-info document_list_trigger" data-toggle="collapse"
                                               href="#collapseExecutor"
                                               aria-expanded="false" aria-controls="collapseExecutor"
                                               data-type="by_member_ids"
                                               data-member_ids="{{ $member_ids_set_for_roles }}"
                                               data-table-title="Executor / Co-Executor Documents"     >Executor /
                                                Co-Executor</a>
                                            <div class="collapse" id="collapseExecutor">
                                                <ul class="theDocList">
                                                    @foreach ($members_set_for_roles as $member)
                                                        <li><a class="text-info document_list_trigger"
                                                               data-table-title="{{ $member->get_member_full_name($member) }} Documents"
                                                               data-toggle="collapse"
                                                               data-type="by_member_ids"
                                                               data-member_ids="{{ $member->member_id }}"
                                                               aria-expanded="false"
                                                               aria-controls="executorID_1">{{ $member->get_member_full_name($member) }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            @php
                                            $member_ids_set_for_roles = \App\Member::get_member_ids_set_for_roles(array(Role::get_role_trustee(), Role::get_role_co_trustee()));
                                            $members_set_for_roles = \App\Member::get_members_set_for_roles(array(Role::get_role_trustee(), Role::get_role_co_trustee()));
                                            @endphp
                                            <a class="text-info document_list_trigger" data-toggle="collapse" href="#collapseTrustee"
                                               aria-expanded="false" aria-controls="collapseTrustee"
                                               data-type="by_member_ids"
                                               data-member_ids="{{ $member_ids_set_for_roles }}"
                                               data-table-title="Trustee / Co-Trustee Documents"
                                            >Trustee /
                                                Co-Trustee</a>
                                            <div class="collapse" id="collapseTrustee">
                                                <ul class="theDocList">
                                                    @foreach ($members_set_for_roles as $member)
                                                        <li><a class="text-info document_list_trigger"
                                                               data-table-title="{{ $member->get_member_full_name($member) }} Documents"
                                                               data-toggle="collapse"
                                                               data-type="by_member_ids"
                                                               data-member_ids="{{ $member->member_id }}"
                                                               aria-expanded="false"
                                                               aria-controls="executorID_1">{{ $member->get_member_full_name($member) }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            @php
                                            $member_ids_set_for_roles = \App\Member::get_member_ids_set_for_roles(array(Role::get_role_successors_trustee()));
                                            $members_set_for_roles = \App\Member::get_members_set_for_roles(array(Role::get_role_successors_trustee()));
                                            @endphp
                                            <a class="text-info document_list_trigger" data-toggle="collapse" href="#collapseSuccessorTrustee"
                                               aria-expanded="false" aria-controls="collapseSuccessorTrustee"
                                               data-type="by_member_ids"
                                               data-member_ids="{{ $member_ids_set_for_roles }}"
                                               data-table-title="Successor's Trustee Documents"
                                            >Successor's
                                                Trustee</a>
                                            <div class="collapse" id="collapseSuccessorTrustee">
                                                <ul class="theDocList">
                                                    @foreach ($members_set_for_roles as $member)
                                                        <li><a class="text-info document_list_trigger"
                                                               data-table-title="{{ $member->get_member_full_name($member) }} Documents"
                                                               data-toggle="collapse"
                                                               data-type="by_member_ids"
                                                               data-member_ids="{{ $member->member_id }}"
                                                               aria-expanded="false"
                                                               aria-controls="executorID_1">{{ $member->get_member_full_name($member) }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            @php
                                            $member_ids_set_for_roles = \App\Member::get_member_ids_set_for_roles(array(Role::get_role_guardian()));
                                            $members_set_for_roles = \App\Member::get_members_set_for_roles(array(Role::get_role_guardian()));
                                            @endphp
                                            <a class="text-info document_list_trigger" data-toggle="collapse" href="#collapseGuardian"
                                               aria-expanded="false" aria-controls="collapseGuardian"
                                               data-type="by_member_ids"
                                               data-member_ids="{{ $member_ids_set_for_roles }}"
                                               data-table-title="Legal Guardian(s) Documents"
                                            >Legal
                                                Guardian(s)</a>
                                            <div class="collapse" id="collapseGuardian">
                                                <ul class="theDocList">
                                                    @foreach ($members_set_for_roles as $member)
                                                        <li><a class="text-info document_list_trigger"
                                                               data-table-title="{{ $member->get_member_full_name($member) }} Documents"
                                                               data-toggle="collapse"
                                                               data-type="by_member_ids"
                                                               data-member_ids="{{ $member->member_id }}"
                                                               aria-expanded="false"
                                                               aria-controls="executorID_1">{{ $member->get_member_full_name($member) }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- <li>
                                          <a class="text-info" data-toggle="collapse" href="#collapseBeneficiary" aria-expanded="false" aria-controls="collapseBeneficiary">Beneficiary</a>
                                          <div class="collapse" id="collapseBeneficiary">
                                            <ul  class="theDocList">
                                              <li><a class="text-info" href="#">Person One</a></li>
                                              <li><a class="text-info" href="#">Person Two</a></li>
                                              <li><a class="text-info" href="#">Person Three</a></li>
                                            </ul>
                                          </div>
                                        </li> -->
                                    </ul>
                                </div>
                            </li>
                            <li><a class="text-info document_list_trigger"
                                   data-type="no_data" data-table-title="Tax Documents"
                                >Tax Related</a></li>
                            <li><a class="text-info document_list_trigger"
                                   data-type="no_data" data-table-title="Medical Documents"
                                >Medical</a></li>
                            <li><a class="text-info document_list_trigger"
                                   data-type="no_data" data-table-title="Financial Documents"
                                >Financial Accounts</a></li>
                            <li><a class="text-info document_list_trigger"
                                   data-type="no_data" data-table-title="Real Estate Documents"
                                >Real Estate</a></li>
                            <li><a class="text-info document_list_trigger"
                                   data-type="no_data" data-table-title="Banking Documents"
                                >Banking</a></li>
                            <li><a class="text-info document_list_trigger"
                                   data-type="no_data" data-table-title="Retiremen Documents"
                                >Retirement</a></li>
                            <!-- <li><a class="text-info"  data-toggle="collapse" href="#showMissingDocsTable" aria-expanded="false" aria-controls="showMissingDocsTable">Show All Missing </a></li> -->
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="theDocList">
                            <li>
                                @php
                                $member_ids_set_for_roles = \App\Member::get_member_ids_set_for_roles(array(Role::get_role_trustee(),Role::get_role_co_trustee()));
                                $members_set_for_roles = \App\Member::get_members_set_for_roles(array(Role::get_role_trustee(),Role::get_role_co_trustee()));
                                @endphp
                                <a  class="text-info document_list_trigger"
                                        data-type="by_member_ids"
                                        data-member_ids="{{ $member_ids_set_for_roles}}"
                                        data-toggle="collapse" href="#collapseTrust"
                                        aria-expanded="false" aria-controls="collapseTrust"
                                        data-table-title="Trust Documents">Trust</a>
                                <div class="collapse" id="collapseTrust">
                                    <ul class="theDocList">
                                        @foreach ($members_set_for_roles as $member)
                                            <li><a class="text-info document_list_trigger"
                                                   data-table-title="{{ $member->get_member_full_name($member) }} Documents"
                                                   data-toggle="collapse"
                                                   data-type="by_member_ids"
                                                   data-member_ids="{{ $member->member_id }}"
                                                   aria-expanded="false"
                                                   aria-controls="executorID_1">{{ $member->get_member_full_name($member) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li><a class="text-info document_list_trigger" data-type="profile_docs">About Me</a></li>
                            <li>
                                @php
                                $member_ids_set_for_roles = \App\Member::get_member_ids_set_for_roles(array(Role::get_role_emergency_contact()));
                                $members_set_for_roles = \App\Member::get_members_set_for_roles(array(Role::get_role_emergency_contact()));
                                @endphp
                                <a class="text-info document_list_trigger"
                                   data-type="by_member_ids"
                                   data-member_ids="{{ $member_ids_set_for_roles}}"
                                   data-toggle="collapse" href="#collapseERContacts"
                                   aria-expanded="false" aria-controls="collapseERContacts"
                                   data-table-title="Emergency Contacts Documents"
                                >Emergency Contacts</a>
                                <div class="collapse" id="collapseERContacts">
                                    <ul class="theDocList">
                                        @foreach ($members_set_for_roles as $member)
                                            <li><a class="text-info document_list_trigger"
                                                   data-table-title="{{ $member->get_member_full_name($member) }} Documents"
                                                   data-toggle="collapse"
                                                   data-type="by_member_ids"
                                                   data-member_ids="{{ $member->member_id }}"
                                                   aria-expanded="false"
                                                   aria-controls="executorID_1">{{ $member->get_member_full_name($member) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li><a class="text-info document_list_trigger"
                                data-type="spouse_docs">Spouse Related</a></li>
                            <li>
                                @php
                                $members_set = auth()->user()->dependents ;// $member->get_dependents_by_user_id($member->user_id);
                                @endphp
                                <a class="text-info document_list_trigger" data-type="dependent_docs" data-toggle="collapse" href="#collapseDependent"
                                   aria-expanded="false" aria-controls="collapseDependent"
                                   data-table-title="Dependents Documents"

                                >By Dependent</a>
                                <div class="collapse" id="collapseDependent">
                                    <ul class="theDocList">
                                        @foreach ($members_set as $member)
                                            <li><a class="text-info document_list_trigger"
                                                   data-table-title="{{ $member->get_member_full_name($member) }} Documents"
                                                   data-toggle="collapse"
                                                   data-type="by_member_ids"
                                                   data-member_ids="{{ $member->member_id }}"
                                                   aria-expanded="false"
                                                   aria-controls="executorID_1">{{ $member->get_member_full_name($member) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li>
                                @php
                                $member_ids_set_for_roles = \App\Member::get_member_ids_set_for_roles(array(Role::get_role_emergency_contact()));
                                $members_set_for_roles = \App\Member::get_members_set_for_roles(array(Role::get_role_emergency_contact()));
                                @endphp
                                <a class="text-info document_list_trigger" data-toggle="collapse" href="#collapseBeneficiary"
                                   data-type="by_member_ids"
                                   data-member_ids="{{ $member_ids_set_for_roles }}"
                                   aria-expanded="false" aria-controls="collapseBeneficiary"
                                   data-table-title="Beneficiary Documents"
                                >By Beneficiary</a>
                                <div class="collapse" id="collapseBeneficiary">
                                    <ul class="theDocList">
                                        @foreach ($members_set_for_roles as $member)
                                            <li><a class="text-info document_list_trigger"
                                                   data-table-title="{{ $member->get_member_full_name($member) }} Documents"
                                                   data-toggle="collapse"
                                                   data-type="by_member_ids"
                                                   data-member_ids="{{ $member->member_id }}"
                                                   aria-expanded="false"
                                                   aria-controls="executorID_1">{{ $member->get_member_full_name($member) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li>
                                @php
                                $pets = auth()->user()->pets ;// $pet_obj->get_pets_by_owner_user_id($pet_obj->user_id);
                                $pet_ids_set = array();
                                foreach ($pets as $pet){
                                    $pet_ids_set[] = $pet->pet_id;
                                }
                                @endphp
                                <a class="text-info document_list_trigger" data-toggle="collapse" href="#collapsePet" aria-expanded="false"
                                   data-type="by_pet_ids"
                                   data-member_ids="{{ implode(',',$pet_ids_set) }}"
                                   aria-controls="collapsePet"
                                   data-table-title="Pet Documents"
                                >By Pet</a>
                                <div class="collapse" id="collapsePet">
                                    <ul class="theDocList">
                                        @if($pet_ids_set)
                                            @foreach ($pets as $pet)
                                            <li><a class="text-info document_list_trigger"
                                                   data-table-title="{{ $pet->pet_name }} Documents"
                                                   data-toggle="collapse"
                                                   data-type="by_pet_ids"
                                                   data-member_ids="{{ $pet->pet_id }}"
                                                   aria-expanded="false"
                                                   aria-controls="executorID_1">{{ $pet->pet_name }}</a>
                                            </li>
                                            @endforeach
                                        @else
                                            No pets added yet
                                        @endif
                                    </ul>
                                </div>
                            </li>
                            <li><a class="text-info">Personal Messages</a></li>
                            <!-- <li><a class="text-info">Show All N/A</a></li> -->
                        </ul>
                    </div>
                    <div class="col-3">
                        <ul class="theDocList">
                            <li><a class="text-info document_list_trigger" data-type="no_data">Income/Assets</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">Financial Obligations</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">Military</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">Education</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">Volunteer</a></li>
                            <li>
                                @php $members_set = auth()->user()->members ; // $member->get_members_by_owner_user_id($member->user_id);
                                $member_ids_set = array();
                                foreach ($members_set as $member){
                                    $member_ids_set[] = $member->member_id;
                                }
                                @endphp
                                <a class="text-info" data-toggle="collapse" href="#collapseMember" aria-expanded="false"
                                   aria-controls="collapseMember"
                                   data-table-title="Members Documents"
                                   data-type="by_member_ids"
                                   data-member_ids="{{ implode(',',$member_ids_set) }}"
                                >By Member</a>
                                <div class="collapse" id="collapseMember">
                                    <ul class="theDocList">
                                        @foreach ($members_set as $member)
                                            <li><a class="text-info document_list_trigger"
                                                   data-table-title="{{ $member->get_member_full_name($member) }} Documents"
                                                   data-toggle="collapse"
                                                   data-type="by_member_ids"
                                                   data-member_ids="{{ $member->member_id }}"
                                                   aria-expanded="false"
                                                   aria-controls="executorID_1">{{ $member->get_member_full_name($member) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">My Arrangements</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">Foundation</a></li>
                        </ul>
                    </div>

                    <div class="col-3">
                        <ul class="theDocList">
                            <li><a class="text-info document_list_trigger" data-type="no_data">Custom List</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">Secret Recipes</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">Family Secrets</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">My Private Knowledge Vault</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">My Memoirs</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">Songs I Wrote</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">Family Emergency Plans</a></li>
                            <li><a class="text-info document_list_trigger" data-type="no_data">More...</a></li>
                        </ul>
                    </div>

                </div>

                <br>
                <!--Accordion wrapper-->
                <div class="accordion md-accordion" id="documentFullListContainer" role="tablist"
                     aria-multiselectable="true">
                    <!-- ======== ALL Docs Table ========== -->
                    <!-- ajax loaded -->
                    @php
                    //  include 'document-FullListTable.php';
                    @endphp

                    <!-- ======END OF TABLE Collapse Views============ -->
                </div>


                <!-- END Accordian Wrapper -->


<!--                <small class="text-muted">*Check box if this document is not applicaple to your estate</small>
-->

            </div>
        </div>
        <!--/.Content-->
    </div>
</div>


<!--Modal: modalRelatedContent-->



<!-- ================ -->

<!-- ================= -->