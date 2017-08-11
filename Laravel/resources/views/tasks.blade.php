@extends('layouts.master')

@section('content')
    <div class="container" style="margin-top: 10px;">
        @if (Session::has('message'))
            <div class="alert {{ Session::get('message-danger') ? 'alert-danger' : 'alert-success' }}">
                {{ Session::get('message') }}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                新しいタスク
            </div>
            <div class="panel-body">
                @include('common.errors')

                <form action="/task" method="POST" class="form-horizontal">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="task" class="col-sm-3 control-label">タスク名</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="task-name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-plus"></i>追加
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                現在のタスク
            </div>
            <div class="panel-body">
            <table class="table table-striped task-">
                <thead>
                    <th>タスク名</th>
                    <th>&nbsp;</th>
                </thead>

                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>
                            <td>
                                <form action="/task/{{ $task->id}}" method="POST">
                                  {{ csrf_field() }}
                                  {{ method_field('delete') }}
                                  <button class="btn btn-default">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        @endif
    </div>

@endsection