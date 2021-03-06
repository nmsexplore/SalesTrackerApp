@extends('Layout.app')

@section('main-content')


    <div class="tab-content">

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <!-- /.box -->

                    <div class="box" style="padding: 10px">
                        @role((['admin','generalmanager','director']))
                        <div align="right" style="padding: 10px">
                            <a href="{{route('product.create')}}">
                                <span class=" btn btn-sm btn-success" title="Create new product">Create Product</span>
                            </a>
                        </div>
                        @endrole
{{--{{storage_path()}}--}}


                        <div class="box-header">
                            <h3 class="box-title">List of Products</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">

                            <table id="example1"
                                   class="table table-striped table-bordered dt-responsive  table-responsive "
                                   cellspacing="0" width="100%">
                                <thead>
                                <tr>

                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>Sub-Category Name</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Price</th>


                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($data))
                                @foreach($data as $row)
                                    <tr>
                                        {{--symlink to be created to access image--}}
                                        {{--ln -s ~/web/salestrackerweb/storage/app/public/product ~/web/salestrackerweb/public/storage/--}}

                                        <td><img class="productimage" src="storage/product/{{$row->image}}"></td>

                                        <td>{{$row->name }}</td>
                                        <td>{{$row->category }}</td>
                                        <td>{{$row->sub_category }}</td>
                                        <td>{{$row->code }}</td>
                                        <td>{{$row->description }}</td>
                                        <td>{{$row->price }}/pack
                                            @role((['admin','salesmanager','accountmanagersales','generalmanager','director']))
                                            <button class="btn btn-sm btn-primary" data-toggle="modal" title="Change the current product price"
                                                    data-target="#price{{$row->id}}">Change price
                                            </button>




                                        <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog"
                                             id="price{{$row->id}}" aria-labelledby="myLargeModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content pad">

                                                    {!! Form::model($row,array('route'=>['change_price',$row->id],'method'=>'PUT' ))!!}
                                                    <h3> Edit price</h3>
                                                    <div class="form-group ">
                                                        <label for="price" class="col-sm-4 control-label">Change Product
                                                            Price</label>
                                                        <div class="col-sm-8 pad">
                                                            {{ Form::text('price',null,array('class'=>'form-control'))}}
                                                        </div>
                                                    </div>
                                                    <div align="right">
                                                    {{Form::submit('Save Changes', array('class'=>'btn btn-sm btn-primary ','title'=>'Save change of price for the product'))}}
                                                    <a type="button" class="btn btn-sm btn-warning" href="/product">Cancel</a>
                                                    {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        </td>
                                        <td>
                                            <a href="{{route('product.edit',$row->id)}}">
                                                <button class="btn btn-warning pad" data-toggle="popover" data-trigger="hover"
                                                        data-placement="top" data-content="Edit the current product"><i class="fa fa-edit"  ></i></button>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE','route' => ['product.destroy', $row->id]]) !!}
                                            <button type="submit" class="btn btn-danger glyphicon glyphicon-trash pad"  data-toggle="popover" data-trigger="hover"
                                                    data-placement="top" data-content="Delete the current product"
                                                    onclick="return confirm('Are you sure you want to delete this item?');">

                                            </button>
                                            {!! Form::close() !!}


                                        </td>
                                        @endrole
                                    </tr>
                                @endforeach
                                    @endif



                                </tbody>

                            </table>
                        </div>

                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->









@endsection







