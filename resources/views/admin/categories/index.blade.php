@extends('admin/layouts.master')
@section('content-header')

    <h1>@lang('site.dashboard')</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard.welcome')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li class="active"><i class="fa fa-users"></i> @lang('site.categories')</li>
        
    </ol>

@endsection

    
@section('content')
   <div class="row">
       <div class="col-md-12">
              <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">@lang('site.categories')</h3>

                  <form action="{{route('dashboard.categories.index')}}" method="get">
                      <div class="row">
                            <div class="col-md-4">
                              
                                
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            
                               
                            </div>
                            <div class="col-md-4">

                                <!-- <input type="submit" class="btn btn-primary" value="@lang('site.search')"> -->
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')
                                </button>
                                {{-- @if (auth()->user()->hasPermission('create_categories')) --}}
                                    <a class="btn btn-primary" href="{{route('dashboard.categories.create')}}">
                                        <i class="fa fa-plus"></i> @lang('site.add')</a>
                                {{-- @else --}}
                                    {{-- <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</a>
                                @endif --}}
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
                            <th>@lang('site.name')</th>
                            <th>@lang('site.products_count')</th>
                            <th>@lang('site.related_products')</th>
                            <th>@lang('site.controll')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($categories) > 0)
                            @foreach ($categories as $index=>$category)
                                <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->products->count()}}</td>
                                <td><a href="{{ route('dashboard.products.index', ['category_id' => $category->id]) }}"
                                     class="btn btn-info btn-sm">@lang('site.related_products')</a></td>
                                    
                                <td>
                                    <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-primary" 
                                        data-toggle="tooltip" data-placement="top" title="@lang('site.edit')">
                                        <i class="fa fa-edit fa-1x"></i>
                                    </a>
                                    <a href="{{route('dashboard.categories.destroy',$category->id)}}"class="btn btn-danger" onclick="if(!confirm('@lang('site.confirm_delete_user')')) return false;" data-toggle="tooltip" data-placement="top" 
                                        title="@lang('site.confirm_delete')">
                                        <i class="fa fa-trash-o fa-1x"></i>
                                    </a>
                                </td>
                                </tr>
                            @endforeach
                            @else
                        
                            <h2>@lang('site.no_data_found')</h2>
                        
                        @endif
                </table>
                
                </div>             
            </div><!-- /.box --> 
        </div>    
    </div>
@endsection