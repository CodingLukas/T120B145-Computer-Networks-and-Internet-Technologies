@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Redaguoti Renginį</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('events.index') }}" title="Grįžti"> <i
                        class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> <br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>
                        Pavadinimas:</strong>
                    <input type="text" name="name" value="{{ $event->name }}" class="form-control" placeholder="Pavadinimas">
                </div>
                <div class="form-group">
                    <strong>Aktyvumas:</strong>
                    @php
                        $checked = $event->active;
                        if(old('active')) $checked = old('active');
                    @endphp
                    <input type="checkbox" name="active" {{ $checked ? "checked" : "" }}>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Sukurti</button>
            </div>
        </div>

    </form>
@endsection
