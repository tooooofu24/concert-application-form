@extends('layouts.layout')

@section('content')

@section('description', '千葉大学音楽科卒業演奏会の管理画面です。')
@section('title', '音楽科卒業演奏会 - チケット一覧')

<div class="container py-4">
    <table class="table table-striped table-bordered">
        <thead class="rounded">
            <tr class="border-top-0">
                <th style="width: 50px;" class="border-start-0"></th>
                <th scope="col" class="text-nowrap text-center">氏名</th>
                <th scope="col" class="text-nowrap text-center">ふりがな</th>
                <th scope="col" class="text-nowrap text-center">電話番号</th>
                <th style="width: 50px;" class="text-center text-nowrap">入場</th>
                <th style="width: 50px;" class="text-center text-nowrap border-end-0">反映</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td class="align-middle text-nowrap text-center border-start-0">@if($ticket->is_invalid) <i class="fas fa-exclamation-circle fa-lg text-danger"></i> @endif</td>
                <td class="align-middle text-nowrap text-center">{{ $ticket->name }}</td>
                <td class="align-middle text-nowrap text-center">{{ $ticket->converted_name }}</td>
                <td class="align-middle text-nowrap text-center">{{ $ticket->tel }}</td>
                <td class="align-middle text-nowrap text-center"></td>
                <td class="align-middle text-nowrap text-center border-end-0"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection