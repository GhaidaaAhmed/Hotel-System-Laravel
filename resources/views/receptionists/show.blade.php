@extends('admin.index')
@section('content')

       @if($receptionist)
            <fieldset>
                <legend style="background-color: gray">Manager Info </legend>
                <img src="{{Storage::url($receptionist->avatar)}}" alt="Post-Image" height="300px" width="300px">
                <p>Name : {{ $receptionist->name }}</p>
                <p>Email:{{ $receptionist->email }}</p>
                <p>National Id:{{ $receptionist->national_id }}</p>        
                
               <hr> 
            </fieldset>
            
       @endif
@endsection