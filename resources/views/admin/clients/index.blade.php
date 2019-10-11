@extends('admin/layouts.master')
@section('content-header')

    <h1>@lang('site.dashboard')</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard.welcome')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li class="active"><i class="fa fa-users"></i> @lang('site.clients')</li>
        
    </ol>

@endsection

    
@section('content')
   <div class="row">
       <div class="col-md-12">
              <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('site.clients')</h3>

                  <form action="{{route('dashboard.clients.index')}}" method="get">
                      <div class="row">
                            <div class="col-md-4">
                              
                                
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            
                               
                            </div>
                            <div class="col-md-4">

                                <!-- <input type="submit" class="btn btn-primary" value="@lang('site.search')"> -->
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')
                                </button>
                                @if (auth()->user()->hasPermission('create_clients'))
                                    <a class="btn btn-primary" href="{{route('dashboard.clients.create')}}">
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
                    @if(count($clients) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.phone')</th>
                            <th>@lang('site.address')</th>
                            <th>@lang('site.add_order')</th>
                            <th>@lang('site.controll')</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @foreach ($clients as $index=>$client)
                                <tr>
                                    <td>{{$index + 1}}</td>
                                    <td>{{$client->name}}</td>
                                    
                                    <td>{{is_array($client->phone) ? implode($client->phone, '-') : $client->phone }}</td>
                                    <td>{{ $client->address }}</td>
                                    {{-- { --}}
                                    <td>
                                        @if (auth()->user()->hasPermission('create_orders'))
                                            <a href="{{ route('dashboard.clients.orders.create', $client->id) }}" class="btn btn-primary btn-sm">@lang('site.add_order')</a>
                                        @else
                                            <a href="#" class="btn btn-primary btn-sm disabled">@lang('site.add_order')</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('update_clients'))
                                            <a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('delete_clients'))
                                        <a href="{{route('dashboard.clients.destroy',$client->id)}}"class="btn btn-danger" onclick="if(!confirm('@lang('site.confirm_delete_user')')) return false;" data-toggle="tooltip" data-placement="top" 
                                            title="@lang('site.confirm_delete')">
                                            <i class="fa fa-trash-o fa-1x"></i> @lang('site.delete') 
                                        </a>
                                    @else
                                        <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                           
                </table>
                 @else
                        
                            <h2>@lang('site.no_data_found')</h2>
                        
                        @endif
                </div>             
            </div><!-- /.box --> 
        </div>    
    </div>
@endsection