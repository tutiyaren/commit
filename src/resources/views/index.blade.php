@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css')}}">
@endsection

@section('content')
<div class="todo__judge">
    @if (session('message'))
    <div class="todo__judge--success">
        {{ session('message')}}
    </div>
    @endif
    @if ($errors->any())
    <div class="todo__judge--danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
<div class="todo__content">
    <form action="/todos" method="post" class="create-form">
    @csrf
        <div class="create-form__text">
            <input type="text" name="content" class=""create-form__text-input>
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">
            作成
            </button>
        </div>
    </form>
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__title">Todo</th>
            </tr>
            @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form action="/todos/update" class="update-form" method="POST">
                    @method('PATCH')
                    @csrf
                        <div class="update-form__item">
                           <input class="update-form__item-input" type="text" name="content" value="{{ $todo['content'] }}">
                           <input type="hidden" name="id" value="{{$todo['id']}}">
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form action="/todos/delete" class="delete-form" methos="POST">
                    @method('DELETE')
                    @csrf
                        <div class="delete-form__button">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            <button class="delete-form__button-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection