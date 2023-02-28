<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[B&I] Notification</title>
</head>
<body>
    <div>

        Welcome to B&I Booking platform!<br>
        <hr>
        You has just receive an application from influencer with ID: <strong style="color:'blue'">{{$booking->influencer_id}}</strong> 
        For campaign with ID: <strong style="color:'blue'">{{$booking->campaign_id}}</strong> <br>
        Please confirm this booking within 7 days <br>
        Thanks!<br>
        <hr>
        <strong style="color:red'">Brand and Influencer Booking</strong>
    </div>
</body>
</html>