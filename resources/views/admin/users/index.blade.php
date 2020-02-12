@extends('admin/layouts.master')
@section('content-header')

    <h1>@lang('site.dashboard')</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard.welcome')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li class="active"><i class="fa fa-users"></i> @lang('site.users')</li>
        
    </ol>

@endsection

    
@section('content')
   <div class="row">
       <div class="col-md-12">
              <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('site.users')</h3>

                  <form action="{{route('dashboard.users.index')}}" method="get">
                      <div class="row">
                            <div class="col-md-4">
                              
                                
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            
                               
                            </div>
                            <div class="col-md-4">

                                <!-- <input type="submit" class="btn btn-primary" value="@lang('site.search')"> -->
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')
                                </button>
                                @if (auth()->user()->hasPermission('create_users'))
                                    <a class="btn btn-primary" href="{{route('dashboard.users.create')}}">
                                        <i class="fa fa-plus"></i> @lang('site.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif
                            </div>
                  
                            
                      </div>
                 
                  </form>
                </div>
                </div> 
                
                <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('site.first_name')</th>
                            <th>@lang('site.last_name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.controll')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($users) > 0)
                            @foreach($users as $index=>$user)
                            <tr>
                              <td>{{$index + 1}}</td>
                              <td>{{$user->first_name}}</td>
                              <td>{{$user->last_name}}</td>
                              <td>{{$user->email}}</td>
                              <td><img src="{{ asset('/image/upload/users/'. auth()->user()->image) }}" style="width: 100px;" class="img-thumbnail" alt=""></td>
                              <td>
                                    {{-- {{ $user->image_path }} --}}
                                    @if (auth()->user()->hasPermission('read_users'))
                                        <a href="{{route('dashboard.users.show',$user->id)}}" class="btn btn-info" 
                                            data-toggle="tooltip" data-placement="top" title="@lang('site.read')">
                                            <i class="fa fa-eye fa-1x"></i>
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-info disabled">
                                            <i class="fa eye fa-1x"></i> @lang('site.read')
                                        </a>
                                    @endif


                                    @if (auth()->user()->hasPermission('update_users'))
                                        <a href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-primary" 
                                            data-toggle="tooltip" data-placement="top" title="@lang('site.edit')">
                                            <i class="fa fa-edit fa-1x"></i>
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-primary disabled">
                                            <i class="fa fa-edit"></i> @lang('site.edit')
                                        </a>
                                    @endif

                                    @if (auth()->user()->hasPermission('delete_users'))
                                        <a href="{{route('dashboard.users.destroy',$user->id)}}"class="btn btn-danger" onclick="if(!confirm('@lang('site.confirm_delete_user')')) return false;" data-toggle="tooltip" data-placement="top" 
                                            title="@lang('site.confirm_delete')">
                                            <i class="fa fa-trash-o fa-1x"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-danger disabled">
                                            <i class="fa fa-trash"></i> @lang('site.delete')
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach

                        @else

                            <tr>@lang('site.not_found_data')</tr>
                        @endif
                    
                    </tbody>
                </table>
                {{$users->appends(request()->query())->links()}}
                </div>             
            </div><!-- /.box --> 
        </div>    
    </div>
@endsection