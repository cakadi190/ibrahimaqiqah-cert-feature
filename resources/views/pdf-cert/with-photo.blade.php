<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
        }

        html {
            -webkit-print-color-adjust: exact;
        }

        @font-face {
            font-family: 'Roca';
            src: url("{{ storage_path('fonts/roca-heavy.ttf') }}") format('truetype');
            font-weight: 900;
            font-style: normal;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url("{{ storage_path('fonts/montserrat-regular.ttf') }}") format('truetype');
            font-weight: 400;
            font-style: normal;
        }

        .image-base {
            position: absolute;
            width: 100%;
            z-index: 1;
            aspect-ratio: 210/297;
        }

        .cert-name {
            position: absolute;
            width: 100%;
            margin: 0 auto;
            bottom: 25rem;
            text-align: center;
            font-size: 2.5rem;
            z-index: 2;
            color: #a97420;
            font-weight: 900;
            font-family: 'Roca', Arial, Helvetica, sans-serif;
        }

        .cert-parent-name {
            position: absolute;
            width: 100%;
            margin: 0 auto;
            bottom: 18.5rem;
            color: #a97420;
            text-align: center;
            font-size: 1.5rem;
            z-index: 2;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/cert-images/cert-with-photo.png'))) }}"
        class="image-base" />

    <div class="cert-name">Nama Lengkap</div>
    <div class="cert-parent-name">Nama dari orang tuanya</div>
</body>

</html>