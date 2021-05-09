<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
  </head>
 <body>
    <div class="row">
        <div class="col-md-6">
            <h1>Order Details</h1>
        </div>
    </div>
    <div class="container">
        <table id="customers">
            <tr>
                <th>Order Number</th>
                <th>Qty</th>
                <th>Personal detail</th>
                <th>Order Date</th>
            </tr>
            <tr>
                <td><b>{{$order_details->order_number}}</b></td>
                <td><b>{{$order_details->qty}}</b></td>
                <td>
                    <b>Name:</b> {{ $order_details->firstname}}  {{ $order_details->lastname }}<br/>
                    <b>Email:</b>{{ $order_details->email}}<br/>
                    <b>Phone:</b>{{$order_details->phone}}<br/>
                    <b>Address:</b>{{$order_details->billing_address }}<br/>{{$order_details->state}}-{{$order_details->zip}}<br/>
                </td>
                 <td>{{$order_details->created_at}}</td>
            </tr>
        </table>
    </div>           
</body>
</html>
