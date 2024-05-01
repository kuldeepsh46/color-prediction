@extends('Layout.admindashboard')

@section('css')

@endsection



@section('content')
    <div class="content-wrapper">

        <div class="page-header">

            <h3 class="page-title">

                <span class="page-title-icon bg-gradient-primary text-white me-2">

                    <i class="mdi mdi-home"></i>

                </span> Upload New Ad

            </h3>

        </div>

        <div class="row">

            <div class="grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">Ad detail</h4>

                        <form class="forms-sample" id="uploadAd">

                            @csrf

                            

                            <div class='row'>
                                <input type="hidden" name="id" value="1">
                                <div class='col-xs-6 col-md-6'>
                                    <div class="form-group">

                                        <label for="uploadAd">Select Ad Video</label>
        
                                        <input type="file" class="form-control" id="uploadAd" name="uploadAd" />
        
                                    </div>
                                </div>
                                <div class='col-xs-6 col-md-6'>
                                    <div class='form-group'>
                                        <label for="videoLink">Ad Link</label>
                                        <input type="text" class="form-control" id="videoLink" name="videoLink" placeholder="Enter Video Link" />
                                    </div>
                                </div>
                                <div class='col-xs-6 col-md-6'>
                                    <div class='form-group'>
                                        <label for="adDuration">Ad Duration (in Days)</label>
                                        <input type="text" class="form-control" id="adDuration" name="adDuration" placeholder="Enter Ad Duration (in Days)" />
                                    </div>
                                </div>
                                <div class='col-xs-6 col-md-6'>
                                    <div class='form-group'>
                                        <label for="adAmount">Ad Amount (in INR)</label>
                                        <input type="text" class="form-control" id="adAmount" name="adAmount" placeholder="Enter Ad Amount (in INR)" />
                                    </div>
                                </div>
                                <div class='col-xs-6 col-md-6'>
                                    <div class='form-group'>
                                        <label for='adStartDate'>Ad Start Date</label>
                                        <input type='date' class='form-control' id='adStartDate' name='adStartDate' />
                                    </div>
                                </div>
                                <div class='col-xs-6 col-md-6 paymentType'>
                                    <div class='form-group'>
                                        <label for="paymentType" style="padding-bottom: 16px;">Payment Type</label><br>
                                        
                                       <input type="radio" class="" id="cash" name="paymentType" value="0" />&ensp;<label for="paymentType">Cash</label>&emsp;&emsp;
                                       <input type="radio" class="" id="upi" name="paymentType" value="1" />&ensp;<label for="paymentType"> UPI</label>&emsp;&emsp;
                                       <input type="radio" class="" id="netBanking" name="paymentType" value="2" />&ensp;<label for="paymentType">Net Banking</label>&emsp;&emsp;
                                    </div>
                                </div>
                                <div class='col-xs-6 col-md-6'>
                                    <!--<div class='form-group'>-->
                                    <!--    <label for="paymentReceivedBy">Payment Received By</label>-->
                                    <!--    <input type="text" class="form-control" id="paymentReceivedBy" name="paymentReceivedBy" placeholder="Payment Received By" />-->
                                    <!--</div>-->
                                </div>
                            </div>
                            <button type="submit" class="btn btn-gradient-primary me-2">Upload</button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- content-wrapper ends -->

@endsection



@section('js')

    <script>
    $("#upi").click(() => {
        if($("#transactionNo").length == 0) {
            $("<div class='col-xs-6 col-md-6 transactionNo'><div class='form-group'><label for='transactionNo'>Payment Transaction No</label><input type='text' class='form-control' id='transactionNo' name='transactionNo' placeholder='Enter Transaction No' /></div></div>").insertAfter(".paymentType");
        }
    });
    $("#netBanking").click(() => {
        if($("#transactionNo").length == 0) {
            $("<div class='col-xs-6 col-md-6 transactionNo'><div class='form-group'><label for='transactionNo'>Payment Transaction No</label><input type='text' class='form-control' id='transactionNo' name='transactionNo' placeholder='Enter Transaction No' /></div></div>").insertAfter(".paymentType");
        }
    });
    $("#cash").click(() => {
        if($("#transactionNo").length == 1) {
            $(".transactionNo").remove();
        }
    });

        $("#uploadAd").on('submit', function(e) {

            e.preventDefault();

        });

        $("#uploadAd").validate({

            submitHandler: function(form) {

                apex("POST", "{{ url('admin/api/uploadad') }}", new FormData(form), form,);

            }

        });

    </script>

@endsection

