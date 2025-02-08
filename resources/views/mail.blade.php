<!DOCTYPE html>
<html>
<head>
    <title>Winku</title>
</head>
<body>
<h1>{{ $mailData['title'] }}</h1>
<p>{{ $mailData['body'] }}</p>

<p>This is an email confirmation, after signing up in Winku Social Network! <a href='{{url('/email_confirm/'.$mailData['username'])}}'>Confirm your email by clicking the link</a></p>

<p>Thank you</p>
</body>
</html>
