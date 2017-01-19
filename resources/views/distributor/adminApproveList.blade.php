@extends('Layout.app')

@section('main-content')

    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <!-- /.box -->

                <div class="box">

                    <div id="select" class="box-body table-responsive ">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Company Name</th>
                                <th>Contact Name</th>
                                <th>Status</th>
                                <th>Remark</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customerList as $list)
                                <tr>
                                    <td>{{$list['company_name']}}</td>
                                    <td>{{$list['contact_name']}}</td>
                                    <td>
                                        {{--Salesmanager--}}
                                        {{isset($list['approval']['username'])?$list['approval']['username']:"SalesManager"}}
                                        {{isset($list['approval']['display_name'])?"(".$list['approval']['display_name'].")":""}}
                                                                :  {{(isset($list["approval"]["sales_approval"])
                                                                && $list["approval"]["sales_approval"]!=null)
                                                                ?ucfirst($list["approval"]["sales_approval"])
                                                                :"Waiting For Approval"}}

                                        @if(isset($list['approval']['sales_approval']))

                                            <button class="btn btn-danger glyphicon glyphicon-info-sign"
                                                        data-toggle="popover" data-trigger="hover"
                                                        data-content="{{$list['approval']['sale_remark']}}">
                                            </button>
                                        @endif

                                        <br>

                                        {{--Admin--}}
                                        {{isset($list['adminApproval']['username'])?$list['adminApproval']['username']:"Admin"}}
                                        {{isset($list['adminApproval']['display_name'])?"(".$list['adminApproval']['display_name'].")":""}}
                                                        : {{(isset($list["adminApproval"]["admin_approval"])
                                                        && $list["adminApproval"]["admin_approval"]!=null)
                                                        ?ucfirst($list["adminApproval"]["admin_approval"]):"Waiting For Approval"}}

                                        @if(isset($list['approval']['admin_approval']) && $list['approval']['admin_approval']!=null)
                                            <button id="pop" class="btn btn-danger glyphicon glyphicon-info-sign"
                                                        data-toggle="popover" data-trigger="hover"
                                                        data-content="{{$list['approval']['admin_remark']}}">
                                            </button>
                                        @endif

                                    </td>

                                    <td>
                                        {!! Html::linkRoute('distributor.show','View',
                                                            array($list['distributor_id']),
                                                            array('class'=>'btn btn-primary'))
                                        !!}

                                        @if(isset($list["approval"]["sales_approval"])
                                               && $list["approval"]["sales_approval"]=="Approved")
                                            @if(isset($list["approval"]["admin_approval"]))
                                                @if(($list["approval"]["admin_approval"]!="Approved"))

                                                <div class="form-group clearfix">
                                                    <div class="col-md-8">
                                                        <select class="customer_approval form-control" data-dist="{{$list["distributor_id"]}}">
                                                            <option value="Approved">Approved</option>
                                                            <option value="On Hold" >On Hold</option>
                                                            <option value="Rejected" >Rejected</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                @endif

                                        @elseif(!isset($list["approval"]["admin_approval"]))

                                            <div class="form-group clearfix">
                                                <div class="col-md-8">
                                                    <select  class="customer_approval form-control" data-dist="{{$list["distributor_id"]}}">
                                                        <option value="Approved">Approved</option>
                                                        <option value="On Hold">On Hold</option>
                                                        <option value="Rejected">Rejected</option>
                                                    </select>
                                                </div>
                                            </div>

                                            @endif

                                         @endif

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="customer-approval-modal modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
             id="reject" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm ">
                <div class="modal-content " style="padding: 10px">

                    {!! Form::open(array('route' => 'customerAdminApprove'))!!}

                    {{ Form::hidden('distributor_id', "",["id"=>"distributor_id"]) }}
                    {{ Form::hidden('admin', Auth::user()->id) }}
                    {{ Form::hidden('admin_approval', '',array("id"=>"sales_approval_input")) }}


                    <h3>Add Remark</h3>
                    <div class="form-group col-md-12">
                        {{ Form::textarea('admin_remark', null, ['class' => 'form-control',
                                                           'size' => '30x5',
                                                           'required' => 'required']) }}
                    </div>

                    <div align="right" style="padding: 10px">
                        {{Form::submit('Save ', array('class'=>'btn btn-primary'))}}
                        <a type="button" class="btn btn-warning"
                           href="/customer/admin/list">Cancel</a>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection