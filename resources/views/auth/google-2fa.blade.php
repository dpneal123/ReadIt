@section('title', 'Google Authentication')
@extends('layouts.app', ['header' => 'Google Authentication'])

@section('content')
    <br><br>
    <div class="container" style="align-items: center;">
        <div class="row">
            <div class="col-md">
                <div class="panel panel-default">
                    <div class="panel-heading">Set up Google Authenticator</div>
<br>
                    <div class="panel-body content-center" style="text-align: center; align-items: center;">
                        <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code {{ $secret }}</p>
                        <div>
                            <center>{!! $inlineURL !!}</center>
                        </div>
                        <p>You must set up your Google Authenticator app before continuing. You will be unable to login otherwise</p>
                        <div>
                            <a class="p-4" href="/complete-registration"><button class="btn-primary">Complete Registration</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
