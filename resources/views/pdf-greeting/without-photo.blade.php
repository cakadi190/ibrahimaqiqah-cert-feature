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

        @page {
            size: 35.59cm 21.59cm;
        }

        @font-face {
            font-family: 'Roca';
            src: url("{{ storage_path('fonts/roca-bold.ttf') }}") format('truetype');
            font-weight: 900;
            font-style: normal;
        }

        @font-face {
            font-family: 'Montserrat';
            src: url("{{ storage_path('fonts/montserrat-font.ttf') }}") format('truetype');
            font-weight: 700;
            font-style: normal;
        }

        .image-base {
            position: absolute;
            height: 100%;
            z-index: 1;
        }

        .cardWrapper {
            position: absolute;
            width: 8.175cm;
            z-index: 2;
            height: 10.785cm;
        }

        /** Element 0 */
        .cardWrapper-0 {
            left: 0;
            top: 0;
        }

        /** Element 1 */
        .cardWrapper-1 {
            left: 8.375cm;
            top: 0;
        }

        /** Element 2 */
        .cardWrapper-2 {
            left: 16.75cm;
            top: 0;
        }

        /** Element 3 */
        .cardWrapper-3 {
            left: 25.125cm;
            top: 0;
        }

        /** Element 4 */
        .cardWrapper-4 {
            left: 0;
            bottom: 0;
        }

        /** Element 5 */
        .cardWrapper-5 {
            left: 8.375cm;
            bottom: 0;
        }

        /** Element 6 */
        .cardWrapper-6 {
            left: 16.75cm;
            bottom: 0;
        }

        /** Element 7 */
        .cardWrapper-7 {
            left: 25.125cm;
            bottom: 0;
        }

        .cert-name {
            position: absolute;
            margin: 0 auto;
            width: 100%;
            top: 6.125cm;
            text-align: center;
            font-size: 0.4cm;
            z-index: 2;
            color: #a97420;
            font-weight: 900;
            font-family: 'Roca', Arial, Helvetica, sans-serif;
        }

        .cert-parent-name {
            position: absolute;
            font-weight: 700;
            margin: 0 auto;
            width: 100%;
            top: 7.6cm;
            color: #a97420;
            text-align: center;
            font-size: 0.25cm;
            z-index: 2;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        }

        .cert-birthdate {
            position: absolute;
            width: 100%;
            font-weight: 700;
            margin: 0 auto;
            top: 7cm;
            color: #8ba8c7;
            text-align: center;
            font-size: 0.175cm;
            z-index: 2;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        }

        .cert-aqiqah-date {
            position: absolute;
            width: 100%;
            font-weight: 700;
            margin: 0 auto;
            bottom: 2cm;
            color: #8ba8c7;
            text-align: center;
            font-size: 0.25cm;
            z-index: 2;
            font-family: 'Montserrat', Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/cert-images/female-greeting-without-photo.jpg'))) }}"
        class="image-base" />

    @for ($i = 0; $i < 8; $i++) <div class="cardWrapper cardWrapper-{{ $i }}">
        <div class="cert-name">Nama Lengkap</div>
        <div class="cert-parent-name">Nama dari orang tuanya</div>
        <div class="cert-birthdate">Lahir: Kota/Kab., 01 Januari 1970</div>
        <div class="cert-aqiqah-date">Aqiqah: Hari, 01 Januari 1970</div>
        </div>
        @endfor
</body>

</html>