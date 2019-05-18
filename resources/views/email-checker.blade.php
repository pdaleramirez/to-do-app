<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">Email Checker</h1>
                    <div class="card-body">
                        @if (session('gSuiteEmails'))
                            <div class="alert alert-success">
                                <h1>Google Email Domains</h1>
                                <ul>
                                @foreach(session()->get('gSuiteEmails')  as $in)
                                    <li>{{$in}}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif

                            @if (session('otherEmails'))
                            <div class="alert alert-success">
                                <h1>OTHER Email Domains</h1>
                                <ul>
                                @foreach(session()->get('otherEmails')  as $in)
                                    <li>{{$in}}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{ url('email-checker-process')  }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Emails and Domains: </label>
                                <textarea class="form-control" rows="20" cols="40" name="domains">
aodocs.com
aol.com
gigtrooper.com
airbnb.com
fileinvite.com
yahoo.com
gmail.com
                                </textarea>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary mb-2" type="submit" name="submit" value="Submit" />
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>
