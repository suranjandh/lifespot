<style>
#doc-count {
    font-weight: 500;
    font-size: .9rem;
    /* text-align: center; */
    color: rgb(58, 113, 183);
    margin: 0;
    padding: 0;
    color: orangered;
    /* color: green; */
    /* color: hotpink; */
}

.doc-list {
    color: grey;
}

#documents-share-content {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-auto-rows: 200px;
    /* grid-auto-rows: minmax(200px, auto); */
    grid-gap: 10px;
    /* max-width: 960px; */
    margin: 0 auto;
}

#documents-share-content a {
    /* background: #3bbced; */
    /* padding: 10px; */
    /* background: #eee; */
    background: #fff;
    overflow: auto;
    border-radius: 5px;
    /* text-align: center; */
}

#documents-share-content div:nth-child(even) {
    /* background: #777; */
    /* padding: 30px; */
}

.document-share-cardLayout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    /* grid-auto-rows: minmax(70px, auto); */
    /* grid-gap: 5px; */
    color: black;
    padding: 5px;
    /* line-height: 50px; */
    grid-template-areas: "relation relation" "pic name" /* "keyRole keyRole" */ "guardianRole guardianRole" "moreRoles icon";
}

/* end document share css */
#documents-content {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-auto-rows: 200px;
    /* grid-auto-rows: minmax(200px, auto); */
    grid-gap: 10px;
    /* max-width: 960px; */
    margin: 0 auto;
}

#documents-content a {
    /* background: #3bbced; */
    /* padding: 10px; */
    /* background: #eee; */
    background: #fff;
    overflow: auto;
    border-radius: 5px;
    /* text-align: center; */
}

#documents-content div:nth-child(even) {
    /* background: #777; */
    /* padding: 30px; */
}

.document-cardLayout {
    display: grid;
    border: 1px solid #000000;
    grid-template-columns: 1fr 1fr;
    /* grid-auto-rows: minmax(70px, auto); */
    /* grid-gap: 5px; */
    color: black;
    padding: 5px;
    /* line-height: 50px; */
    grid-template-areas: "relation relation" "pic name" /* "keyRole keyRole" */ "guardianRole guardianRole" "moreRoles icon";
}

#search-documents-input {
    grid-area: search;
    text-indent: 50px;
}

#sort {
    grid-area: sort;
}

.key-roles {
    grid-area: keyRole;
    color: rgb(57, 122, 242);
    font-weight: bold;
}

.guardian-role {
    grid-area: guardianRole;
    /* color: rgb(57, 122, 242); */
    /* color: green; */
    height: 60px;
}

.name {
    grid-area: name;
    align-self: center;
    /* margin-top: 15px; */
    /* justify-items: center; */
    /* padding-left: 15px; */
}

.pic {
    grid-area: pic;
    /* align-self: center; */
    justify-self: center;
}

.document-relationship {
    grid-area: relation;
    /* align-self: start; */
    /* margin-top: -15px; */
    color: grey;
    margin-left: 5px;
    margin-bottom: 20px;
    height: 1px;
}

.document-details {
    grid-area: details;
    margin: 0 auto;
}

.moreRoles {
    grid-area: moreRoles;
    /* padding-left: 5px; */
    justify-self: start;
    font-size: .8em;
    color: grey;
    font-weight: 400;
}

.icon {
    grid-area: icon;
    padding-right: 15px;
    justify-self: end;
}

#addNewDocument {
    color: rgb(57, 122, 242);
    text-align: center;
    padding: 15px;
    font-size: 1.4em;
}

.document-img {
    height: 75px;
    width: 100%;
    width: 75px;
    /* width: auto; */
    border-radius: 50px;
}

.modal-position {
    margin-right: 50%;
}

.modal-size {
    width: 1000px;
}

.fa-plus {
    color: rgb(57, 122, 242);
}

.fa-trash-alt {
    color: rgb(57, 122, 242);
    margin-top: 7px;
    font-size: 1rem;
}

#document_cards_container .card-deck {
    margin-top: 20px;
}

.mdb-autocomplete-wrap {
    color: rgb(57, 122, 242);
}

