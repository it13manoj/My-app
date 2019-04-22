

<?php
$web = json_decode(file_get_contents(public_path('website/web-setting.info')),true);
$appname=$web['webTitle'];
$appemail=$web['email'];
$companyLogo = url('/website/logo.png');
if(file_exists('/website/'.$web['webLogo'])){
    $companyLogo = url('/website/'.$web['webLogo']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body style="margin: 0;">
    <div style="width: 100%; background: #e5e5e5;padding: 15px 0;">
        <table style="width: 600px; margin: 0 auto; background-color: #ffffff">
            <thead>
                <tr style="width:100%">
                    <td style="background-color:#fff;text-align: center;padding-top: 12px;padding-bottom: 6px; ">
                        <img src="{{ $companyLogo }}">
                    </td>
                </tr>
            </thead>
            <tbody style="padding-left: 20px">
                <tr>
                    <td><h2 style="font-family: Calibri; margin-left: 20px">Hi {{ $name }}</h2></td>
                </tr>
                <tr>
                    <td >
                       <p style="font-family: Calibri; margin-left: 20px">Thank you for Signing up with {{$appname}}</p>
						<p style="font-family: Calibri; margin-left: 20px">Please click the link to verify your email address </p>
						<a style="font-family: Calibri; margin-left: 20px" href="{{url('verifyUser/'.$id)}}">Click to verify</a>
                        <p style="font-family: Calibri; margin-left: 20px"><small><strong>Best Regards,</strong></small></p>
                        <p style="font-family: Calibri; margin-left: 20px"><small><strong>Team {{$appname}}</strong></small></p>
                        <p style="font-family: Calibri; margin-left: 20px"><small>E: {{$appemail}}</small></p>
                        <!-- <p style="font-family: Calibri; margin-left: 20px"><small>Follow us on <a href="https://www.facebook.com/jobsinabad">Facebook</a></small></p>
                        <p style="font-family: Calibri; margin-left: 20px"><small>Follow us on <a href="https://www.linkedin.com/company/jobsinaurangabad/about/">Linkedin</a></small></p> -->
                    </td>
                </tr>
                <tr style="background-color: #e35f14;">
                    <td>
                        <div style="text-align: center; padding-left: 20px; padding-right: 20px; font-family: Calibri; color: #fff;font-size: 12px">
                            <p>{{ $web['webTitle'] }}.<br></p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>