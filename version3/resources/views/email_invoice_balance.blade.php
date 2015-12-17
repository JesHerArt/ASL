<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Pending Account Balance</h2>

<div>
    <p>Dear {!! $contact !!},</p>
    
    <p>Your pending account balance for December is: <span style="font-weight:bold;">${!! $balance!!}</span>.</p>
    
    <p>Account ID: {!! $id !!}<br/>Account Name: {!! $name !!}</p>
    
    <p>Sincerely, <br/><br/>
    D.C.I. Printing &amp; Graphics, Inc.<br/>
    <a href="mailto:info@dciprinting.com">info@dciprinting.com</a><br/>
    2500 S.W. 107 Avenue, Suite 6<br/>
    Miami, Florida 33165</p>
    
</div>

</body>
</html>