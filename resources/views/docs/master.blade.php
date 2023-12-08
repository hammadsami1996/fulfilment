<!DOCTYPE html>
<html>
<head>
{{--    <link rel="stylesheet" type="text/css" href="{{base_path('public'.mix('css/print.css')->toHtml())}}">--}}
    <link rel="stylesheet" type="text/css" href="{{mix('css/print.css')->toHtml()}}">

    <style>


        a,
        abbr,
        acronym,
        address,
        applet,
        article,
        aside,
        audio,
        b,
        big,
        blockquote,
        body,
        canvas,
        caption,
        center,
        cite,
        code,
        dd,
        del,
        details,
        dfn,
        dialog,
        div,
        dl,
        dt,
        em,
        embed,
        fieldset,
        figcaption,
        figure,
        font,
        footer,
        form,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        header,
        hgroup,
        hr,
        html,
        i,
        iframe,
        img,
        ins,
        kbd,
        label,
        legend,
        li,
        main,
        mark,
        menu,
        meter,
        nav,
        object,
        ol,
        output,
        p,
        pre,
        progress,
        q,
        rp,
        rt,
        ruby,
        s,
        samp,
        section,
        small,
        span,
        strike,
        strong,
        sub,
        summary,
        sup,
        table,
        tbody,
        td,
        tfoot,
        th,
        thead,
        time,
        tr,
        tt,
        u,
        ul,
        var,
        video,
        xmp {
            border: 0;
            margin: 0;
            padding: 0;
            font-size: 100%;
        }

        html,
        body {
            height: 100%;
        }

        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        main,
        menu,
        nav,
        section {
            display: block;
        }

        b,
        strong {
            font-weight: bold;
        }

        img {
            color: transparent;
            font-size: 0;
            vertical-align: middle;
            -ms-interpolation-mode: bicubic;
        }

        ul,
        ol {
            list-style: none;
        }

        li {
            display: list-item;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        th,
        td,
        caption {
            font-weight: normal;
            vertical-align: top;
            text-align: left;
        }

        q {
            quotes: none;
        }

        q:before,
        q:after {
            content: "";
            content: none;
        }

        sub,
        sup,
        small {
            font-size: 80%;
        }

        sub,
        sup {
            line-height: 0;
            position: relative;
            vertical-align: baseline;
        }

        sub {
            bottom: -0.25em;
        }

        sup {
            top: -0.5em;
        }

        svg {
            overflow: hidden;
        }

        ::-webkit-scrollbar {
            width: 8px;
            border-radius: 10px;
            background-color: #000000 !important;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #4267B2 !important;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            border-radius: 10px;
            background-color: #000000 !important;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 400;
        }

        hr {
            background: none;
            border-top: 1px solid #eee;
            margin: 20px 0;
        }

        a {
            text-decoration: none;
            color: #484746;
            text-transform: uppercase;
        }

        p {
            padding-bottom: 5px;
        }

        pre {
            color: #484746;
            font-family: Roboto, Helvetica, Arial, sans-serif;
            font-size: inherit;
            background: transparent;
            border: none;
            padding: 0;
            margin: 0;
            vertical-align: top;
            display: block;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        h4 {
            font-size: 15px;
            font-weight: bold;
        }

        h3 {
            font-size: 18px;
            font-weight: bold;
        }

        h2 {
            font-size: 20px;
            font-weight: bold;
        }

        h1 {
            font-size: 22px;
            font-weight: bold;
        }

        .mt-6 {
            margin-top: 29px !important;
        }

        .f-16 {
            font-size: 16px !important;
        }

        .hidden {
            display: none !important;
        }

        .h-51 {
            height: 51px !important;
        }

        .pointer {
            cursor: pointer;
        }

        .ctx-menu li:hover {
            background-color: #eee !important;
            font-weight: 600;
        }

        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            color: #484746;
            font-family: Roboto, Helvetica, Arial, sans-serif;
            font-size: 14px;
            line-height: 1.2em;
            padding: 25px;
            text-transform: uppercase;
        }

        .document-table tbody tr {
            page-break-inside: avoid;
            page-break-after: auto;
            text-transform: uppercase;
        }

        .document-body {
            padding: 15px 0px;
            text-transform: uppercase;
        }

        .document-summary {
            width: 100%;
            border-collapse: collapse;
            text-transform: uppercase;
        }

        .document-summary tbody tr td {
            vertical-align: top;
            padding-bottom: 5px;
            text-align: right;
            text-transform: uppercase;
        }

        .document-summary tbody tr td:nth-child(2n) {
            padding-left: 15px;
            text-transform: uppercase;
        }

        .align-center {
            text-align: center !important;
        }

        .align-left {
            text-align: left !important;
        }

        .align-right {
            text-align: right !important;
        }

        .document-type {
            text-align: center;
            padding: 5px;
            margin-bottom: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .document-blue {
            background: #3aa3e3;
            color: #fff;
        }

        .document-orange {
            background: #FF9800;
            color: #fff;
        }

        .document-red {
            background: #E75650;
            color: #fff;
        }

        .document-blue_light {
            background: #48606f;
            color: #fff;
        }

        .document-green {
            background: #66bb6a;
            color: #fff;
        }

        .document-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #eee;
        }

        .document-table thead tr th {
            padding: 7px 5px;
            background: #eee;
            color: #4267B2;
            font-weight: bold;
            border: 2px solid #fff;
        }

        .document-table thead tr th:first-child {
            border-radius: 10px 0 0 10px;
        }

        .document-table thead tr th:last-child {
            border-right: none;
        }

        .document-table tbody tr {
            border-top: 1px solid #eee;
        }

        .document-table tbody tr td {
            vertical-align: top;
            padding: 8px;
            border-bottom: 1px solid #eee;
            border-right: 1px solid #eee;
            text-transform: uppercase;
        }

        .document-table tbody tr td:last-child {
            border-right: none;
        }

        .document-table tbody tr:last-child {
            border-bottom: 1px solid #eee;
        }

        .document-table tfoot tr {
            border: 1px solid #eee;
        }

        .document-table tfoot tr td {
            border-right: 1px solid #eee;
            vertical-align: top;
            padding: 10px 7px 5px 10px;
            text-transform: uppercase;
        }

        .document-table tfoot tr td:last-child {
            border-right: 1px solid #eee;
        }

        .document-table tfoot tr td:nth-child(2n) {
            text-align: right;
        }

        .document-print-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }

        .document-print-table thead tr {
            border-bottom: 1px solid black;
        }

        .document-print-table thead tr th {
            padding: 7px 5px;
            background: #eee;
            color: #4267B2;
            font-weight: bold;
            border: 1px solid black;
        }

        .document-print-table thead tr th:first-child {
            border-radius: 10px 0 0 10px;
        }

        .document-print-table thead tr th:last-child {
            border-right: none;
        }

        .document-print-table tbody tr {
            border-bottom: 1px solid black;
        }

        .document-print-table tbody tr td {
            vertical-align: top;
            padding: 8px;
            border-bottom: 1px solid black;
            border-right: 1px solid black;
            text-transform: uppercase;
        }

        .document-print-table tbody tr td:last-child {
            border-right: none;
        }

        .document-print-table tbody tr:last-child {
            border-bottom: 1px solid black;
        }

        .document-print-table tfoot tr {
            border: 1px solid black;
        }

        .document-print-table tfoot tr td {
            border-right: 1px solid black;
            vertical-align: top;
            padding: 10px 7px 5px 10px;
            text-transform: uppercase;
        }

        .document-print-table tfoot tr td:last-child {
            border-right: 1px solid black;
        }

        .document-print-table tfoot tr td:nth-child(2n) {
            text-align: right;
        }

        .document-term {
            margin-top: 4px;
        }

        .document-term strong {
            font-size: 80%;
            line-height: 1.2em;
        }

        .document-term pre {
            font-size: 80%;
            line-height: 1.2em;
        }

        .row {
            width: 100%;
        }

        .row:before,
        .row:after {
            content: " ";
            /* 1 */
            display: table;
            /* 2 */
        }

        .row:after {
            clear: both;
        }

        .col {
            float: left;
        }

        .col-1 {
            width: 8.33%;
        }

        .col-2 {
            width: 16.66%;
        }

        .col-3 {
            width: 25%;
        }

        .col-4 {
            width: 33.33%;
        }

        .col-5 {
            width: 41.66%;
        }

        .col-6 {
            width: 50%;
        }

        .col-7 {
            width: 58.33%;
        }

        .col-8 {
            width: 66.66%;
        }

        .col-9 {
            width: 75%;
        }

        .col-10 {
            width: 83.33%;
        }

        .col-11 {
            width: 91.66%;
        }

        .col-12 {
            width: 100%;
        }

        .width-1 {
            width: 8.33%;
        }

        .width-2 {
            width: 16.66%;
        }

        .width-3 {
            width: 25%;
        }

        .width-4 {
            width: 33.33%;
        }

        .width-5 {
            width: 41.66%;
        }

        .width-6 {
            width: 50%;
        }

        .width-7 {
            width: 58.33%;
        }

        .width-8 {
            width: 66.66%;
        }

        .width-9 {
            width: 75%;
        }

        .width-10 {
            width: 83.33%;
        }

        .width-11 {
            width: 91.66%;
        }

        .width-12 {
            width: 100%;
        }

        .document-heading {
            line-height: 1.6em;
        }

        .document-attachment {
            page-break-before: always;
            text-align: center;
        }

        .document-attachment img {
            page-break-inside: avoid;
            max-width: 100%;
            max-height: 800px;
        }

        .item-tax td {
            background: #fff;
            text-align: right;
            color: #263c68;
        }

        .item-serial td {
            background: #fff;
            text-align: right;
            color: #263c68;
        }

        .item-footer {
            border: none !important;
            background: none !important;
        }

        .item-footer td {
            border: none !important;
            text-align: right !important;
        }

        .overflow-hidden {
            overflow: hidden;
        }

        .overflow-x-hidden {
            overflow-x: hidden;
        }

        .overflow-y-hidden {
            overflow-y: hidden;
        }

        .right {
            float: right !important;
        }

        .left {
            float: left !important;
        }

        .mx-auto {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        .ma-0 {
            margin: 0 0 !important;
        }

        .my-0 {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        .mx-0 {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .mt-0 {
            margin-top: 0 !important;
        }

        .mr-0 {
            margin-right: 0 !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .ml-0 {
            margin-left: 0 !important;
        }

        .pa-0 {
            padding: 0 0 !important;
        }

        .py-0 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        .px-0 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .pt-0 {
            padding-top: 0 !important;
        }

        .pr-0 {
            padding-right: 0 !important;
        }

        .pb-0 {
            padding-bottom: 0 !important;
        }

        .pl-0 {
            padding-left: 0 !important;
        }

        .ma-1 {
            margin: 4px 4px !important;
        }

        .my-1 {
            margin-top: 4px !important;
            margin-bottom: 4px !important;
        }

        .mx-1 {
            margin-left: 4px !important;
            margin-right: 4px !important;
        }

        .mt-1 {
            margin-top: 4px !important;
        }

        .mr-1 {
            margin-right: 4px !important;
        }

        .mb-1 {
            margin-bottom: 4px !important;
        }

        .ml-1 {
            margin-left: 4px !important;
        }

        .pa-1 {
            padding: 4px 4px !important;
        }

        .py-1 {
            padding-top: 4px !important;
            padding-bottom: 4px !important;
        }

        .px-1 {
            padding-left: 4px !important;
            padding-right: 4px !important;
        }

        .pt-1 {
            padding-top: 4px !important;
        }

        .pr-1 {
            padding-right: 4px !important;
        }

        .pb-1 {
            padding-bottom: 4px !important;
        }

        .pl-1 {
            padding-left: 4px !important;
        }

        .ma-2 {
            margin: 8px 8px !important;
        }

        .my-2 {
            margin-top: 8px !important;
            margin-bottom: 8px !important;
        }

        .mx-2 {
            margin-left: 8px !important;
            margin-right: 8px !important;
        }

        .mt-2 {
            margin-top: 8px !important;
        }

        .mr-2 {
            margin-right: 8px !important;
        }

        .mb-2 {
            margin-bottom: 8px !important;
        }

        .ml-2 {
            margin-left: 8px !important;
        }

        .pa-2 {
            padding: 8px 8px !important;
        }

        .py-2 {
            padding-top: 8px !important;
            padding-bottom: 8px !important;
        }

        .px-2 {
            padding-left: 8px !important;
            padding-right: 8px !important;
        }

        .pt-2 {
            padding-top: 8px !important;
        }

        .pr-2 {
            padding-right: 8px !important;
        }

        .pb-2 {
            padding-bottom: 8px !important;
        }

        .pl-2 {
            padding-left: 8px !important;
        }

        .ma-3 {
            margin: 16px 16px !important;
        }

        .my-3 {
            margin-top: 16px !important;
            margin-bottom: 16px !important;
        }

        .mx-3 {
            margin-left: 16px !important;
            margin-right: 16px !important;
        }

        .mt-3 {
            margin-top: 16px !important;
        }

        .mr-3 {
            margin-right: 16px !important;
        }

        .mb-3 {
            margin-bottom: 16px !important;
        }

        .ml-3 {
            margin-left: 16px !important;
        }

        .pa-3 {
            padding: 16px 16px !important;
        }

        .py-3 {
            padding-top: 16px !important;
            padding-bottom: 16px !important;
        }

        .px-3 {
            padding-left: 16px !important;
            padding-right: 16px !important;
        }

        .pt-3 {
            padding-top: 16px !important;
        }

        .pr-3 {
            padding-right: 16px !important;
        }

        .pb-3 {
            padding-bottom: 16px !important;
        }

        .pl-3 {
            padding-left: 16px !important;
        }

        .ma-4 {
            margin: 24px 24px !important;
        }

        .my-4 {
            margin-top: 24px !important;
            margin-bottom: 24px !important;
        }

        .mx-4 {
            margin-left: 24px !important;
            margin-right: 24px !important;
        }

        .mt-4 {
            margin-top: 24px !important;
        }

        .mr-4 {
            margin-right: 24px !important;
        }

        .mb-4 {
            margin-bottom: 24px !important;
        }

        .ml-4 {
            margin-left: 24px !important;
        }

        .pa-4 {
            padding: 24px 24px !important;
        }

        .py-4 {
            padding-top: 24px !important;
            padding-bottom: 24px !important;
        }

        .px-4 {
            padding-left: 24px !important;
            padding-right: 24px !important;
        }

        .pt-4 {
            padding-top: 24px !important;
        }

        .pr-4 {
            padding-right: 24px !important;
        }

        .pb-4 {
            padding-bottom: 24px !important;
        }

        .pl-4 {
            padding-left: 24px !important;
        }

        .ma-5 {
            margin: 48px 48px !important;
        }

        .my-5 {
            margin-top: 48px !important;
            margin-bottom: 48px !important;
        }

        .mx-5 {
            margin-left: 48px !important;
            margin-right: 48px !important;
        }

        .mt-5 {
            margin-top: 48px !important;
        }

        .mr-5 {
            margin-right: 48px !important;
        }

        .mb-5 {
            margin-bottom: 48px !important;
        }

        .mb-6 {
            margin-bottom: 58px !important;
        }

        .mb-7 {
            margin-bottom: 68px !important;
        }

        .mb-8 {
            margin-bottom: 78px !important;
        }

        .ml-5 {
            margin-left: 32px !important;
        }

        .ml-6 {
            margin-left: 40px !important;
        }

        .pa-5 {
            padding: 48px 48px !important;
        }

        .py-5 {
            padding-top: 48px !important;
            padding-bottom: 48px !important;
        }

        .px-5 {
            padding-left: 48px !important;
            padding-right: 48px !important;
        }

        .pt-5 {
            padding-top: 48px !important;
        }

        .pt-50 {
            padding-top: 50px;
        }

        .pr-5 {
            padding-right: 48px !important;
        }

        .pb-5 {
            padding-bottom: 48px !important;
        }

        .pl-5 {
            padding-left: 48px !important;
        }

        .ml-auto {
            margin-left: auto !important;
        }

        .mt-50 {
            margin-top: 50px !important;
        }


    </style>
</head>
<body>


<style>
    @page {
        header: html_Header;
        footer: html_Footer;

    }

    #background {
        position: absolute;
        top: 0;
        z-index: -100;
        left: 0;
        width: 100%;
        height: 100%;
    }


</style>

<htmlpageheader name="Header">
    <div id="background">
{{--        <img src="{{storage_path('app/uploads/'.$options['header'] )}}">--}}
    </div>

</htmlpageheader>


@yield('content')
<htmlpagefooter name="Footer">
{{--    <img src="{{storage_path('app/uploads/'.$options['footer'] )}}">--}}

    <p style="font-style: italic;text-align: right">Printed By: {{auth()->user()->name}}</p>
    <p style="font-style: italic;text-align: right">Printed On: {{date('d-m-Y h:i:s')}}</p>


    <div><!--mpdf   {PAGENO}  of  {nbpg} mpdf--></div>

</htmlpagefooter>
</body>
</html>

