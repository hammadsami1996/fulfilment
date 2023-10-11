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
<div class="document">
    <div class="document-body">
        <table class="document-table">
            <thead>
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Sku</th>
                <th>Cost Price</th>
                <th>Selling Price</th>
            </tr>
            </thead>
            <tbody>
{{--            {{dd($model)}}--}}
            @foreach($model as $key=> $item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->sku}}</td>
                    <td>{{$item->cost_price}}</td>
                    <td>{{$item->selling_price}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
