@extends('Layout.app')

@section('main-content')


    <div class="box pad">
        <div class="box-header">
            <h3 class="box-title">Stocks Out History</h3>
        </div>
        <div align="right">


        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Warehouse Name</th>
                    <th>Subcategory Name</th>
                    <th>Customer Name</th>
                    <th>Quantity(s)</th>
                    <th>Dispatched By</th>
                    <th>Created Date</th>
                    {{--<th>Updated Date</th>--}}


                </tr>
                </thead>

                <tbody>
                @foreach($stockout as $as)
                    <tr>
                        <td>{{$as->warehouse_name}}</td>
                        <td>{{$as->product_subcatname}}</td>
                        <td>{{$as->customername}}</td>
                        <td>{{$as->quantity}}</td>
                        <td>{{$as->username}}</td>
                        <td>{{$as->created_at}}</td>
                        {{--<td>{{$as->updated_at}}</td>--}}


                    </tr>
                @endforeach

                </tbody>

            </table>
        </div>
        <!-- /.box-body -->
    </div>















@endsection
