<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wishlist Report </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container mt-5">
        <table class="table table-bordered" id="sell">
            <thead>
                <tr>
                    <td>Sl.No</td>
                    <td>Name</td>
                    <td>Email </td>
                    <td>Product </td>
                </tr>
            </thead>
            <tbody>
                @php
                $sum = 0;
                @endphp
                @foreach($wishlistReport as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->name ?? '' }}</td>
                    <td>{{ $item->user->email ?? '' }}</td>
                    <td>{{ $item->product->name ?? '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>