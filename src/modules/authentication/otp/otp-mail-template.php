<html>

<head>
  <style>
    body {
      background-color: #f2f2f2;
    }

    .container {
      padding: 20px;
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      background-image: url("https://images.pexels.com/photos/7130498/pexels-photo-7130498.jpeg?cs=srgb&dl=pexels-codioful-%28formerly-gradienta%29-7130498.jpg&fm=jpg");
      background-size: cover;
      background-position: center;
      color: white;
      padding: 10px;
      border-radius: 5px 5px 0 0;
      height: 55px;
    }

    .content {
      padding: 20px;
    }

    .footer {
      padding: 10px;
      text-align: center;
      color: #999999;
    }

    .otp {
      font-size: 2rem;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h2>OTP Verification</h2>
    </div>
    <div class="content">
      <p>Hello {{name}},</p>
      <p>Your OTP for verification is: <strong class="otp">{{otp}}</strong></p>
      <p>Please use this OTP within the next 10 minutes to complete the verification process.</p>
    </div>
    <div class="footer">
      <p>If you did not request this OTP, please ignore this email.</p>
    </div>
  </div>
</body>

</html>