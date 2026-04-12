<style>

#form-business{
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
#business-header{
  grid-area: header;
  padding: 0;
}

#business-pic{
  grid-area: pic;
  /* position: relative; */
}
#business-gender{
  grid-area: gender;
}
#business-institution{
  grid-area: institution;
}
#business-acctType{
  grid-area: acctType;
}
#business-acctBal{
  grid-area: acctBal;
}
#business-acctNum{
  grid-area: acctNum;
}
#business-contactName{
  grid-area: contactName;
}
#business-address{
  grid-area: address;
}
#business-address2{
  grid-area: address2;
}
#business-email{
  grid-area: email;
}
#business-phone{
  grid-area: phone;
}

#business-city{
  grid-area: city;
}
#business-state{
  grid-area: state;
}
#business-zip{
  grid-area: zip;
}
#business-docs{
  grid-area: docs;
}
#business-notes{
  grid-area: notes;
  /* height: 240px; */
}

#business-inTrust{
  grid-area: inTrust;
  height: 70px;
}
#business-submitBtn{
  grid-area: btn;
}
</style>

<form id="form-business">
<h3 id="business-header">Business Information</h3>
    <div id="business-pic" class="image-upload">
      <input id="file-input{{rand(1,50000)}}" type="file"/>
      <label for="file-input">
      <div class="img__wrap">
        <img class="img__img img-thumbnail" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}business.jpg" style="height:75px;width:auto;" alt="">
        <div class="img__description_layer">
          <p class="img__description"><i class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br>  Click to change photo</p>
        </div>
      </div>
      </label>
    </div>
    <div id="business-institution">
      <label for="inputbusinessName4">Financial Institution</label>
      <input type="text" class="form-control" id="inputbusinessName4" placeholder="" value="">
    </div>
    <div id="business-acctType">
      <div class="form-group mb-0">
        <label for="business-owner">Account Type</label>    
          <select class="form-group mb-0 mdb-select colorful-select dropdown-primary" id="business-owner">
            <option class="white"></option>
            <option value="llc">LLC</option>
            <option value="soleProprietor">Sole Proprietor</option>
            <option value="sCorp">S Corp</option>
            <option value="cCorp">C Corp</option>
          </select>
      </div>       
    </div>
    <div id="business-acctBal">
      <label for="inputName4">Percentage Owned</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="business-contactName">
      <label for="inputName4">Contact Name</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="business-email">
        <label for="businessEmail">Email</label>
        <input type="email" class="form-control white xgrey-text" id="businessEmail" placeholder="Email" value="">
      </div>




      <div id="business-phone">
        <label for="businessPhone1">Phone</label>
        <input type="text" class="form-control" id="businessPhone1" placeholder="Phone" value="">
      </div>
      <div id="business-docs">
        <label for="businessDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size">Documents</a>
      </div>
      <div id="business-notes">
        <label for="business-Notes">Special Notes</label>
        <textarea class="form-control beneficiariesNotes" name="" id="business-Notes" rows="5" placeholder="Business notes:"></textarea>
      </div>
      <div id="business-acctNum">
      <label for="inputName4">EIN</label>
      <input type="password" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
      <div id="business-inTrust">
        <input class="form-check-input filled-in" type="checkbox" id="businessTrustCheck" checked>
        <label class="form-check-label pl-4 mr-5" for="businessTrustCheck">
          This business account is in my trust's name
        </label>
        
      </div>
      <div id="business-submitBtn">
        <a id="btnChange-business" type="submit" class="btn btn-primary btn-sm" onclick="toastr.success(`Success!<hr> Your changes have been saved.`);">Update</a>
      </div>
</form>