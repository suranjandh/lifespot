<style>

    #form-tax {
        display: grid;
        /* grid-template-columns: repeat(5 1fr); */
        grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "header header header header header" "pic advisor advisor acctType acctDescription" /* "address address address address address2"
  "city city state zip docs" */ "contactName contactName email email phone" "notes notes notes notes acctNum" "notes notes notes notes docs" /* "inTrust inTrust inTrust inTrust inTrust" */ "btn btn btn btn btn";
    }

    #tax-header {
        grid-area: header;
        padding: 0;
    }

    #tax-pic {
        grid-area: pic;
        /* position: relative; */
    }

    #tax-gender {
        grid-area: gender;
    }

    #tax-advisor {
        grid-area: advisor;
    }

    #tax-acctType {
        grid-area: acctType;
    }

    #tax-acctDescription {
        grid-area: acctDescription;
    }

    #tax-acctNum {
        grid-area: acctNum;
        margin-bottom: 8px;
    }

    #tax-contactName {
        grid-area: contactName;
    }

    #tax-address {
        grid-area: address;
    }

    #tax-address2 {
        grid-area: address2;
    }

    #tax-email {
        grid-area: email;
    }

    #tax-phone {
        grid-area: phone;
    }

    #tax-city {
        grid-area: city;
    }

    #tax-state {
        grid-area: state;
    }

    #tax-zip {
        grid-area: zip;
    }

    #tax-docs {
        grid-area: docs;
        height: 158px;
    }

    #tax-notes {
        grid-area: notes;
    }

    /* #tax-inTrust{
      grid-area: inTrust;
      height: 70px;
    } */
    #tax-submitBtn {
        grid-area: btn;
    }
</style>

<form id="form-tax">
    <h3 id="tax-header">Tax Information</h3>
    <div id="tax-pic" class="image-upload">
        <input id="file-input{{rand(1,50000)}}" type="file"/>
        <label for="file-input">
            <div class="img__wrap">
                <img class="img__img img-thumbnail" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}tax.jpeg"
                     style="height:75px;width:auto;" alt="">
                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to change
                        photo</p>
                </div>
            </div>
        </label>
    </div>
    <div id="tax-advisor">
        <label for="inputtaxName4">Tax Advisor</label>
        <input type="text" class="form-control" id="inputtaxName4" placeholder="" value="">
    </div>
    <div id="tax-acctType">
        <label for="inputName4">Account Type</label>
        <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="Business" value="">
    </div>
    <div id="tax-acctDescription">
        <label for="inputName4">Account Description</label>
        <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="tax-contactName">
        <label for="inputName4">Contact Name</label>
        <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>


    <div id="tax-email">
        <label for="taxEmail">Email</label>
        <input type="email" class="form-control white xgrey-text" id="taxEmail" placeholder="Email" value="">
    </div>
    <div id="tax-phone">
        <label for="taxPhone1">Phone</label>
        <input type="text" class="form-control" id="taxPhone1" placeholder="Phone" value="">
    </div>
    <div id="tax-docs">
        <label for="taxDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size">Documents</a>
    </div>
    <div id="tax-notes">
        <label for="tax-Notes">Special Notes</label>
        <textarea class="form-control beneficiariesNotes" name="" id="tax-Notes" rows="5"
                  placeholder="Special Notes:"></textarea>
    </div>
    <div id="tax-acctNum">
        <label for="inputName4">Account Number</label>
        <input type="password" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="tax-submitBtn">
        <a id="btnChange-tax" type="submit" class="btn btn-primary btn-sm"
           onclick="toastr.success(`Success!<hr> Your changes have been saved.`);">Update</a>
    </div>
</form>