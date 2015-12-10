@extends('portal')

@section('title')
My Employees - Employee Portal | DCI Printing &amp; Graphics, Inc. 
@stop

@section('empName')
<a href="/portal-settings">{{$name}}</a>
@stop

@section('content')
<h2>My Employees</h2>

<div class="row decorativeBar">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
</div>

<div id="settingsBox">
    <a href="/portal-new-employee"><button id="addEmpBtn" class="portalBtn">Add New Employee</button></a>
    
    <table id="empTable">
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Type</th>
            <th>Username</th>
            <th>Primary Store</th>
            <th>Actions</th>
        </tr>
        
        @foreach ($employees as $employee)
            <tr>
                <td>{{$employee['id']}}</td>
                <td class="empsName">{{$employee['name']}}</td>
                <td>{{$employee['type']}}</td>
                <td>{{$employee['username']}}</td>
                <td>{{$employee['location']}}</td>
                <td><a href="#"><span class="empTime">View Timesheet</span></a> | <a href="/portal-edit-employee/{{$employee['id']}}"><span class="editEmp">Edit</span></a> | <a href="#"><span class="delEmp">Delete</span></a></td>
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
        $('#employees').css('background','white').css('color','#ed008c').css('border-color','#00adef');
    });
</script>
@stop
