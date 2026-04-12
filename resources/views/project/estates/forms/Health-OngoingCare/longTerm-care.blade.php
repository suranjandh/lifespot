<style>
#form-longTermCare{
  display:grid;
  /* grid-template-columns: repeat(5 1fr); */
  grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
  grid-gap: 10px;
  grid-template-areas:
  "header header header header header"
  "pic institution institution policyNum groupNum"
  
  "address address address address website"
  "contactName contactName email phone acctNum "
  "notes notes notes notes docs"
  "inTrust inTrust inTrust inTrust docs"
  /* "inTrust inTrust inTrust inTrust docs" */
  "btn btn btn btn btn"
  ;
}
#longTermCare-header{
  grid-area: header;
  padding: 0;
}

#longTermCare-pic{
  grid-area: pic;
}
#longTermCare-gender{
  grid-area: gender;
}
#longTermCare-institution{
  grid-area: institution;
}
#longTermCare-policyNum{
  grid-area: policyNum;
}
#longTermCare-groupNum{
  grid-area: groupNum;
}
#longTermCare-acctNum{
  grid-area: acctNum;
}
#longTermCare-website{
  grid-area: website;
}
#longTermCare-contactName{
  grid-area: contactName;
}
#longTermCare-address{
  grid-area: address;
}
#longTermCare-address2{
  grid-area: address2;
}
#longTermCare-email{
  grid-area: email;
}
#longTermCare-phone{
  grid-area: phone;
}

#longTermCare-city{
  grid-area: city;
}
#longTermCare-state{
  grid-area: state;
}
#longTermCare-zip{
  grid-area: zip;
}
#longTermCare-docs{
  grid-area: docs;
  margin-top: 8px;
}
#longTermCare-notes{
  grid-area: notes;
  /* height: 240px; */
}

#longTermCare-inTrust{
  grid-area: inTrust;
  height: 62px;
}
#longTermCare-submitBtn{
  grid-area: btn;
}
</style>

<form id="form-longTermCare">
<h3 id="longTermCare-header">Long Term Care Insurance</h3>
    <div id="longTermCare-pic" class="image-upload">
      <input id="file-input{{rand(1,50000)}}" type="file"/>
      <label for="file-input">
      <div class="img__wrap">
        <img class="img__img img-thumbnail" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}defaultAvatar.jpeg" style="height:75px;width:auto;" alt="">
        <div class="img__description_layer">
          <p class="img__description"><i class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br>  Click to change photo</p>
        </div>
      </div>
      </label>
    </div>
    <div id="longTermCare-institution">
      <label for="inputlongTermCareName4">Insurance Company</label>
      <input type="text" class="form-control" id="inputlongTermCareName4" placeholder="" policyNum="">
    </div>
    <div id="longTermCare-policyNum">
      <label for="inputName4">Policy Number</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
    </div>

    <div id="longTermCare-groupNum">
      <label for="inputName4">Group Number</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
    </div>

    <div id="longTermCare-address">
      <label for="inputAddress">Address</label>
      <input type="text" class="form-control" id="inputAddress{{rand(1,50000)}}" placeholder="">
    </div>

    <div id="longTermCare-website">
      <label for="inputAddress">Website</label>
      <input type="text" class="form-control" id="inputAddress{{rand(1,50000)}}" placeholder="">
    </div>
   
      <div id="longTermCare-contactName">
        <label for="inputName4">Contact Name</label>
        <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
      </div>

      <div id="longTermCare-email">
        <label for="longTermCareEmail">Email</label>
        <input type="email" class="form-control white xgrey-text" id="longTermCareEmail" placeholder="Email" policyNum="">
      </div>
      <div id="longTermCare-phone">
        <label for="longTermCarePhone1">Phone</label>
        <input type="text" class="form-control" id="longTermCarePhone1" placeholder="Phone" policyNum="">
      </div>
      <div id="longTermCare-acctNum">
        <label for="inputName4">Account Number</label>
        <input type="password" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
      </div>
      <div id="longTermCare-docs">
        <label for="longTermCareDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size">Documents</a>
      </div>
      <div id="longTermCare-notes">
        <label for="longTermCare-Notes">Special Notes</label>
        <textarea class="form-control beneficiariesNotes" name="" id="longTermCare-Notes" rows="2" placeholder="Special Notes:"></textarea>
      </div>
      <div id="longTermCare-inTrust">
        <input class="form-check-input filled-in" type="checkbox" id="longTermCareTrustCheck" checked>
        <label class="form-check-label pl-4 mr-5" for="longTermCareTrustCheck">
          I am the long term care insurance member
        </label>
        
      </div>
      <div id="longTermCare-submitBtn">
        <a id="btnChange-longTermCare" type="submit" class="btn btn-primary btn-sm" onclick="toastr.success(`Success!<hr> Your changes have been saved.`);">Update</a>
      </div>
</form>