
@extends('layouts.app')
@section('content')
<center>

@if($user->registered_by>0)
<h1>My Reservations</h1><br>
<a href="/client/freerooms" >
   <button class="btn-success">New Reservation</button></a></center>
   <br><table class="table table-striped">
        <th><strong> Room Number </strong></th>
        <th><strong> Accompany Number </strong></th>
        <th><strong> Paid Price </strong></th>

        @foreach ($reservations as $reservation)
        <tr>
<td> {{ $reservation->number }} </td>
<td> {{ $reservation->pivot->accompany_number }} </td>
<td > {{ $reservation->pivot->client_paid_price/100 }} $</td>

@endforeach

        </tr>
        </table>

@else
        <h1>You will be approved soon :)</h1>

 @endif 
        @endsection