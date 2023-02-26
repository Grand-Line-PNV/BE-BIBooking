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

        Welcome to B&I Booking platform!<br>
        Welcome influencer with ID: <strong {{$booking->influencer_id}}</strong> <br>
        You has just receive a campaign with ID:  <strong style="color:'blue'">{{$booking->campaign_id}}</strong> <br>
        Please confirm this booking within 7 days <br>
        Thanks,<br>
        <strong style="color:red'">Brand and Influencer Booking</strong>
    </div>
</body>

</html>