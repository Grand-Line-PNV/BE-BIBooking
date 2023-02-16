<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>

        The body of your message.<br>
        Welcome {{$user->username}}<br>
        Your OTP is <strong style="color:'blue'">{{$otp}}</strong> will be expired for 60 seconds

        Thanks,<br>
        <strong style="color:'red'">Brand and Influencer Booking</strong>
    </div>
</body>

</html>