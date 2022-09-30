<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Calender</title>
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css" />
    </head>
    <style type="text/css">
        .months-container{
            height: 600px;
        }
    </style>
    <body>
        
        <div id="container">
        <div class="calendar"></div>
        </div>
    <script src="https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js"></script>
    <script>
        new Calendar(document.querySelector('.calendar'));
    </script>
    </body>
</html>