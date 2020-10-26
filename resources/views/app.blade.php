<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{ mix('/sass/app.css') }}" rel="stylesheet" />
        @routes
        <script src="/js/app.js" defer></script>
    </head>
    <body>
        @inertia
    </body>
</html>
