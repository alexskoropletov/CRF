@extends('app')

@section('content')
    <div>
        <table width="100%">
            <tr>
                <td>
                    {!! $items->render() !!}
                </td>
            </tr>
        </table>
    </div>
    <table class="table table-bordered">
        <thead>
            <th>ID</th>
            <th>Название</th>
            <th>Код</th>
            <th>Обновлять</th>
            <th>Учитывать</th>
        </thead>
        @foreach($items as $item)
            <tr>
                <td scope="row">
                    <b>{{ $item->id }}</b>
                </td>
                <td><a href="/candle/?instrument={{ $item->id }}">{{ $item->name }}</a></td>
                <td><b>{{ $item->code }}</b></td>
                <td>
                    <a href="/instrument/{{ $item->id }}/update?page={{ $page }}">
                        @if ($item->update)
                            <span class="glyphicon glyphicon-plus"  style="color: green;"></span>
                        @else
                            <span class="glyphicon glyphicon-minus" style="color: red;"></span>
                        @endif
                    </a>
                </td>
                <td>
                    <a href="/instrument/{{ $item->id }}/fann?page={{ $page }}">
                        @if ($item->for_fann)
                            <span class="glyphicon glyphicon-plus" style="color: green;"></span>
                        @else
                            <span class="glyphicon glyphicon-minus" style="color: red;"></span>
                        @endif
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@stop