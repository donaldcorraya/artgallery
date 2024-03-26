<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Report </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container mt-5">
        <table class="table table-bordered" id="sell">
            <thead>
                <tr>
                    <td>Sl.No</td>
                    <td>Transaction ID </td>
                    <td>Phone </td>
                    <td>Email </td>
                    <td>Total </td>
                </tr>
            </thead>
            <tbody>
                @php
                $sum = 0;
                @endphp
                @foreach($orderReport as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->transaction_id }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->order_total }}</td>
                    <span class="d-none">{{ $sum += $item->order_total }}</span>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td>Total </td>
                    <td>{{$sum}}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>