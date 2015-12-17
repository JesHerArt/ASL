@extends('portal')

@section('title')
New Invoice - Employee Portal | DCI Printing &amp; Graphics, Inc. 
@stop

@section('empName')
<a href="/portal-settings">{{$name}}</a>
@stop

@section('content')
<h2>Invoices</h2>

<div class="row decorativeBar">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
</div>

<div id="settingsBox">
    <h3>New Invoice</h3>
    
    <hr>
    
    <form id="newInvoiceForm" method="POST">
        
        <input type="hidden" id="empId" name="empId" value="{{$empId}}">
        
        <div class="row">
            <div class="col-lg-4 label">
                <p>Account</p>
            </div>
            <div class="col-lg-8">
                <select id="account" name="account">
                    <option value="">Select an Account</option>
                @foreach ($accounts as $accnt)
                    <option value="{{$accnt['id']}}">{{$accnt['name']}}</option>
                @endforeach
                </select>
            </div>
        </div>
        
        <hr class="formDiv">
        
        <h4 class="formHeading">Products / Services</h4>
        
        <div id="itemsHolder">
            
            <div id="newItemBtn" class="row">
                <button id="addNewItem" class="portalBtn" data-toggle="tooltip" data-placement="right" title="Add Item to Invoice">+</button>
            </div>
        
        </div>
        
        <hr class="formDiv">
        
        <div class="row">
            <div class="col-lg-12">
                <a href="/portal-invoices"><input class="portalBtn formBtn" type="button" id="cancelEditEmpBtn" name="cancelEditEmpBtn" value="CANCEL" /></a>
                <input class="portalBtn formBtn" type="submit" id="newInvoiceBtn" name="newInvoiceBtn" value="SUBMIT" />
            </div>
        </div>
    
    </form>
</div>

<div class="row decorativeBar">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
</div>
@stop

@section('activeLink')
<script>
    $(document).ready(function() {
        $('#invoices').css('background','white').css('color','#ed008c').css('border-color','#00adef');
    });
</script>
@stop
