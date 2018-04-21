@extends('layouts.default') 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Logged Google User List</h2>
            </div>
            <div class="pull-right">
            	@if(Session::get('name'))
            	<a class="btn btn-danger" href="{{ route('glogout') }}"> Logout</a>
            	@else
            	<a class="btn btn-danger" href="{{ route('glogin') }}"> Login with Google</a>
            	@endif
            </div>
        </div>
    </div>
    @if (Session::get('name'))
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>email</th>
            <th>Login Time</th>
        </tr>
    @foreach ($users as $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at->diffForHumans() }}</td>
        <td>{{ $user->updated_at->diffForHumans() }}</td>   
    </tr>
    @endforeach
    </table>
    {!! $users->render() !!}
    @endif
@endsection
