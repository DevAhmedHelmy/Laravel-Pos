@extends('admin/layouts.master')
@section('content-header')

    <h1>@lang('site.users')</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard.welcome')}}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
        <li><a href="{{route('dashboard.categories')}}"><i class="fa fa-users"></i> @lang('site.categories')</a></li>
        <li class="active"><i class="fa fa-plus"></i>  @lang('site.update')</a></li>
        
    </ol>

@endsection

    
@section('content')
   
    <div class="row">
       <div class="col-md-12">
              <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"> @lang('site.add')</h3>
                </div> 

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            @if (isset($category))
                                <form action="{{route('dashboard.update_categories', $category->id)}}" method="post" >
                                    {{csrf_field()}}
                                    @foreach (config('translatable.locales') as $local)
                                    
                                
                                        <div class="form-group">
                                            <label>@lang('site.' .$local. '.name')</label>
                                            <input type="text" class="form-control"
                                                name="{{ $local }}[name]" value="{{$category->translate($local)->name}}" required>
                                        </div>
                                        
                                    @endforeach
                                    
                                    
                                   
                                   
                                    <div class="form-group">
                                        
                                        <input type="submit" class="btn btn-primary" value="@lang('site.update')">
                                            
                                    </div>
                                    @include('admin.layouts.errors')
                                </form><!-- /end of form -->
                                @else
                                <h2>Not Found This Id</h2>
                            @endif
                            
                        </div>
                    </div>
                    
                    
                </div><!-- /.box-body --> 


                               
            </div><!-- /.box --> 
        </div>    
    </div>


         

@endsection