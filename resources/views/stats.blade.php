@extends('layouts.index')

@section('title', 'Статистика')

@section('content')
<div class='container'>
    <div class='row justify-content-center'>
        <div class='col-auto text-center font-weight-bold'>
            <h1 class="display-4">пользователей: {{ $allUsers }}</h1>
        </div>
    </div>

    <div class='row justify-content-center'>
        <div class='col-auto'>
            {{$data}}
        </div>
    </div>

    <div class='row justify-content-center'>
        <div class='col-10'>
        <table class='table table-striped table-bordered text-center'>
            <thead class="table-dark">
                <tr>
                        <th scope="col">Дата</th>
                        <th scope="col">+users</th>
                        <th scope="col">ВСЕГО</th>
                        <th scope="col">Страхование</th>
                        <th scope="col">КЦ</th>
                        <th scope="col">ОГ</th>
                        <th scope="col">Упаковка</th>
                        <th scope="col">Импорт</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        <th scope="row"> {{ date("d.m.Y", strtotime($item->date));  }}</th>
                        <td> {{ $item->appendUsers }} </td>
                        <td> {{ $item->ALL }} / {{ $item->UNIQ }}</td>
                        <td> {{ $item->insurance }} / {{ $item->uniqInsurance }} </td>
                        <td> {{ $item->cc }} / {{ $item->uniqCc }} </td>
                        <td> {{ $item->og }} / {{ $item->uniqOg }} </td>
                        <td> {{ $item->pack }} / {{ $item->uniqPack }} </td>
                        <td> {{ $item->import }} / {{ $item->uniqImport }} </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection