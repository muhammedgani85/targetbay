<style>

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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    
    

    @if (session('status'))
<div class="alert alert-success" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-danger" role="alert">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ session('failed') }}
</div>
@endif

@if (count($errors) > 0)
         <div class = "alert alert-danger" style='color:red;' align='center'>
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif


<div align='center'>
    <h3>Add Car Details</h3>
<form action = "/insertcars" method = "post" enctype='multipart/form-data'>
	<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
	<table>
	<tr>
	<td>Car Year</td>
	<td><input type='text' name='car_year' /></td>
	<tr>
	<td>Model</td>
	<td><input type="text" name='car_model'/></td>
	</tr>
	
	<tr>
	<td>Color</td>
	<td><input type="text" name='car_color'/></td>
	</tr>
    <tr>
	<td>Mileage</td>
	<td><input type="text" name='car_mileage'/></td>
	</tr>


    <tr>
	<td>image</td>
	<td><input type="file" name='img_url'/></td>
	</tr>

	<tr>
	<td colspan = '2'>
	<input type = 'submit' value = "Add Car" class='button'/>
	</td>
	</tr>
	</table>
</form>
</div>
<div align='certer'>
        @if (session()->has('message'))
            <div style='color:green;font-weight:bold;'>
                {{ session('message') }}
            </div>
        @endif
    </div>

</x-app-layout>
<x-app-layout>
    

    
    



</x-app-layout>
