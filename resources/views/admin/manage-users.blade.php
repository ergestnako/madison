@extends('layouts.app')

@section('pageTitle', trans('messages.admin.manage_users'))

@section('content')
    @include('components.breadcrumbs.admin')

    <div class="page-header">
        <h1>{{ trans('messages.admin.admin_label', ['page' => trans('messages.admin.manage_users')]) }}</h1>
    </div>

    @include('components.errors')

    <div class="row">
        @include('admin.partials.admin-sidebar')

        <div class="col-md-9">
            <table class="table">
                <thead>
                    <tr>
                        <th>@lang('messages.user.fname')</th>
                        <th>@lang('messages.user.lname')</th>
                        <th>@lang('messages.user.email')</th>
                        <th>@lang('messages.email_verified')</th>
                        <th>@lang('messages.administrator')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->lname }}</td>
                            <td>{{ $user->email }}</td>
                            @if (empty($user->token))
                                <td class="text-center"><i class="fa fa-check"></i></td>
                            @else
                                <td></td>
                            @endif
                            <td>
                                <div class="btn-toolbar" role="toolbar">
                                    <div class="btn-group" role="group">
                                        @if ($user->isAdmin())
                                            {{ Form::open(['route' => ['admin.users.postAdmin', $user], 'method' => 'post']) }}
                                                <input type="hidden" name="admin" value="0">
                                                @if ($user->id !== Auth::user()->id)
                                                    <button type="submit" class="btn btn-danger btn-xs admin">
                                                        @lang('messages.user.remove_admin')
                                                    </button>
                                                @endif
                                            {{ Form::close() }}
                                        @else
                                            {{ Form::open(['route' => ['admin.users.postAdmin', $user], 'method' => 'post']) }}
                                                <input type="hidden" name="admin" value="1">
                                                <button type="submit" class="btn btn-default btn-xs admin">
                                                    @lang('messages.user.make_admin')
                                                </button>
                                            {{ Form::close() }}
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('users.settings.account.edit', $user) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
