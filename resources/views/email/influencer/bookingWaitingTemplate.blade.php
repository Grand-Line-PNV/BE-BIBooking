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
        Welcome influencer with ID: <strong style = "font-style: italic"> {{$booking->influencer_id}}</strong><br>
        You has just receive a campaign with ID: <strong style="font-style: italic">{{$booking->campaign_id}}</strong> <br>
        Please confirm this booking within <strong style = "font-style: italic">7 </strong>days <br>
        _____________________<br>
        {{$influencer->username}}
        Thank you so much!<br>
        Have a nice day!
        <hr>
        <strong style="color:red; font-style: italic" >Brands and Influencers Booking</strong>
    </div>
</body>
</html>