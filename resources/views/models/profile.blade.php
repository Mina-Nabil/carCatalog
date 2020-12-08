@extends('layouts.app')


@section('content')

<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card"> <img class="card-img" src="{{  (isset($model->MODL_IMGE)) ? asset( 'storage/'. $model->MODL_IMGE ) : asset('assets/images/users/def-car.png')}}"
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
                            <div class="col-md-4 col-xs-6 b-r"> <strong>Player Name</strong>
                                <br>
                                <p class="text-muted">{{$model->USER_NAME}}</p>
                            </div>
                            <div class="col-md-4 col-xs-6 b-r"> <strong>Class Name</strong>
                                <br>
                                <p class="text-muted">{{$model->group->GRUP_NAME ?? ''}}</p>
                            </div>
                            <div class="col-md-4 col-xs-6"> <strong>Birthdate</strong>
                                <br>
                                <p class="text-muted">{{($model->USER_BDAY) ? $model->USER_BDAY->format('d-M-Y') : ''}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class=row>
                            <div class="col-lg-6 col-xs-6 b-r">
                                <strong>Account Type</strong>
                                <p class="text-muted">{{$model->type->USTP_NAME}}</p>
                            </div>
                            <div class="col-md-6 col-xs-6 b-r">
                                <strong>Email</strong>
                                <p class="text-muted">{{$model->USER_MAIL ?? ''}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class=row>
                            <div class="col-md-6 col-xs-6 b-r">
                                <strong>ID</strong>
                                <p class="text-muted">{{$model->USER_CODE}}</p>
                            </div>
                            <div class="col-md-6 col-xs-6 b-r">
                                <strong>Phone</strong>
                                <p class="text-muted">{{$model->USER_MOBN ?? ''}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class=row>
                            <div class="col-12 b-r">
                                <strong>Note</strong>
                                <p class="text-muted">{{$model->USER_NOTE ?? ''}}</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>


                <div class="tab-pane" id="overview" role="tabpanel">
                    <div class="card-body">
                        <h4 class="card-title">Years Overview</h4>
                        <form class="form pt-3" method="post">
                            @csrf
                            <input type=hidden name=userID value="{{(isset($model)) ? $model->id : ''}}">
                            <div class=row>
                                <div class=col-9>
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <select name=year class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                <option value="" disabled selected>Pick From Attended Years</option>
                                                @foreach($years as $year)
                                                <option value="{{ $year->year }}">{{$year->year}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class=col-3>
                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                </div>
                            </div>

                        </form>
                        <hr>
                        <div class="table-responsive m-t-5">
                            <h4 class="card-title">{{$loadedYear ?? now()->format('Y')}}'s Overview</h4>
                            <table id="overTable" class="table color-bordered-table table-striped full-color-table full-primary-table hover-table" data-display-length='-1' data-order="[]">
                                <thead>
                                    <th>Month</th>
                                    <th>Attendances</th>
                                    <th>Paid</th>
                                </thead>
                                <tbody>
                                    @foreach($overItems as $item)

                                    <tr>
                                        <td>{{$item[0]}}</td>
                                        <td>{{$item[1]}}</td>
                                        <td>{{number_format($item[2],2)}}</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="attendance" role="tabpanel">
                    <div class="card-body">
                        <h4 class="card-title">Take Attendance</h4>
                        <form class="form pt-3" method="post" action="{{ url($attendanceFormURL) }}" enctype="multipart/form-data">
                            @csrf
                            <input type=hidden name=userID value="{{(isset($model)) ? $model->id : ''}}">
                            <div class=row>
                                <div class=col-9>
                                    <div class="form-group">
                                        <label>Attendance Date</label>
                                        <div class="input-group mb-3">
                                            <input type="date" value="{{ now()->format('Y-m-d')}}" class="form-control" placeholder="Pick a date" name=date required />
                                        </div>
                                        <small class="text-danger">{{$errors->first('date')}}</small>
                                    </div>
                                </div>
                                <div class="col-3 align-self-center">
                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <x-datatable id="myTable" :title="$title" :subtitle="$subTitle" :cols="$cols" :items="$items" :atts="$atts" />
                    </div>
                </div>

                <div class="tab-pane" id="images" role="tabpanel">
                    <div class="card-body">

                        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <?php $i=0; ?>
                                @foreach($model->images as $image)
                                <li data-target="#carouselExampleIndicators2" data-slide-to="{{$i}}" {{($i==0) ? 'class="active"' : ''}}></li>
                                <?php $i++; ?>
                                @endforeach
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                <?php $i=0; ?>
                                @foreach($model->images as $image)
                                <div class="carousel-item {{($i==0) ? 'active' : ''}}">
                                    <img class="img-fluid" src="{{ asset( 'storage/'. $image->USIM_URL ) }} " style="max-height:350; max-width:300; height:auto; width:auto;">
                                </div>
                                <?php $i++; ?>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev" style="background-color:#DCDCDC">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next" style="background-color:#DCDCDC">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <hr>
                        <h4 class="card-title">Add New User Image</h4>
                        <form class="form pt-3" method="post" action="{{ url($imageFormURL) }}" enctype="multipart/form-data">
                            @csrf
                            <input type=hidden name=userID value="{{(isset($model)) ? $model->id : ''}}">

                            <div class="form-group">
                                <label for="input-file-now-custom-1">New Photo</label>
                                <div class="input-group mb-3">
                                    <input type="file" id="input-file-now-custom-1" name=photo class="dropify" data-default-file="{{ old('photo') }}" />
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            @if($isCancel)
                            <a href="{{url($homeURL) }}" class="btn btn-dark">Cancel</a>
                            @endif
                        </form>
                    </div>


                    <hr>
                    <div>
                        <div class=col>
                            <h4 class="card-title">All Images</h4>
                            <div class="table-responsive m-t-40">
                                <table class="table color-bordered-table table-striped full-color-table full-primary-table hover-table" data-display-length='-1' data-order="[]">
                                    <thead>
                                        <th>Url</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($model->images as $image)
                                        <tr>
                                            <td><a target="_blank" href="{{ asset( 'storage/'. $image->USIM_URL ) }}">
                                                    {{(strlen($image->USIM_URL) < 25) ? $image->USIM_URL : substr($image->USIM_URL, 0, 25).'..' }}
                                                </a></td>
                                            <td>
                                                @if($image->id != $model->USER_MAIN_IMGE)
                                                <a href="javascript:void(0);">
                                                    <div class="label label-info" onclick="confirmAndGoTo('{{url('users/setimage/'.$model->id.'/'.$image->id)}}', 'set this as the main Model Image')">
                                                        Set As Main </div>
                                                </a>
                                                @else
                                                <a href="javascript:void(0);">
                                                    <div class="label label-danger">Main Image</div>
                                                </a>
                                                @endif
                                                <a href="javascript:void(0);" onclick="confirmAndGoTo('{{url('users/delete/image/'.$image->id)}}', 'delete this image')">
                                                    <img src="{{ asset('images/del.png') }}" width=25 height=25>
                                                </a>
                                            </td>
                                        <tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
                                            <option value="{{ $type->id }}" @if(isset($model) && $type->id == $type->MODL_BRND_ID)
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


                                <div class="form-group bt-switch">
                                    <div class="col-md-5 m-b-15">
                                        <h4 class="card-title">Active</h4>
                                        <input type="checkbox" data-size="large" checked data-on-color="success" data-off-color="danger" data-on-text="Active" data-off-text="Hidden" name="isActive">
                                    </div>
                                    <small class="text-muted">This model and all its linked cars can be hidden/published using this option</small>
                                </div>

                                <div class="form-group bt-switch">
                                    <div class="col-md-5 m-b-15">
                                        <h4 class="card-title">Main</h4>
                                        <input type="checkbox" data-size="large" checked data-on-color="success" data-off-color="danger" data-on-text="Yes" data-off-text="No" name="isMain">
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
                            <h4 class="card-title">Delete User</h4>
                            <button type="button" onclick="confirmAndGoTo('{{url('users/delete/'.$model->id )}}', 'delete this User and all his attendance and payment ?')"
                                class="btn btn-danger mr-2">Delete All User Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
@endsection