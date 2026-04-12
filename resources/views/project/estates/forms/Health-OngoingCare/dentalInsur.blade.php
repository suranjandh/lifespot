<style>

#form-dental{
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
#dental-header{
  grid-area: header;
  padding: 0;
}

#dental-pic{
  grid-area: pic;
}
#dental-gender{
  grid-area: gender;
}
#dental-institution{
  grid-area: institution;
}
#dental-policyNum{
  grid-area: policyNum;
}
#dental-groupNum{
  grid-area: groupNum;
}
#dental-acctNum{
  grid-area: acctNum;
}
#dental-website{
  grid-area: website;
}
#dental-contactName{
  grid-area: contactName;
}
#dental-address{
  grid-area: address;
}
#dental-address2{
  grid-area: address2;
}
#dental-email{
  grid-area: email;
}
#dental-phone{
  grid-area: phone;
}

#dental-city{
  grid-area: city;
}
#dental-state{
  grid-area: state;
}
#dental-zip{
  grid-area: zip;
}
#dental-docs{
  grid-area: docs;
  margin-top: 8px;
}
#dental-notes{
  grid-area: notes;
  /* height: 240px; */
}

#dental-inTrust{
  grid-area: inTrust;
  height: 62px;
}
#dental-submitBtn{
  grid-area: btn;
}
</style>

<form id="form-dental">
<h3 id="dental-header">Dental Insurance</h3>
    <div id="dental-pic" class="image-upload">
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
    <div id="dental-institution">
      <label for="inputdentalName4">Insurance Company</label>
      <input type="text" class="form-control" id="inputdentalName4" placeholder="" policyNum="">
    </div>
    <div id="dental-policyNum">
      <label for="inputName4">Policy Number</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
    </div>

    <div id="dental-groupNum">
      <label for="inputName4">Group Number</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
    </div>

    <div id="dental-address">
      <label for="inputAddress">Address</label>
      <input type="text" class="form-control" id="inputAddress{{rand(1,50000)}}" placeholder="">
    </div>

    <div id="dental-website">
      <label for="inputAddress">Website</label>
      <input type="text" class="form-control" id="inputAddress{{rand(1,50000)}}" placeholder="">
    </div>
    <div id="dental-contactName">
      <label for="inputName4">Contact Name</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
    </div>
   


      <div id="dental-email">
        <label for="dentalEmail">Email</label>
        <input type="email" class="form-control white xgrey-text" id="dentalEmail" placeholder="Email" policyNum="">
      </div>
      <div id="dental-phone">
        <label for="dentalPhone1">Phone</label>
        <input type="text" class="form-control" id="dentalPhone1" placeholder="Phone" policyNum="">
      </div>
      <div id="dental-acctNum">
        <label for="inputName4">Account Number</label>
        <input type="password" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
    </div>
      <div id="dental-docs">
        <label for="dentalDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size">Documents</a>
      </div>
      <div id="dental-notes">
        <label for="dental-Notes">Special Notes</label>
        <textarea class="form-control beneficiariesNotes" name="" id="dental-Notes" rows="2" placeholder="Special Notes:"></textarea>
      </div>
      <div id="dental-inTrust">
        <input class="form-check-input filled-in" type="checkbox" id="dentalTrustCheck" checked>
        <label class="form-check-label pl-4 mr-5" for="dentalTrustCheck">
          I am the dental insurance member
        </label>
        
      </div>
      <div id="dental-submitBtn">
        <a id="btnChange-dental" type="submit" class="btn btn-primary btn-sm" onclick="toastr.success(`Success!<hr> Your changes have been saved.`);">Update</a>
      </div>
</form>