@extends('Layout.admindashboard')
@section('css')

@endsection
@section('content')
<div class="content-wrapper">

        <div class="page-header">

            <h3 class="page-title">

                <span class="page-title-icon bg-gradient-primary text-white me-2">

                    <i class="mdi mdi-home"></i>

                </span> Ad Cost Setup

            </h3>
            <h3 class="page-title"><button id="addPackageBtn" style="background: #1be71b;border: solid 1px;border-radius: 10px; padding: 7px;">Add Package</button></h3>

        </div>

        <div class="row">

            <div class="grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">

                        <!--<h4 class="card-title">Bank detail</h4>-->

                        <form class="forms-sample" id="adCostSetup">
                            @csrf
                            <?php
                            if($allAdPackages) {
                            $i = 1;
                            ?>
                            @foreach($allAdPackages as $item)
                            <?php
                            $rowClassName = "row " . $i;
                            $packageCostClassName = "packageCost " . $i;
                            $packageDurationClassName = "packageDuration " . $i;
                            $minusBtnClassName = "minusBtn " . $i;
                            ?>
                            <div class='{{$rowClassName}}'>
                                <div class='col-xs-5 col-md-5 ad_package_cost'>
                                    <div class='form-group'>
                                        <label for='{{$packageCostClassName}}'>Package Cost (In INR)</label>
                                        <input type='text' class='form-control' id='{{$packageCostClassName}}' name='packageCost{{$i}}' value='{{$item->Cost}}' placeholder='Package Cost (in INR)' />
                                    </div>
                                </div>
                                <div class='col-xs-5 col-md-5 ad_package_duration'>
                                    <div class='form-group'>
                                        <label for='{{$packageDurationClassName}}'>Package Duration (In Days)</label>
                                        <input type='text' class='form-control' id='{{$packageDurationClassName}}' name='packageDuration{{$i}}' value='{{$item->Duration}}' placeholder='Package Duration (in days)' />
                                    </div>
                                </div>
                                <div class='col-xs-2 col-md-2 ad_package_minus'>
                                    <div class='form-group minusBtns'>
                                        <button type='button' id='minusBtn{{$i}}' class='{{$minusBtnClassName}}'>Delete</button>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                            ?>
                            @endforeach
                            <?php
                            }
                            ?>
                            <button type="submit" class="btn btn-gradient-primary me-2" id="submitBtn">Submit</button>
                            <div class="packageAddStatus"></div>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
@section('js')
<script>
function removePackage(className) {
    $("#adCostSetup").find(".row." + className).remove();
}
    $("#addPackageBtn").click(function() {
        var packageCount = $(".ad_package_cost").length + 1;
        $("<div class='row "+ packageCount +"'><div class='col-xs-5 col-md-5 ad_package_cost'><div class='form-group'><label for='packageCost"+ packageCount +"'>Package Cost (In INR)</label><input type='text' class='form-control' id='packageCost"+ packageCount +"' name='packageCost"+ packageCount +"' placeholder='Package Cost (in INR)' /></div></div><div class='col-xs-5 col-md-5 ad_package_duration'><div class='form-group'><label for='packageDuration"+ packageCount +"'>Package Duration (In Days)</label><input type='text' class='form-control' id='packageDuration"+ packageCount +"' name='packageDuration"+ packageCount +"' placeholder='Package Duration (in days)' /></div></div><div class='col-xs-2 col-md-2 ad_package_minus'><div class='form-group minusBtns'><button type='button' id='minusBtn"+ packageCount +"' class='minusBtn "+ packageCount +"'>Delete</button></div></div></div>").insertBefore($("#submitBtn"));
            $(".minusBtn").click(function() {
                var className = this.className;
                className = className.split(" ");
                className = className[1];
                removePackage(className);
            });
    });
        function createAdPackage() {
        var formData = new FormData(document.getElementById('adCostSetup'));
        var adCount = $("#adCostSetup").find(".row").length;
        formData.append('adCount', adCount);
        $.ajax({
        url: "{{ url('admin/api/adcostsetup') }}",
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response.success);
            if(response.success == true) {
                $(".packageAddStatus").text("Package Updated Successfully.");
            } else {
                $(".packageAddStatus").text("Something went wrong. Please try again.");
            }
            setTimeout(() => {
                $(".packageAddStatus").text('');
            }, 2000);
        },
        error: function(error) {
        }
    });
}
    $("form").on('submit', function(e) {
            e.preventDefault();
            createAdPackage();
        });
        $(".minusBtn").click(function() {
                var className = this.className;
                className = className.split(" ");
                className = className[1];
                removePackage(className);
            });
</script>
@endsection