/*#suggesstion-box {
    grid-area: search;
    z-index:1000;
    top:-140px;
    background-color: white;
}

#suggesstion-box , #suggesstion-box ul,
#suggesstion-box li,#suggesstion-box div{
    background-color: white;
    color: rgb(57, 122, 242);
}*/
/*
.frmSearch {border: 1px solid #a8d4b1;background-color: #c6f7d0;margin: 2px 0px;padding:40px;border-radius:4px;z-index: 10000}
*/
/*#suggesstion-box {
    grid-area: search;
}*/
.frmSearch {
    width: 100%;
}

#document-list {
    float: left;
    list-style: none;
    margin-top: -3px;
    padding: 0;
    width: 97%;
    position: absolute;
    z-index: 1000
}

#document-list li {
    background: #FFFFFF;
}

#document-list li.search_li {
    padding: 10px;
    background: #FFFFFF;
    border-bottom: #bbb9b9 1px solid;
    height: 70px
}

#document-list li.search_li:hover {
    background: #FFFFFF;
    cursor: pointer;
}

#search-box {
    padding: 10px;
    border: #a8d4b1 1px solid;
    /*
        border--radius: 4px;
    */
    /*
        width: 90%;
    */
}

.search_span {
    float: left;
    margin-left: 6px;
    position: relative;
    z-index: 2;
}

#document-list #search_li_first_row {
    float: left;
    width: 100%;
}

#document-list .search_li_title {
    font-size: 1.1em;
    font-weight: bold;
    /*
        color:  #007bff;
    */;
}

#document-list .search_li_date {
    float: right;
    font-size: 1em;
    font-weight: bold;
    /*
        color: rgba(0, 123, 255, 0.91);
    */
}

#document-list .search_li_owner {
    float: left;
    margin-left: 0px;
    padding-left: 50px;
    font-size: .9em;
    /*
        color: rgba(0, 123, 255, 0.81);
    */
}

.input-group-addon-close {
    background-color: white;
    text-align: center;
    width: 30px;
    border: #a8d4b1 solid 1px;
    padding-top: 5px;
    display: none;
}

.input-group-addon-search {
    background-color: white;
    text-align: center;
    width: 30px;
    border: #a8d4b1 solid 1px;
    padding-top: 5px
}
</style>
<!-- Modal -->
<div class="modal fade" id="addNewDocumentID2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<!-- Modal END -->
<div class="row">
    <h1 class="white-text pb-3">Documents Center </h1>
    <!-- <div class="co-1"> </div> -->
    <div class="col-12">

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon input-group-addon-close">
                    <a>
                        <i class="fa fa-window-close"></i>
                    </a>
                </div>
                <div class="input-group-addon input-group-addon-search">
                    <i class="fa fa-search"></i>
                </div>
                <input class="form-control" type="text" id="search-box" placeholder="Search documents..."
                       style="border-left: none"/>
            </div>
            <div id="suggesstion-box"></div>
        </div>
    </div>
</div>
<!-- <div class="col-3 white-text  mt-1">Add New Category</div> -->
<p class="xdashboard-spanText" data-toggle="modal" data-target="#modalDocCenterFullList"><a class="white-text">
<i class="far fa-folder-open fa-1x"></i>  Open Full List of Documents</a> </p>

<div id="document_cards_container">
   {{-- @php
    if(isset($_POST->document_id) && $_POST->document_id > 0 ) {
        include 'forms/documentForms/document-cards/share_cards_processor.php';
    }else{
        include 'forms/documentForms/document-cards/cards_processor.php' ;
    }
    @endphp--}}
    @if(\Illuminate\Support\Facades\Input::get('document_id') > 0)
        @include('project.estates.forms.documentForms.document-cards.share_cards_processor')
    @else
        @include('project.estates.forms.documentForms.document-cards.cards_processor')
    @endif
</div>

<!-- Document Center -->
{{--@php  include 'forms/documentForms/document-new/document-FullList.php' @endphp--}}
@include('project.estates.forms.documentForms.document-new.document-FullList')
<!-- /Document Center -->

