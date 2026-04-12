<style>

#form-retirement{
  display:grid;
  /* grid-template-columns: repeat(5 1fr); */
  grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
  grid-gap: 10px;
  grid-template-areas:
  "header header header header header"
  "pic institution institution acctType acctBal"
  /* "address address address address address2"
  "city city state zip docs" */
  "contactName contactName email email phone"
  "notes notes notes notes acctNum"
  "notes notes notes notes docs"
  "inTrust inTrust inTrust inTrust inTrust"
  "btn btn btn btn btn"
  ;
}
#retirement-header{
  grid-area: header;
  padding: 0;
}

#retirement-pic{
  grid-area: pic;
  /* position: relative; */
}
#retirement-gender{
  grid-area: gender;
}
#retirement-institution{
  grid-area: institution;
}
#retirement-acctType{
  grid-area: acctType;
}
#retirement-acctBal{
  grid-area: acctBal;
}
#retirement-acctNum{
  grid-area: acctNum;
}
#retirement-contactName{
  grid-area: contactName;
}
#retirement-address{
  grid-area: address;
}
#retirement-address2{
  grid-area: address2;
}
#retirement-email{
  grid-area: email;
}
#retirement-phone{
  grid-area: phone;
}

#retirement-city{
  grid-area: city;
}
#retirement-state{
  grid-area: state;
}
#retirement-zip{
  grid-area: zip;
}
#retirement-docs{
  grid-area: docs;
}
#retirement-notes{
  grid-area: notes;
  /* height: 240px; */
}

#retirement-inTrust{
  grid-area: inTrust;
  height: 70px;
}
#retirement-submitBtn{
  grid-area: btn;
}
</style>

<form id="form-retirement">
<h3 id="retirement-header">Retirement Information</h3>
    <div id="retirement-pic" class="image-upload">
      <input id="file-input{{rand(1,50000)}}" type="file"/>
      <label for="file-input">
      <div class="img__wrap">
        <img class="img__img img-thumbnail" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}retirement.jpg" style="height:75px;width:auto;" alt="">
        <div class="img__description_layer">
          <p class="img__description"><i class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br>  Click to change photo</p>
        </div>
      </div>
      </label>
    </div>
    <div id="retirement-institution">
      <label for="inputretirementName4">Financial Institution/Description</label>
      <input type="text" class="form-control" id="inputretirementName4" placeholder="" value="">
    </div>
    <div id="retirement-acctType">
      <label for="inputName4">Account Type</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="retirement-acctBal">
      <label for="inputName4">Account Balance</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="retirement-contactName">
      <label for="inputName4">Contact Name</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>




      <div id="retirement-email">
        <label for="retirementEmail">Email</label>
        <input type="email" class="form-control white xgrey-text" id="retirementEmail" placeholder="Email" value="">
      </div>
      <div id="retirement-phone">
        <label for="retirementPhone1">Phone</label>
        <input type="text" class="form-control" id="retirementPhone1" placeholder="Phone" value="">
      </div>
      <div id="retirement-docs">
        <label for="retirementDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size">Documents</a>
      </div>
      <div id="retirement-notes">
        <label for="retirement-Notes">Special Notes</label>
        <textarea class="form-control beneficiariesNotes" name="" id="retirement-Notes" rows="5" placeholder="Special Notes:"></textarea>
      </div>
      <div id="retirement-acctNum">
      <label for="inputName4">Account Number</label>
      <input type="password" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
      <div id="retirement-inTrust">
        <input class="form-check-input filled-in" type="checkbox" id="retirementTrustCheck" checked>
        <label class="form-check-label pl-4 mr-5" for="retirementTrustCheck">
          This account is in my trust's name
        </label>
        
      </div>
      <div id="retirement-submitBtn">
        <a id="btnChange-retirement" type="submit" class="btn btn-primary btn-sm" onclick="toastr.success(`Success!<hr> Your changes have been saved.`);">Update</a>
      </div>
</form>