<style>

#form-health{
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
#health-header{
  grid-area: header;
  padding: 0;
}

#health-pic{
  grid-area: pic;
}
#health-gender{
  grid-area: gender;
}
#health-institution{
  grid-area: institution;
}
#health-policyNum{
  grid-area: policyNum;
}
#health-groupNum{
  grid-area: groupNum;
}
#health-acctNum{
  grid-area: acctNum;
}
#health-website{
  grid-area: website;
}
#health-contactName{
  grid-area: contactName;
}
#health-address{
  grid-area: address;
}
#health-address2{
  grid-area: address2;
}
#health-email{
  grid-area: email;
}
#health-phone{
  grid-area: phone;
}

#health-city{
  grid-area: city;
}
#health-state{
  grid-area: state;
}
#health-zip{
  grid-area: zip;
}
#health-docs{
  grid-area: docs;
  margin-top: 8px;
}
#health-notes{
  grid-area: notes;
  /* height: 240px; */
}

#health-inTrust{
  grid-area: inTrust;
  height: 62px;
}
#health-submitBtn{
  grid-area: btn;
}
</style>

<form id="form-health">
<h3 id="health-header">Health Insurance</h3>
    <div id="health-pic" class="image-upload">
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
    <div id="health-institution">
      <label for="inputhealthName4">Insurance Company</label>
      <input type="text" class="form-control" id="inputhealthName4" placeholder="" policyNum="">
    </div>
    <div id="health-policyNum">
      <label for="inputName4">Policy Number</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
    </div>

    <div id="health-groupNum">
      <label for="inputName4">Group Number</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
    </div>


    <div id="health-address">
      <label for="inputAddress">Address</label>
      <input type="text" class="form-control" id="inputAddress{{rand(1,50000)}}" placeholder="">
    </div>

    <div id="health-website">
      <label for="inputAddress">Website</label>
      <input type="text" class="form-control" id="inputAddress{{rand(1,50000)}}" placeholder="">
    </div>
    
    <div id="health-contactName">
      <label for="inputName4">Contact Name</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
    </div>

      <div id="health-email">
        <label for="healthEmail">Email</label>
        <input type="email" class="form-control white xgrey-text" id="healthEmail" placeholder="Email" policyNum="">
      </div>
      <div id="health-phone">
        <label for="healthPhone1">Phone</label>
        <input type="text" class="form-control" id="healthPhone1" placeholder="Phone" policyNum="">
      </div>

      <div id="health-acctNum">
        <label for="inputName4">Account Number</label>
        <input type="password" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" policyNum="">
      </div>
      <div id="health-docs">
        <label for="healthDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size">Documents</a>
      </div>
      <div id="health-notes">
        <label for="health-Notes">Special Notes</label>
        <textarea class="form-control beneficiariesNotes" name="" id="health-Notes" rows="2" placeholder="Special Notes:"></textarea>
      </div>
      <div id="health-inTrust">
        <input class="form-check-input filled-in" type="checkbox" id="healthTrustCheck" checked>
        <label class="form-check-label pl-4 mr-5" for="healthTrustCheck">
          I am the health insurance member
        </label>
       
      </div>
      <div id="health-submitBtn">
        <a id="btnChange-health" type="submit" class="btn btn-primary btn-sm" onclick="toastr.success(`Success!<hr> Your changes have been saved.`);">Update</a>
      </div>
</form>