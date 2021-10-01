<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 10px 22px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}

</style>
     

<div style='float:right;' class='button'><a href="{{ url('addcars') }}">Add Car </a></div>
<h3 align='center'>List of Cars</h3>
<table>
  <tr>
    <th>Car Year</th>
    <th>Mileage</th>
    <th>Color</th>
    <th>Image</th>
    <th>Action</th>
  </tr>

 @if($cars->isNotEmpty())

  @foreach ($cars as $c)
  <tr>

  
    <td>{{ $c->car_year; }}</td>
    <td>{{ $c->car_mileage; }}</td>
    <td>{{ $c->car_color; }}</td>
    <td><img src={{ $c->img_url; }} style='width:150px;height:150px;' /></td>

    <td><a href="{{ url('edit') }}/{{ $c->id  }}" ><span class="glyphicon glyphicon-pencil">Edit</span></a>&nbsp;| &nbsp;<a href="{{ url('delete') }}/{{ $c->id  }} "><span class="glyphicon glyphicon-trash">Delete</span></a></td>
      
  </tr>
  @endforeach
  @endif
  
</table>


</x-app-layout>
