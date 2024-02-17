<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naac</title>
    <style>
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .header {
            margin-bottom: 20px;
        }

        .logo {
            max-width: 100px;
        }

        .content {
            margin-bottom: 20px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }
        p{
            color:green;
        }
    </style>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif;">

    <div class="container">

        <!-- Header with Logo -->
        <div class="header">
            <!-- Logo -->
           <img src=https://vajiram-prod.s3.ap-south-1.amazonaws.com/National_Assessment_and_Accreditation_Council_NAAC_656d79c7e8.jpeg alt="Company Logo" class="logo"> 
            <h1>{{ env('APP_NAME') }}</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Grievance Raise Title  {{ $email_temp->title }}</p>
            <h5>Your Tracking Code  {{ $email_temp->grievance_code }}</h5>
                <p>Hello Mr/Mis  {{ $email_temp->applicant->user_name }}</p>
                <h4>Action Taken  {{ $email_temp->grievances->first()->message }}</h4>

           
        </div> 

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 NAAC. All rights reserved.</p>
        </div>

    </div>

</body>

</html>


