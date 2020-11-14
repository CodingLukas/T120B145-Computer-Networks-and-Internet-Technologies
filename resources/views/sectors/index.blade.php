@extends('layouts.index')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Sektoriai</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>Numeris</th>
            <th>Iš viso vietų</th>
            <th>Kaina per 1 vietą</th>
        </tr>
        @foreach ($sectors as $sector)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $sector->size }}</td>
                <td>{{ $sector->price_per_seat }} EUR</td>
            </tr>
        @endforeach
    </table>

    {!! $sectors->links() !!}

@endsection
