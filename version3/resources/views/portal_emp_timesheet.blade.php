@extends('portal')

@section('title')
View Employee Timesheet - Employee Portal | DCI Printing &amp; Graphics, Inc. 
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
    <h3>Timesheet for Employee #{{$id}}</h3>
    <h4 id="empName">{{$emp}}</h4>
    
    <hr>
    
    <table id="timesheetTable">
        <tr>
            <th>Sunday</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
            <th>Total</th>
        </tr>
        
        <tr>
            <td>{{$sunday}}</td>
            <td>{{$monday}}</td>
            <td>{{$tuesday}}</td>
            <td>{{$wednesday}}</td>
            <td>{{$thursday}}</td>
            <td>{{$friday}}</td>
            <td>{{$saturday}}</td>
            <td id="totalHours">{{$total}}</td>
        </tr>
        
    </table>
    
    <br/>
    
    <p id="rate">Hourly Rate: $<span id="hourlyRate">{{$rate}}</span></p>
    
    <button id="calculatePayroll" class="portalBtn">Calculate Payroll</button>
    
    <div id="afterCalculate">
        <hr>
        
        <p id="payroll">Calculated Payroll for Last Week: $<span id="payrollAmnt"></span></p>
        
        <a href="/portal-reset-timesheet/{{$id}}"><button id="resetTime" class="portalBtn">Reset Timesheet</button></a>
    </div>
    
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
