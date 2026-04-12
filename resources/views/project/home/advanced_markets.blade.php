@extends('layouts.estate_app')
@section('content')
    <style>
        .pt-3-half {
            padding-top: 1.4rem;
        }

        .table_header {
            font-weight: 700;
            font-size: 1.2rem;
        }
    </style>
    <button type="button"><a href="{{url('/home')}}">Back</a></button>
    <!-- Advandce Markets table -->
    <div class="card container">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Financial Solace</h3>
        <mark class="mx-5 gray-text pt-2">Finances are the last thing you want to worry about when grieving the loss of
            a loved
            one. Yet money can often become a great source of stress and anxiety. During this time
            of healing, LifeSpot would like to help in any way we can. Here is a checklist
            with six steps you and your financial professional can take to help lighten that burden
            during this emotional time. Check off each item as they are completed.
        </mark>
        <div class="card-body">

            <div>
                <!-- <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i class="fa fa-plus fa-2x"
                      aria-hidden="true"></i></a></span> -->
                <!-- Table  -->
                <table class="table table-bordered">
                    <!-- Table head -->
                    <thead>
                    <tr>
                        <p class="table_header">
                            1: TAKE CARE OF IMMEDIATE ACTION ITEMS</p>
                        <!-- Default unchecked -->
                        <!-- <div class="custom-control custom-checkbox"> -->
                        <!-- <input type="checkbox" class="custom-control-input" id="tableDefaultCheck1"> -->
                        <!-- <label class="custom-control-label" for="tableDefaultCheck1">Mark Complete if Finished</label> -->
                        <!-- Check if you have
                      </div> -->

                        <!-- <th>Lorem</th>
                        <th>Ipsum</th>
                        <th>Dolor</th> -->
                    </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody>
                    <tr>
                        <th scope="row">
                            <!-- Default unchecked -->
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck2" checked>
                                <label class="custom-control-label" for="tableDefaultCheck2">Contact a funeral home to
                                    make funeral arrangements or execute previously made arrangements.</label>
                            </div>
                        </th>
                        <!-- <td>Cell 1</td>
                        <td>Cell 2</td>
                        <td>Cell 3</td> -->
                    </tr>
                    <tr>
                        <th scope="row">
                            <!-- Default unchecked -->
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck3">
                                <label class="custom-control-label" for="tableDefaultCheck3">Request at least 15 copies
                                    of the death certificate from the county clerk or funeral home.</label>
                            </div>
                        </th>
                        <!-- <td>Cell 4</td>
                        <td>Cell 5</td>
                        <td>Cell 6</td> -->
                    </tr>
                    <tr>
                        <th scope="row">
                            <!-- Default unchecked -->
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck4">
                                <label class="custom-control-label" for="tableDefaultCheck4">Identify the
                                    executor/executrix of your loved one’s estate and make sure they get a copy of the
                                    will.</label>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="row">
                            <!-- Default unchecked -->
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck5">
                                <label class="custom-control-label" for="tableDefaultCheck5">Consult with an attorney
                                    regarding the will and your obligations.</label>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="row">
                            <!-- Default unchecked -->
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck6">
                                <label class="custom-control-label" for="tableDefaultCheck6">Notify your loved one’s
                                    employer and request information on any employee benefits (health insurance, life
                                    insurance,
                                    pension, etc.), salary, or vacation/sick pay owed.</label>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th scope="row">
                            <!-- Default unchecked -->
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="tableDefaultCheck7">
                                <label class="custom-control-label" for="tableDefaultCheck7">Report the death to Social
                                    Security (800-772-1213) and return any benefits paid to your loved one during and
                                    after the
                                    month of death.</label>
                            </div>
                        </th>
                    </tr>
                    </tbody>
                    <!-- Table body -->
                </table>
                <!-- Table  -->
            </div>
        </div>
    </div>
    <br>
    <!-- ============Step 2 =================-->
    <div class="card container">
        <!-- <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Financial Solace</h3>
        <mark class="mx-5 gray-text pt-2">Finances are the last thing you want to worry about when grieving the loss of a loved
      one. Yet money can often become a great source of stress and anxiety. During this time
      of healing, LifeSpot would like to help in any way we can. Here is a checklist
      with six steps you and your financial professional can take to help lighten that burden
      during this emotional time.  Check off each item as they are completed.</mark> -->
        <div class="card-body">
            <div>
                <!-- <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i class="fa fa-plus fa-2x"
                      aria-hidden="true"></i></a></span> -->
                <!-- Table  -->
                <table class="table table-bordered">
                    <!-- Table head -->
                    <thead>
                    <tr>
                        <p class="table_header">
                            2: ORGANIZE LEGAL AND FINANCIAL DOCUMENTS</p>

                        <small>Compile and organize your loved one’s legal and financial documents, if this was not
                            already done.
                        </small>
                    </tr>
                    </thead>
                    <th><strong>Legal Documents</strong></th>
                    <th><strong>Statements</strong></th>
                    <th><strong>Password Access</strong></th>

                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_1" checked>
                                <label class="custom-control-label" for="docsCheck_1">Last will and testament</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_1" xchecked>
                                <label class="custom-control-label" for="statementsCheck_1">Checking and savings
                                    accounts</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_1" checked>
                                <label class="custom-control-label" for="onlineCheck_1">Social Media Accounts</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_2" xchecked>
                                <label class="custom-control-label" for="docsCheck_2">Trusts</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_2" checked>
                                <label class="custom-control-label" for="statementsCheck_2">Certificates of
                                    deposit</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_2" xchecked>
                                <label class="custom-control-label" for="onlineCheck_2">Banking Institutions</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_3" checked>
                                <label class="custom-control-label" for="docsCheck_3">Beneficiary designations</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_3" checked>
                                <label class="custom-control-label" for="statementsCheck_3">Brokerage and investment
                                    accounts</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_3" checked>
                                <label class="custom-control-label" for="onlineCheck_3">Brokerage and investment
                                    accounts</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_4" checked>
                                <label class="custom-control-label" for="docsCheck_4">Birth certificate</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_4" checked>
                                <label class="custom-control-label" for="statementsCheck_4">Retirement plans</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_4" checked>
                                <label class="custom-control-label" for="onlineCheck_4">Retirement Accounts</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_5" xchecked>
                                <label class="custom-control-label" for="docsCheck_5">Marriage certificate</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_5" xchecked>
                                <label class="custom-control-label" for="statementsCheck_5">Mortgages and debts</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_5" xchecked>
                                <label class="custom-control-label" for="onlineCheck_5">Mortgage and debts
                                    access</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_7" xchecked>
                                <label class="custom-control-label" for="docsCheck_7">Divorce agreement(s)</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_7" xchecked>
                                <label class="custom-control-label" for="statementsCheck_7">Credit cards and
                                    loans</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_7" checked>
                                <label class="custom-control-label" for="onlineCheck_7">Credit Card access</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_8" xchecked>
                                <label class="custom-control-label" for="docsCheck_8">Deeds and titles</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_8" xchecked>
                                <label class="custom-control-label" for="statementsCheck_8">Social Security</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_8" checked>
                                <label class="custom-control-label" for="onlineCheck_8">Social Security Online </label>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_9" checked>
                                <label class="custom-control-label" for="docsCheck_9">Social Security card</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_9" xchecked>
                                <label class="custom-control-label" for="statementsCheck_9">Life insurance and annuity
                                    policies</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_9" xchecked>
                                <label class="custom-control-label" for="onlineCheck_9">Insurance access </label>
                            </div>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_10" xchecked>
                                <label class="custom-control-label" for="docsCheck_10">Tax returns and documents</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_10" xchecked>
                                <label class="custom-control-label" for="statementsCheck_10">Automobile and recreational
                                    vehicle insurance</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_10" checked>
                                <label class="custom-control-label" for="onlineCheck_10">Tax past filing access </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_11" xchecked>
                                <label class="custom-control-label" for="docsCheck_11">Leases</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_11" checked>
                                <label class="custom-control-label" for="statementsCheck_11">Homeowners or renters
                                    insurance</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_11" xchecked>
                                <label class="custom-control-label" for="onlineCheck_11">Online access </label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="docsCheck_12" checked>
                                <label class="custom-control-label" for="docsCheck_12">Funeral arrangements</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="statementsCheck_12" xchecked>
                                <label class="custom-control-label" for="statementsCheck_12">Health insurance</label>
                            </div>
                        </td>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="onlineCheck_12" checked>
                                <label class="custom-control-label" for="onlineCheck_12">Online access </label>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                    <!-- Table body -->
                </table>
                <!-- Table  -->
            </div>
        </div>
    </div>

    <button type="button"><a href="{{url('/home')}}">Back</a></button>
@endsection
