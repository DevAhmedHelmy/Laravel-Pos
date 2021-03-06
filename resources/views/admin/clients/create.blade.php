@extends('admin/layouts.master')
@section('content-header')

<h1>@lang('site.clients')</h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li><a href="{{ route('dashboard.clients.index') }}"> @lang('site.clients')</a></li>
        <li class="active">@lang('site.add')</li>
    </ol>

@endsection

@section('content')

   

<div class="box box-primary">

    <div class="box-header">
        <h3 class="box-title">@lang('site.add')</h3>
    </div><!-- end of box header -->
    <div class="box-body">

        

        <form action="{{ route('dashboard.clients.store') }}" method="post">

            {{ csrf_field() }}
            
            
            <div class="form-group">
                <label>@lang('site.name')</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            @for ($i = 0; $i < 2; $i++)
                <div class="form-group">
                    <label>@lang('site.phone')</label>
                    <input type="text" name="phone[]" class="form-control">
                </div>
            @endfor

            <div class="form-group">
                <label>@lang('site.address')</label>
                <textarea name="address" class="form-control">{{ old('address') }}</textarea>
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="@lang('site.add')">
            </div>
            @include('admin.layouts.errors')
        </form><!-- end of form -->

    </div><!-- end of box body -->


      

@endsection
