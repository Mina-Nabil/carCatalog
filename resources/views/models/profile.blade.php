@extends('layouts.app')


@section('content')

<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card"> <img class="card-img" src="{{  (isset($model->MODL_IMGE)) ? asset( 'storage/'. $model->MODL_IMGE ) : asset('images/def-car.png')}}" alt="Card image">
        </div>
        <div class="card"> <img class="card-img"
                src="{{  (isset($model->MODL_BRCH)) ? "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Findd.adobe.com%2Fview%2F{$model->MODL_BRCH}&choe=UTF-8"  : asset('images/def-car.png')}}"
                alt="Card image">
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Model Info</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#cars" role="tab">Cars</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!--second tab-->
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Model Name</strong>
                                <br>
                                <p class="text-muted">{{$model->MODL_NAME}}</p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Year</strong>
                                <br>
                                <p class="text-muted">{{$model->MODL_YEAR ?? ''}}</p>
                            </div>
                            <div class="col-md-3 col-xs-6 b-r"> <strong>Brand Name</strong>
                                <br>
                                <p class="text-muted">{{$model->brand->BRND_NAME ?? ''}}</p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Type</strong>
                                <br>
                                <p class="text-muted">{{$model->type->TYPE_NAME ?? ''}}</p>
                            </div>
                            <div class="col-md-6 col-xs-6 b-r"> <strong>Status</strong>
                                <br>
                                <p class="text-muted">{{$model->MODL_ACTV ? 'Active' : "Hidden"}}</p>
                            </div>
                            <div class="col-md-6 col-xs-6"> <strong>Main</strong>
                                <br>
                                <p class="text-muted">{{$model->MODL_MAIN ? 'Shown in home page & car menus' : 'Shown in car menus'}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class=row>
                            <div class="col-md-12 col-xs-12 b-r ">
                                @if(isset($model->MODL_BRCH))
                                <iframe style="border: 1px solid #777; width:100% " src="https://indd.adobe.com/embed/{{$model->MODL_BRCH}}?startpage=1&allowFullscreen=false" height="371px"
                                    frameborder="0" allowfullscreen=""></iframe>
                                @else
                                <p class="text-muted">Interactive Brochure Area</p>
                                @endif

                            </div>
                        </div>
                        <hr>
                        <div class=row>
                            <div class="col-12 b-r">
                                <strong>Overview</strong>
                                <p class="text-muted">{{$model->MODL_OVRV ?? ''}}</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>




                <div class="tab-pane" id="cars" role="tabpanel">
                    <div class="card-body">
                        <h4 class="card-title">All Categories</h4>
                        <hr>
                        <x-datatable id="myTable" :title="$title" :subtitle="$subTitle" :cols="$cols" :items="$items" :atts="$atts" />
                    </div>
                </div>

                <div class="tab-pane" id="settings" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $formTitle }}</h4>
                            <form class="form pt-3" method="post" action="{{ url($formURL) }}" enctype="multipart/form-data">
                                @csrf
                                @isset($model)
                                <input type=hidden name=id value="{{(isset($model)) ? $model->id : ''}}">
                                @endisset

                                <div class="form-group">
                                    <label>Brand*</label>
                                    <div class="input-group mb-3">
                                        <select name=brand class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                            <option value="" disabled selected>Pick From Active Brands</option>
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" @if(isset($model) && $brand->id == $model->MODL_BRND_ID)
                                                selected
                                                @elseif($brand->id == old('brand'))
                                                selected
                                                @endif
                                                >{{$brand->BRND_NAME}} ({{$brand->BRND_ACTV ? 'Active' : 'In-Active'}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small class="text-danger">{{$errors->first('brand')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Type*</label>
                                    <div class="input-group mb-3">
                                        <select name=type class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                            <option value="" disabled selected>Pick From Car Types</option>
                                            @foreach($types as $type)
                                            <option value="{{ $type->id }}" @if(isset($model) && $type->id == $model->MODL_TYPE_ID)
                                                selected
                                                @elseif($type->id == old('type'))
                                                selected
                                                @endif
                                                >{{$type->TYPE_NAME}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small class="text-danger">{{$errors->first('group')}}</small>
                                </div>

                                <div class="form-group">
                                    <label>Model Name*</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon11"><i class="far fa-copyright"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Model Name" name=name value="{{ (isset($model)) ? $model->MODL_NAME : old('name')}}" required>
                                    </div>
                                    <small class="text-danger">{{$errors->first('name')}}</small>
                                </div>
                                <div class="form-group">
                                    <label>Year*</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon11"><i class="far fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Model Year" name=year value="{{ (isset($model)) ? $model->MODL_YEAR : old('year')}}" required>
                                    </div>
                                    <small class="text-danger">{{$errors->first('year')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Arabic Name</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon22"><i class="fas fa-font"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name=arbcName placeholder="Arabic Name" value="{{ (isset($model)) ? $model->MODL_ARBC_NAME : old('arbcName')}}">
                                    </div>
                                    <small class="text-danger">{{$errors->first('arbcName')}}</small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Interactive Brochure</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon22"><i class="fas fa-barcode"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name=brochureCode placeholder="Interactive brochure code, example: 452336e5-81ed-43be-a4be-f7552f6366fd "
                                            value="{{ (isset($model)) ? $model->MODL_BRCH : old('brochureCode')}}">
                                    </div>
                                    <small class="text-muted">Use only the code written after the indesign url, https://indd.adobe.com/view/<strong>452336e5-81ed-43be-a4be-f7552f6366fd</strong>
                                    </small><br>
                                    <small class="text-danger">{{$errors->first('brochureCode')}}</small>
                                </div>


                                <div class="form-group bt-switch">
                                    <div class="col-md-5 m-b-15">
                                        <h4 class="card-title">Active</h4>
                                        <input type="checkbox" data-size="large" {{(isset($model) && $model->MODL_ACTV) ? 'checked' : ''}} data-on-color="success" data-off-color="danger"
                                            data-on-text="Active" data-off-text="Hidden" name="isActive">
                                    </div>
                                    <small class="text-muted">This model and all its linked cars can be hidden/published using this option</small>
                                </div>

                                <div class="form-group bt-switch">
                                    <div class="col-md-5 m-b-15">
                                        <h4 class="card-title">Main</h4>
                                        <input type="checkbox" data-size="large" {{(isset($model) && $model->MODL_MAIN) ? 'checked' : ''}} data-on-color="success" data-off-color="danger"
                                            data-on-text="Yes" data-off-text="No" name="isMain">
                                    </div>
                                    <small class="text-muted">The model can be published on the home page using this option</small>
                                </div>

                                <div class="form-group">
                                    <label for="input-file-now-custom-1">Model Image</label>
                                    <div class="input-group mb-3">
                                        <input type="file" id="input-file-now-custom-1" name=image class="dropify"
                                            data-default-file="{{ (isset($model->MODL_LOGO)) ? asset( 'storage/'. $model->MODL_LOGO ) : old('image') }}" />
                                    </div>
                                    <small class="text-muted">Image size should be 346 * 224 -- It appears on the home page if this is a main model -- The background should be transparent (.png)
                                        format</small><br>
                                    <small class="text-danger">{{$errors->first('image')}}</small>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Model Overview</label>
                                    <div class="input-group mb-3">
                                        <textarea class="form-control" name=overview rows="5">{{(isset($model)) ? $model->MODL_OVRV : old('overview')}}</textarea>
                                    </div>
                                    <small class="text-muted">Model Overview paragraph, shown on the home page and on the model page</small><br>
                                    <small class="text-danger">{{$errors->first('overview')}}</small>
                                </div>


                                <button type="submit" class="btn btn-success mr-2">Submit</button>
                                @if($isCancel)
                                <a href="{{url($homeURL) }}" class="btn btn-dark">Cancel</a>
                                @endif
                            </form>
                            <hr>
                            <h4 class="card-title">Delete Model</h4>
                            <button type="button" onclick="confirmAndGoTo('{{url('admin/models/delete/'.$model->id )}}', 'delete this Model and all the car linked to it ??')"
                                class="btn btn-danger mr-2">Delete <strong>All</strong> Model Data (Cars/Images linked to the model)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
@endsection