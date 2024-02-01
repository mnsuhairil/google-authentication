<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Google Sign-In Example</title>

    <!-- Load the Google Platform Library -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!-- Specify your app's client ID -->
    <meta name="google-signin-client_id" content="{{ config('services.google.client_id') }}">
</head>

<body>
    <div id="g_id_onload" data-client_id="383661819068-bf4c6i1l3kj0d60askfnh99olimp4ccr.apps.googleusercontent.com"
        data-context="signin" data-ux_mode="popup" data-login_uri="https://zlbqzwx8-8000.asse.devtunnels.ms/"
        data-auto_prompt="false">
    </div>

    <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline" data-text="signin_with"
        data-size="large" data-logo_alignment="left">
    </div>
</body>

</html>