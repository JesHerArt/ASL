@extends('portal')

@section('title')
Invoices - Employee Portal | DCI Printing &amp; Graphics, Inc. 
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
    <a href="/portal-new-invoice"><button id="addEmpBtn" class="portalBtn">New Invoice</button></a>
    
    <table id="invoicesTable">
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Total</th>
            <th>Status</th>
            <th>Employee</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        
        @foreach ($invoices as $invoice)
            <tr>
                <td>{{$invoice['id']}}</td>
                <td class="empsName">{{$invoice['company']}}</td>
                <td>{{$invoice['total']}}</td>
                <td>{{$invoice['status']}}</td>
                <td>{{$invoice['employee']}}</td>
                <td>{{$invoice['created']}}</td>
                <td><a href="#"><span class="empTime">View Invoice</span></a> | <a href="#"><span class="editEmp">Mark Paid</span></a> | <a href="#"><span class="delEmp">Delete</span></a></td>
            </tr>
        @endforeach
        
    </table>
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
