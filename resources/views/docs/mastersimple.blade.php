<!DOCTYPE html>
<html>
<head>
{{--    <link rel="stylesheet" type="text/css" href="{{mix('css/print.css')->toHtml()}}">--}}
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    {{--    <link rel="stylesheet" type="text/css" href="{{base_path('public'.mix('css/print.css')->toHtml())}}">--}}
</head>
<body style=" text-transform: uppercase">


<style>
    @page {
        header: html_Header;
        footer: html_Footer;

    }

    .page-break {
        page-break-after: always !important;
    }

    #background {
        position: absolute;
        top: 30;
        z-index: -100;
        /*left:50;*/
        width: 200px;

    }


</style>

<htmlpageheader name="Header">
    <div id="background">
{{--        <img src="{{storage_path('app/uploads/'.$options['header'] )}}">--}}
        {{--        {{Settings()->get('company_address')}}--}}
    </div>
</htmlpageheader>


@yield('content')

<htmlpagefooter name="Footer">
    <p style="font-style: italic;text-align: right">Printed By: {{auth()->user()->name}}</p>
    <p style="font-style: italic;text-align: right">Printed On: {{date('d-m-Y h:i:s')}}</p>


    {{--    <div class="row">{PAGENO} of {nbpg}</div>--}}
</htmlpagefooter>
</body>
</html>

