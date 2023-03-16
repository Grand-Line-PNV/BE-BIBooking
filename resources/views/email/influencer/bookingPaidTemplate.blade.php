<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        font-size: 16px;
        line-height: 1.5;
        background-color: #f7f7f7;
      }

			.logo {
        max-width: 400px;
        text-align: center;
        display: block;
        margin-left: auto;
        margin-right: auto
			}

      .container {
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url(https://grand-line-storage-test.s3.ap-southeast-1.amazonaws.com/payments/fdaa33d9-ef5e-4f1c-a497-0fce96a730f4.png);				background-repeat: no-repeat;
				background-size:cover;
        margin: 0 auto;
        padding: 80px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
				font-size: 16px;
      }
      
      .header {
        margin-bottom: 20px;
      }

      .header h1 {
        font-size: 30px;
        margin-top: 0 30px;
        font-style: italic;
      }

    </style>

  </head>
  <body>
    <div class="container">
      <div class="wrapper">
      <img src="https://grand-line-storage-test.s3.ap-southeast-1.amazonaws.com/payments/5d57e91b-b3ab-4cd1-870e-e38a73e1d177.png" alt="logo" class="logo">
      <div class="booking-details">
        <p>Dear {{$influencer->username}},</p>
        <p>Congratulations on successfully completing your mission in this campaign. We really appreciate your ability.</p>
        <p>Please find the order information details below:</p>
        <ul>
          <li><strong>You have apply a campaign from Brand with ID:</strong> {{$brand->id}}</li>
          <li><strong>For campaign with ID:</strong> {{$booking->campaign_id}}</li>
          <li><strong>Started date:</strong> {{$booking->started_date}}</li>
          <li><strong>Ended date:</strong> {{$booking->ended_date}}</li>
        </ul>
        <p>We have paid for this campaign to your bank account, please check the message from your bank.</p>
        <p>Thank you for choosing our Platform.</p>
        <p>Please let us know if you have received this message within <strong style = "font-style: italic">7 </strong>days <br>
        <p>If you have any questions, please feel free to contact us at 0398 715 511 or bibooking@gmail.com..</p>
      </div>
      <div class="footer">
        <p>Sincerely,</p>
        <p><strong>B&I Booking Platform</strong></p>
      </div>
      </div>
    </div>
  </body>
</html>