<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MoveIt! | @yield('title')</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/css/mdb.min.css" rel="stylesheet" />
    <link href="/css/app.css" rel="stylesheet" />

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" rel="stylesheet" />

    <!-- Fonts -->
    <link href="/css/font-roboto.css" rel="stylesheet" />
    <link href="/css/font-nunito.css" rel="stylesheet" />

    @yield('head')
</head>

<body>
    @yield('content')

    <script src="/js/mdb.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.6.3.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/jquery.min_1.12.4.js"></script>
    <script src="/js/moment.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true,
            });
        });
    </script>
    <script>
        $.datepicker.setDefaults({
            showOn: "both",
            buttonImageOnly: true,
            buttonImage: "calendar.gif",
            buttonText: "Calendar",
            dateFormat: "yy-mm-dd",
            altFormat: "yy-mm-dd",
            appendText: "(yyyy-mm-dd)",
        });
    </script>
    @yield('script')
</body>

</html>
