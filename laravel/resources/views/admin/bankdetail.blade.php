@extends('Layout.admindashboard')

@section('css')

@endsection



@section('content')
<?php
if($bank['status'] == true) {
    $bankName = $bank['data']['bank_name'];
    $accNo = $bank['data']['account_no'];
    $accHolderName = $bank['data']['account_holder_name'];
    $ifscCode = $bank['data']['ifsc_code'];
    $bankMobNo = $bank['data']['mobile_no'];
    $upiId = $bank['data']['upi_id'];
    $barCode = isset($bank['data']['barcode']);
    if(!$barCode) {
        $barCode = "";
    } else {
        $barCode = "../images/" . $bank['data']['barcode'];
    }
    } else {
        $bankName = "";
        $accNo = "";
        $accHolderName = "";
        $ifscCode = "";
        $bankMobNo = "";
        $upiId = "";
        $barCode = "";
    }

?>
    <div class="content-wrapper">

        <div class="page-header">

            <h3 class="page-title">

                <span class="page-title-icon bg-gradient-primary text-white me-2">

                    <i class="mdi mdi-home"></i>

                </span> Bank Setup

            </h3>

        </div>

        <div class="row">

            <div class="grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">Bank detail</h4>

                        <form class="forms-sample" id="bankdetail">

                            @csrf

                            <input type="hidden" name="id" value="1">

                            <div class="form-group">

                                <label for="bank_name">Bank Name</label>

                                <input type="text" class="form-control" id="bank_name" name="bank_name"

                                    placeholder="Bank Name" value="{{ $bankName }}">

                            </div>
                            
                             <div class="form-group">

                                <label for="holdername">Account holder name</label>

                                <input type="text" class="form-control" id="holdername" name="holdername"

                                    placeholder="Account holder name" value="{{ $accHolderName }}">

                            </div>

                            <div class="form-group">

                                <label for="account_no">Account No</label>

                                <input type="text" class="form-control" id="account_no" name="account_no"

                                    placeholder="Account No" value="{{ $accNo }}">

                            </div>
                            
                            <div class="form-group">

                                <label for="ifsccode">IFSC Code</label>

                                <input type="text" class="form-control" id="ifsccode" name="ifsccode"

                                    placeholder="IFSC Code" value="{{ $ifscCode }}">

                            </div>
                            
                            <div class="form-group">

                                <label for="upi_id">UPI ID</label>

                                <input type="text" class="form-control" id="upi_id" name="upi_id"

                                    placeholder="UPI Id" value="{{ $upiId }}">

                            </div>

                           
                            <div class="form-group">

                                <label for="mobile_no">Mobile no</label>

                                <input type="text" class="form-control" id="mobile_no" name="mobile_no"

                                    placeholder="Mobile No." value="{{ $bankMobNo }}">

                            </div>

                            
                            <div class="form-group">

                                <label for="value">Bar code</label>

                                <input type="file" class="form-control" id="barcode" name="barcode">

                            </div>
                            <img src="{{$barCode}}" height="150px" width="200px" />
                            <button type="submit" class="btn btn-gradient-primary me-2">Update</button>

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

        $("#bankdetail").on('submit', function(e) {

            e.preventDefault();

        });

        $("#bankdetail").validate({

            submitHandler: function(form) {

                apex("POST", "{{ url('admin/api/bankdetail') }}", new FormData(form), form,

                    "/admin/bank-detail", "#");

            }

        });

    </script>

@endsection

