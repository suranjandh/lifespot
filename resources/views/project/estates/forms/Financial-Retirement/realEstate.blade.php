<style>

    #form-property {
        display: grid;
        /* grid-template-columns: repeat(5 1fr); */
        grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
        grid-gap: 10px;
        grid-template-areas: "header header header header header" "pic institution institution value acctBal" "address address address address address" /* "city city city state zip " */ "mortgageCo mortgageCo email phone acctNum " "notes notes notes notes docs" "inTrust inTrust inTrust inTrust inTrust" /* "inTrust inTrust inTrust inTrust docs" */ "btn btn btn btn btn";
    }

    #property-header {
        grid-area: header;
        padding: 0;
    }

    #property-pic {
        grid-area: pic;
    }

    #property-gender {
        grid-area: gender;
    }

    #property-institution {
        grid-area: institution;
    }

    #property-value {
        grid-area: value;
    }

    #property-acctBal {
        grid-area: acctBal;
    }

    #property-acctNum {
        grid-area: acctNum;
    }

    #property-mortgageCo {
        grid-area: mortgageCo;
    }

    #property-contactName {
        grid-area: contactName;
    }

    #property-address {
        grid-area: address;
    }

    #property-address2 {
        grid-area: address2;
    }

    #property-email {
        grid-area: email;
    }

    #property-phone {
        grid-area: phone;
    }

    #property-city {
        grid-area: city;
    }

    #property-state {
        grid-area: state;
    }

    #property-zip {
        grid-area: zip;
    }

    #property-docs {
        grid-area: docs;
        margin-top: 8px;
    }

    #property-notes {
        grid-area: notes;
        /* height: 240px; */
    }

    #property-inTrust {
        grid-area: inTrust;
        height: 62px;
    }

    #property-submitBtn {
        grid-area: btn;
    }
</style>

<form id="form-property">
    <h3 id="property-header">Property Information</h3>
    <div id="property-pic" class="image-upload">
        <input id="file-input{{rand(1,50000)}}" type="file"/>
        <label for="file-input">
            <div class="img__wrap">
                <img class="img__img img-thumbnail" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}realestate.jpeg" style="height:75px;width:auto;" alt="">
                <div class="img__description_layer">
                    <p class="img__description"><i
                                class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br> Click to change
                        photo</p>
                </div>
            </div>
        </label>
    </div>
    <div id="property-institution">
        <label for="inputpropertyName4">Real Estate Type</label>
        <input type="text" class="form-control" id="inputpropertyName4" placeholder="Make this a drop down" value="">
    </div>
    <div id="property-value">
        <label for="inputName4">Property Value</label>
        <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>

    <div id="property-acctBal">
        <label for="inputName4">Balance</label>
        <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="property-address">
        <label for="inputAddress">Property Address</label>
        <input type="text" class="form-control" id="inputAddress{{rand(1,50000)}}" placeholder="">
    </div>
    <div id="property-mortgageCo">
        <label for="inputAddress">Mortgage Holder</label>
        <input type="text" class="form-control" id="inputAddress{{rand(1,50000)}}" placeholder="">
    </div>
    <div id="property-email">
        <label for="propertyEmail">Website</label>
        <input type="text" class="form-control white xgrey-text" id="propertyEmail" placeholder="Website" value="">
    </div>
    <div id="property-phone">
        <label for="propertyPhone1">Phone</label>
        <input type="text" class="form-control" id="propertyPhone1" placeholder="Phone" value="">
    </div>
    <div id="property-acctNum">
        <label for="inputName4">Account Number</label>
        <input type="password" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>

    <div id="property-docs">
        <label for="propertyDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size">Documents</a>
    </div>
    <div id="property-notes">
        <label for="property-Notes">Special Notes</label>
        <textarea class="form-control beneficiariesNotes" name="" id="property-Notes" rows="2"
                  placeholder="Special Notes:"></textarea>
    </div>
    <div id="property-inTrust">
        <input class="form-check-input filled-in" type="checkbox" id="propertyTrustCheck" checked>
        <label class="form-check-label pl-4 mr-5" for="propertyTrustCheck">
            Is there a second lien (mortgage/line of equity) on this property
        </label>
        <input class="form-check-input filled-in" type="checkbox" id="realEstateTrustCheck" checked>
        <label class="form-check-label pl-4 mr-5" for="realEstateTrustCheck">
            This real estate is in my trust's name
        </label>
    </div>
    <div id="property-submitBtn">
        <a id="btnChange-property" type="submit" class="btn btn-primary btn-sm"
           onclick="toastr.success(`Success!<hr> Your changes have been saved.`);">Update</a>
    </div>
</form>