<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="p-6 mb-6">
    <label class="upper-underline-label uppercase ">
        Perpared By
    </label>
</div>
</body>
</html>
<style>
    .upper-underline-label {
        position: relative;
        display: inline-block;
    }

    .upper-underline-label::before {
        content: '';
        position: absolute;
        top: -2px;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: blue; /* Customize the underline color here */
    }

    .lower-text {

        display: block;
        margin-top: 5px; /* Adjust the margin to control the spacing between the underline and the lower text */
    }
</style>








