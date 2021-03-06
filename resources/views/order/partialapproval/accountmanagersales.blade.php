<div>
    <h3>ORDER APPROVAL</h3>
    @if(!isset($marketingapproval->marketingmanager)
    /* || !isset($salesapproval->salesmanager)
     || !isset($adminapproval->admin)*/)
        <div id="AccountManagersales approval">
            @role((['accountmanagersales','salesmanager','admin', 'generalmanager', 'director']))
            <div class="pad" >

                @role(('admin'))
                <label> Admin : </label>
                @endrole

                @role(('generalmanager'))
                <label> GM : </label>
                @endrole

                @role(('director'))
                <label> Director : </label>
                @endrole
                @role(('accountmanagersales'))
                <label> Account Manager-sales : </label>
                @endrole
                @role(('salesmanager'))
                <label> SalesManager : </label>
                @endrole

                {!! Form::open(array('id'=>'form','route'=>'add_order_approval'))!!}
                {{ Form::hidden('marketingmanager', Auth::user()->id) }}
                {{ Form::hidden('order_id', $orderId->id) }}
                <div class="form-group row">
                    <div class="col-md-8">
                        <?php $x = Config::get('distributor.orderApproval');?>
                        <select name="marketing_approval" class="form-control" required>
                            <option selected="selected" value="" disabled>Choose approval type
                            </option>
                            @foreach($x as $dep)
                                <option value="{{$dep}}">
                                    {{$dep}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group clearfix">
                        <label class="col-md-8">Remark</label>

                        <div class="col-md-12">
                            <textarea  class="form-control" type="text" name="approval_remark"  ></textarea>
                        </div>
                    </div>
                    <div align="right">
                    {{Form::submit('Submit', array('class'=>'btn btn-primary','title'=>'Add remark and Order status for Account-manager Sales'))}}
                    {!! Form::close() !!}
                </div>
                </div>
            </div>
            @endrole
        </div>
    @endif
    @if(isset($marketingapproval->marketingmanager ) && $marketingapproval->order_id==$orderId->id)
        @role((['accountmanagersales','salesmanager','admin', 'generalmanager', 'director']))
        <div class="pad">
            @if($marketingapproval->marketing_approval=='On hold')
                @role(('admin'))
                <label> Admin : </label>
                @endrole

                @role(('generalmanager'))
                <label> GM : </label>
                @endrole

                @role(('director'))
                <label> Director : </label>
                @endrole
                @role(('accountmanagersales'))
                <label> Account Manager-sales : </label>
                @endrole
                @role(('salesmanager'))
                <label> SalesManager : </label>
                @endrole

                {!! Form::model($marketingapproval,array('route'=>['update_order_approval',$marketingapproval->id],'method'=>'PUT' ))!!}
                {{ Form::hidden('marketingmanager', Auth::user()->id) }}
                <div class="form-group row">
                    <div class="col-md-8">
                        <?php $x = Config::get('distributor.orderApproval');?>
                        <select id="" name="marketing_approval" class="form-control"
                                required>
                            <option selected="selected" value=""
                                    disabled>{{$marketingapproval->marketing_approval}}</option>
                            @foreach($x as $dep)
                                <option @if($marketingapproval->marketing_approval!='On hold') disabled
                                        @endif value="{{$dep}}">
                                    {{$dep}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-md-8">Remark</label>

                        <div class="col-md-12">
                            <textarea  class="form-control" type="text" name="approval_remark"  ></textarea>
                        </div>
                    </div>
                    @if($marketingapproval->marketing_approval=='On hold')
                        <div align="right">
                        {{Form::submit('Submit', array('class'=>'btn btn-primary','title'=>'Add remark and Order status for Account-manager Sales'))}}
                        {!! Form::close() !!}
                            </div>
                    @endif
                </div>
            @endif
        </div>
        @endrole
    @endif

    @if(isset($marketingapproval->marketingmanager ) && $marketingapproval->order_id==$orderId->id)
        @role((['accountmanagersales','salesmanager','admin', 'generalmanager', 'director']))
        <div class="pad">
            @if($marketingapproval->marketing_approval=='Rejected')
                @role(('admin'))
                <label> Admin : </label>
                @endrole

                @role(('generalmanager'))
                <label> GM : </label>
                @endrole

                @role(('director'))
                <label> Director : </label>
                @endrole
                @role(('accountmanagersales'))
                <label> Account Manager-sales : </label>
                @endrole
                @role(('salesmanager'))
                <label> SalesManager : </label>
                @endrole
                {!! Form::model($marketingapproval,array('route'=>['update_order_approval',$marketingapproval->id],'method'=>'PUT' ))!!}
                <div class="form-group row">
                    <div class="col-md-8">
                        <?php $x = Config::get('distributor.orderApproval');?>
                        <select id="" name="marketing_approval" class="form-control"
                                required>
                            <option selected="selected" value=""
                                    disabled>{{$marketingapproval->marketing_approval}}</option>
                            @foreach($x as $dep)
                                <option @if($marketingapproval->marketing_approval!='Rejected') disabled
                                        @endif value="{{$dep}}">
                                    {{$dep}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group clearfix">
                        <label class="col-md-8">Remark</label>

                        <div class="col-md-12">
                            <textarea  class="form-control" type="text" name="approval_remark"  ></textarea>
                        </div>
                    </div>
                    @if($marketingapproval->marketing_approval=='Rejected')
                        <div align="right">
                        {{Form::submit('Submit', array('class'=>'btn btn-primary','title'=>'Add remark and Order status for Account-manager Sales'))}}
                        {!! Form::close() !!}
                            </div>
                    @endif
                </div>
            @endif
        </div>
        @endrole
    @endif

    {{--@if(isset($marketingapproval->marketingmanager) && $marketingapproval->marketing_approval!=null)--}}
        {{--<label>Approved by : </label>--}}
        {{--<div>  {{$marketingapproval->marketing_approval}} by <a>{{$marketingapproval->marketingmanager}}<br>{{$marketingapproval->user_name}}</a>--}}
        {{--</div>--}}
    {{--@endif--}}
</div>