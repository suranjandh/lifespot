<style>

#form-asset{
  display:grid;
  /* grid-template-columns: repeat(5 1fr); */
  grid-template-columns: 1fr 1fr 2fr 2fr 2fr;
  grid-gap: 10px;
  grid-template-areas:
  "header header header header header"
  "pic assetDesciption assetDesciption value acctBal"
  
  "address address address address acctNum"
  /* "city city city state zip " */
  "description description description gifting titleHolder "
  "notes notes notes notes docs"
  /* "notes notes notes notes ." */
  "inTrust inTrust inTrust inTrust inTrust"
  "btn btn btn btn btn"
  ;
}
#asset-header{
  grid-area: header;
  padding: 0;
}

#asset-pic{
  grid-area: pic;
  /* position: relative; */
}
#asset-gender{
  grid-area: gender;
}
#asset-assetDesciption{
  grid-area: assetDesciption;
}
#asset-value{
  grid-area: value;
}
#asset-acctBal{
  grid-area: acctBal;
}
#asset-acctNum{
  grid-area: acctNum;
}
#asset-description{
  grid-area: description;
}
#asset-titleHolder{
  grid-area: titleHolder;
}
#asset-address{
  grid-area: address;
}
#asset-address2{
  grid-area: address2;
}
#asset-gifting{
  grid-area: gifting;
}
#asset-phone{
  grid-area: phone;
}

#asset-city{
  grid-area: city;
}
#asset-state{
  grid-area: state;
}
#asset-zip{
  grid-area: zip;
}
#asset-docs{
  grid-area: docs;
  margin-top: 8px;
}
#asset-notes{
  grid-area: notes;
  /* height: 240px; */
}

#asset-inTrust{
  grid-area: inTrust;
  height: 62px;
}
#asset-submitBtn{
  grid-area: btn;
}
</style>

<form id="form-asset">
<h3 id="asset-header">Asset Information</h3>
    <div id="asset-pic" class="image-upload">
      <input id="file-input{{rand(1,50000)}}" type="file"/>
      <label for="file-input">
      <div class="img__wrap">
        <img class="img__img img-thumbnail" src="{{Config::get('constants.PROJECT_IMAGE_URL')}}asset.jpg" style="height:75px;width:auto;" alt="">
        <div class="img__description_layer">
          <p class="img__description"><i class="fas fa-plus-circle xadd_field_button_phone white-text "></i><br>  Click to change photo</p>
        </div>
      </div>
      </label>
    </div>
    <div id="asset-assetDesciption">
      <label for="inputassetName4">Asset Name/Description</label>
      <input type="text" class="form-control" id="inputassetName4" placeholder="" value="">
    </div>
    <div id="asset-value">
      <label for="inputName4">Asset Value</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>
    <div id="asset-acctBal">
      <label for="inputName4">Balance</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>

    <div id="asset-address">
      <label for="inputAddress">Asset Address Location</label>
      <input type="text" class="form-control" id="inputAddress{{rand(1,50000)}}" placeholder="">
    </div>


    <div id="asset-acctNum">
      <label for="inputName4">Account Number</label>
      <input type="password" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>


    <div id="asset-description">
      <label for="inputAddress">Description</label>
      <input type="text" class="form-control" id="inputAddress{{rand(1,50000)}}" placeholder="">
    </div>



      <div id="asset-gifting">
        <label for="assetgifting">Gifting to </label>
        <input type="text" class="form-control white xgrey-text" id="assetgifting" placeholder="*dropdown of members" value="">
      </div>
      <div id="asset-titleHolder">
      <label for="inputName4">Title Holder</label>
      <input type="text" class="form-control" id="inputName4{{rand(1,50000)}}" placeholder="" value="">
    </div>

      <div id="asset-docs">
        <label for="assetDocs">View/Add Documents</label>
        <a class="btn btn-primary btn-size">Documents</a>
      </div>
      <div id="asset-notes">
        <label for="asset-Notes">Special Notes</label>
        <textarea class="form-control beneficiariesNotes" name="" id="asset-Notes" rows="2" placeholder="Special Notes:"></textarea>
      </div>
      <div id="asset-inTrust">
        <input class="form-check-input filled-in" type="checkbox" id="assetTrustCheck" checked>
        <label class="form-check-label pl-4 mr-5" for="assetTrustCheck">
        This asset is in my trust's name
        </label>
      </div>
      <div id="asset-submitBtn">
        <a id="btnChange-asset" type="submit" class="btn btn-primary btn-sm" onclick="toastr.success(`Success!<hr> Your changes have been saved.`);">Update</a>
      </div>
</form>