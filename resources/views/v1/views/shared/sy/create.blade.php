@extends('v1.master.master_app')

@section('content')

@include('v1/views/shared/sy/content_header')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                @include('v1/components/errors/flash_message')

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Add SY</h3>
                        <small>Note: The end year field will be automatically filled after selecting the start year.</small>
                    </div>
                    <form method="POST" action="{{ route('sy.store') }}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="card-body">

                            <div class="form-group">
                                <label>Start Year*</label>
                                <select name="start" id="start" class="form-control">
                                    <option value="" selected disabled>Select Start Year</option>
                                    <!-- <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option> -->
                                </select>
                                @if ($errors->has('start'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('start') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label>End Year*</label>
                                <select name="end" id="end" class="form-control" readonly>
                                    <option value="" selected disabled>-</option>
                                </select>
                                @if ($errors->has('end'))
                                <span class="help-block align-left" style="color:red;">{{
                                    $errors->first('end') }}</span>
                                @endif
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submitBtn" class="btn btn-primary pull-right" disabled>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

    $(function () {
        var newArray = [];
        var initialStartYearOptions = ['<option value="" selected disabled>Select Start Year</option>'];
        let startYearInput = $('#start');

        $.ajax({
            type: 'GET',
            url: '{!!URL::to('syStartYearApi')!!}',
            success:function(res) {
                console.log(res)
                var newArray = [];
                $.each(res.data, function (index, value) {
                    initialStartYearOptions += '<option value="' + value + '">' + value + '</option>'
                });

                startYearInput.find('option').remove().end();
                startYearInput.append(initialStartYearOptions);
            },
            error:function(err) {
                console.log(err)
            }
        });
    });

    $('#start').on('change', function() {
        var startVal = $(this).val();
        var submitBtn = $('#submitBtn'), endYearInput = $('#end'), newEndVal='', newEndOptions='';

        newEndVal = parseInt(startVal) + 1;
        newEndOptions += '<option value="'+newEndVal+'">'+newEndVal+'</option>';

        endYearInput.find('option').remove().end();
        endYearInput.append(newEndOptions);

        submitBtn.prop('disabled', false);
    })
</script>

@stop
