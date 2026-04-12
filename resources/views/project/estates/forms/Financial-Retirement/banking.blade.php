<style>

#form-banking{
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
#banking-header{
  grid-area: header;
  padding: 0;
}

#banking-pic{
  grid-area: pic;
  /* position: relative; */
}
#banking-gender{
  grid-area: gender;
}
#banking-institution{
  grid-area: institution;
}
#banking-acctType{
  grid-area: acctType;
}
#banking-acctBal{
  grid-area: acctBal;
}
#banking-acctNum{
  grid-area: acctNum;
}
#banking-contactName{
  grid-area: contactName;
}
#banking-address{
  grid-area: address;
}
#banking-address2{
  grid-area: address2;
}
#banking-email{
  grid-area: email;
}
#banking-phone{
  grid-area: phone;
}

#banking-city{
  grid-area: city;
}
#banking-state{
  grid-area: state;
}
#banking-zip{
  grid-area: zip;
}
#banking-docs{
  grid-area: docs;
}
#banking-notes{
  grid-area: notes;
  /* height: 240px; */
}

#banking-inTrust{
  grid-area: inTrust;
  height: 70px;
}
#banking-submitBtn{
  grid-area: btn;
}
</style>

<form id="form-banking">
<h3 id="banking-header">Banking Information</h3>
    <div id="banking-pic" class="image-upload">
      <input id="file-input{{rand(1,50000)}}" type="file"/>
      <label for="file-input">
      <div class="img__wrap">
        <img class="img__img img-thumbnail" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}bank.jpeg" style="height:75px;width:auto;" alt="">
        <div class="img__description_layer">
          <p class="img__description"><i class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br>  Click to change photo</p>
        </div>
      </div>
      </label>
    </div>
    <div id="banking-institution">
      <label for="inputbankingName4">Financial Institution</label>
      <input type="text" class="form-control" id="inputbankingName4" placeholder="" value="">
    </div>
    <div id="banking-acctType">
      <label for="inputName4">Account Type</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="banking-acctBal">
      <label for="inputName4">Account Balance</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="banking-contactName">
      <label for="inputName4">Contact Name</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="banking-email">
      <label for="bankingEmail">Email</label>
      <input type="email" class="form-control white xgrey-text" id="bankingEmail" placeholder="Email" value="">
    </div>
    <div id="banking-phone">
      <label for="bankingPhone1">Phone</label>
      <input type="text" class="form-control" id="bankingPhone1" placeholder="Phone" value="">
    </div>




      <div id="banking-docs">
        <label for="bankingDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size">Documents</a>
      </div>
      <div id="banking-notes">
        <label for="banking-Notes">Special Notes</label>
        <textarea class="form-control beneficiariesNotes" name="" id="banking-Notes" rows="5" placeholder="Special Notes:"></textarea>
      </div>
      <div id="banking-acctNum">
      <label for="inputName4">Account Number</label>
      <input type="password" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
      <div id="banking-inTrust">
        <input class="form-check-input filled-in" type="checkbox" id="bankingTrustCheck" checked>
        <label class="form-check-label pl-4 mr-5" for="bankingTrustCheck">
          This account is in my trust's name
        </label>
        
      </div>
      <div id="banking-submitBtn">
        <a id="btnChange-banking" type="submit" class="btn btn-primary btn-sm" onclick="toastr.success(`Success!<hr> Your changes have been saved.`);">Update</a>
      </div>
</form>