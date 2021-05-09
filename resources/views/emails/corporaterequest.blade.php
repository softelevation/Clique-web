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
            <h1>Corporate Request</h1>
        </div>
    </div>
    <div class="container">
        <table id="customers">
            <tr>
                <th>corporate_name</th>
                <th>contact_person</th>
                <th>address</th>
                <th>email</th>
                <th>phone</th>
                <th>created_at</th>
            </tr>
            <tr>
                <td>{{$request_details->corporate_name}}</td>
                <td>{{$request_details->contact_person}}</td>
                <td>{{$request_details->address}}</td>
                <td>{{$request_details->email}}</td>
                <td>{{$request_details->phone}}</td>
                <td>{{$request_details->created_at}}</td>
            </tr>
        </table>
    </div>
</body>
</html>
