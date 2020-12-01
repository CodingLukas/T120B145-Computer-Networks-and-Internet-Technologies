@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Vartotojų valdymas</h2>
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
            <th>No</th>
            <th>Vardas</th>
{{--            <th>Pradžios Data</th>--}}
{{--            <th>Pabaigos Data</th>--}}
            <th>Lygis</th>
            <th width="280px">Veiksmai</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
{{--                <td>{{ date_format($user->start_date, 'jS M Y') }}</td>--}}
{{--                <td>{{ date_format($user->end_date, 'jS M Y') }}</td>--}}
                <td>{{ $user->user_level == 0 ? "Vartotojas" : "Redaktorius" }}</td>
                <td>
                    <form action="{{ route('events.destroy', $user->id) }}" method="POST">

                        <a href="{{ route('users.edit', $user->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>

                        </a>

                        @csrf

                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
