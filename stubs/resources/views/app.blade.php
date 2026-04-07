<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ Module }} – Admin</title>

    <link rel="icon" href="{{ asset('third-party/{{ module }}/favicon.png') }}" type="image/png">

    <link nonce={{ $nonce }} href="{{ module_mix('css/app.css') }}" rel="stylesheet">

    <x-{{ module }}-translator />
    @inertiaHead
</head>
<body>
    @inertia
    <script nonce={{ $nonce }} src="{{ module_mix('js/app.js') }}"></script>
</body>

</html>
