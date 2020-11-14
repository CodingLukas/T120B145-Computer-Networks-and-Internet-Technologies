@extends('layouts.index')

@section('content')
    <div class="container">

        @if($event)

            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Sektoriai</h2>
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


            <script>
                var prices = [];
                @foreach ($sectors as $sector)
                    prices[prices.length] = {{ $sector->getPricePerSeat() }};
                @endforeach

                $(document).ready(function () {
                    $('.sector').click(function () {
                        let totalAmount = calculateTotal();
                        $('#totalPrice').html(totalAmount);
                    });
                })

                function calculateTotal(){
                    let total = 0.00;
                    for (i = 0; i < prices.length; i++){
                        let amount = $('#sector-'+i).val();
                        total += amount * prices[i];
                    }
                    return total;
                }

            </script>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Rezervuoti bilietą</h2>
                    </div>
                </div>
            </div>
            <table class="table-sm table-bordered table-responsive-sm">
                <tr>
                    <th>Sektoriaus numeris</th>
                    <th>Rezervuojamas kiekis</th>
                </tr>
                @php($i = 0)
                @foreach ($sectors as $sector)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>
                            <input class="form-control sector" type="number" value="0" min="0" id="sector-{{$i-1}}">
                        </td>
                    </tr>
                @endforeach
            </table>
            <br>
            Iš viso kaina: <span id="totalPrice">0</span> EUR
             <button class="btn btn-primary" type="submit">Pirkti</button>

        @else
            Nėra aktyvaus renginio kurį galima būtų rezervuoti!
        @endif
    </div>
@endsection
