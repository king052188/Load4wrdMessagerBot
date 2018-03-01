@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h4>Welcome {{ ucwords(Auth::user()->firstname) .' '. ucwords(Auth::user()->lastname) }}</h4>
                    <p>
                      Sorry, your Web Page Portal is not yet ready,
                      but, you can still Load All Networks,
                      just use SMS Text Command or Facebook Messenger Bot Command.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
