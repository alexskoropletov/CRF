@extends('app')

@section('content')
    <div>
        <table width="100%">
            <tr>
                <td>
                    <a href="/instrument">назад</a>
                </td>
                <td>
                    <h1>{{ $instrument->name }}</h1>
                </td>
            </tr>
        </table>
    </div>
    <div id="placeholder" style="width:1175px; height:500px"></div>
    <table class="table table-bordered">
        <thead>
        <th>Время</th>
        <th>Отк. предлож.</th>
        <th>Отк. спрос</th>
        <th>Выс. предлож.</th>
        <th>Выс. спрос</th>
        <th>Низ. предлож.</th>
        <th>Низ. спрос</th>
        <th>Зак. предлож.</th>
        <th>Зак. спрос</th>
        </thead>
        @foreach($items as $time => $cost)
            <tr>
                <td scope="row"><b>{{ $time }}</b></td>
                <td><b>{{ $cost['openBid'] }}</b></td>
                <td><b>{{ $cost['openAsk'] }}</b></td>
                <td><b>{{ $cost['highBid'] }}</b></td>
                <td><b>{{ $cost['highAsk'] }}</b></td>
                <td><b>{{ $cost['lowBid'] }}</b></td>
                <td><b>{{ $cost['lowAsk'] }}</b></td>
                <td><b>{{ $cost['closeBid'] }}</b></td>
                <td><b>{{ $cost['closeAsk'] }}</b></td>
            </tr>
        @endforeach
    </table>
    <script>
        var openBid = [
            @foreach($items as $time => $cost)
            [{{ strtotime($time) }}000, {{ $cost['openBid'] }}],
            @endforeach
        ];
        var openAsk = [
            @foreach($items as $time => $cost)
            [{{ strtotime($time) }}000, {{ $cost['openAsk'] }}],
            @endforeach
        ];
        var closeBid = [
            @foreach($items as $time => $cost)
            [{{ strtotime($time) }}000, {{ $cost['closeBid'] }}],
            @endforeach
        ];
        var closeAsk = [
            @foreach($items as $time => $cost)
            [{{ strtotime($time) }}000, {{ $cost['closeAsk'] }}],
            @endforeach
        ];
    </script>
@stop