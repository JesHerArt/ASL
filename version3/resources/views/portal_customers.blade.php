@extends('portal')

@section('title')
Customer Accounts - Employee Portal | DCI Printing &amp; Graphics, Inc. 
@stop

@section('empName')
<a href="/portal-settings">{{$name}}</a>
@stop

@section('content')
<h2>Customer Accounts</h2>

<div class="row decorativeBar">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 blk bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 cyn bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mag bar"></div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ylw bar"></div>
</div>

<div id="settingsBox">
    <h3>Open Accounts</h3>
    
    <table id="customersTable">
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Address</th>
            <th>Contacts</th>
            <th>Balance</th>
            <th>Actions</th>
        </tr>
        
        @foreach ($accounts as $accnt)
            <tr>
                <td>{{$accnt['id']}}</td>
                <td class="empsName">{{$accnt['name']}}</td>
                <td>
                @if ( $accnt['id'] != 9 )
                    {{$accnt['streetAddress']}}<br/>{{$accnt['city']}}, {{$accnt['state']}} {{$accnt['zipcode']}}
                @endif
                </td>
                <td>
                <?php $count = 1; ?>
                @foreach ($accnt['contacts'] as $contact)
                    {{$contact['name']}}
                    @if ( $count != count($accnt['contacts']) )
                        ,<br/>
                        <?php $count++; ?>
                    @endif
                @endforeach
                </td>
                <td>${{$accnt['balance']}}</td>
                <td>
                @if ( $accnt['id'] != 9 )
                    <a href="#"><span class="empTime">View Customer</span></a> | <a href="portal-email-balance/{{$accnt['id']}}"><span class="editEmp">Email Stmt.</span></a> | <a href="/portal-delete-accnt/{{$accnt['id']}}"><span class="delEmp">Close Accnt.</span></a>
                @endif
                </td>
            </tr>
        @endforeach
        
    </table>
    
    @if ( count($closed) > 0 )
    
    <br/>
    
    <hr>
    
    </br>
    
    <h3>Closed Accounts</h3>
    
    <table id="customersTable">
        <tr>
            <th>ID</th>
            <th>Company Name</th>
            <th>Address</th>
            <th>Contacts</th>
            <th>Balance</th>
            <th>Actions</th>
        </tr>
        
        @foreach ($closed as $accnt)
            <tr>
                <td>{{$accnt['id']}}</td>
                <td class="empsName">{{$accnt['name']}}</td>
                <td>
                @if ( $accnt['id'] != 9 )
                    {{$accnt['streetAddress']}}<br/>{{$accnt['city']}}, {{$accnt['state']}} {{$accnt['zipcode']}}
                @endif
                </td>
                <td>
                <?php $count = 1; ?>
                @foreach ($accnt['contacts'] as $contact)
                    {{$contact['name']}}
                    @if ( $count != count($accnt['contacts']) )
                        ,<br/>
                        <?php $count++; ?>
                    @endif
                @endforeach
                </td>
                <td>${{$accnt['balance']}}</td>
                <td><a href="#"><span class="empTime">View Customer</span></a> | <a href="portal-email-balance/{{$accnt['id']}}"><span class="editEmp">Email Stmt.</span></a> | <a href="/portal-restore-accnt/{{$accnt['id']}}"><span class="delEmp">Restore Accnt.</span></a></td>
            </tr>
        @endforeach
        
    </table>
    
    @endif
    
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
        $('#customers').css('background','white').css('color','#ed008c').css('border-color','#00adef');
    });
</script>
@stop
