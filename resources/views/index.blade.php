@extends('layouts.index')

@section('content')
    <div class="container">

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
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

        @if($event)

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Renginio "{{$event->name}}" laisvos vietos sektoriuose</h2>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-responsive-sm">
                <tr>
                    <th>Numeris</th>
                    <th>Laisvų vietų skaičius</th>
                </tr>
                @php($i = 0)
                @foreach ($sectors as $sector)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $sector->getFreeCount($event->getId()) }}</td>
                    </tr>
                @endforeach
            </table>


            @if(Auth::user())

                <script>
                    var prices = [];
                    @foreach ($sectors as $sector)
                        prices[prices.length] = {{ $sector->getPricePerSeat() }};
                    @endforeach

                    $(document).ready(function () {
                        $('.sector').bind('keyup mouseup', function () {
                            let totalAmount = calculateTotal();
                            $('#totalPrice').html(totalAmount);
                        });
                    })

                    function calculateTotal() {
                        let total = 0.00;
                        for (i = 0; i < prices.length; i++) {
                            let amount = $('#sector-' + i).val();
                            total += amount * prices[i];
                        }
                        return total;
                    }

                </script>

                <style>
                    .table2 {
                        margin: auto;
                        width: 50% !important;
                    }
                </style>

                <form action="{{ route('tickets.create', ['eventId' => $event->id]) }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="row justify-content-center">

                        <div class="row">
                            <div class="col-lg-12 margin-tb">
                                <div class="pull-left">
                                    <h2>Rezervuoti bilietus renginiui: "{{$event->name}}"</h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <table class="table2 table-sm table-bordered table-responsive-sm">
                                <tr>
                                    <th>Sektoriaus numeris</th>
                                    <th>Rezervuojamas kiekis</th>
                                </tr>
                                @php($i = 0)
                                @foreach ($sectors as $sector)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            <input name="sector-{{$i-1}}" class="form-control sector" type="number"
                                                   value="{{old('sector-'.($i-1)) ? old('sector-'.($i-1)) : 0}}" min="0"
                                                   id="sector-{{$i-1}}">
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            Iš viso kaina: <span id="totalPrice">0</span> EUR
                            <button type="submit" class="btn btn-primary">Rezervuoti</button>
                        </div>
                    </div>

                </form>

            @endif

        @else
            Nėra aktyvaus renginio kurį galima būtų rezervuoti!
        @endif
    </div>
@endsection
