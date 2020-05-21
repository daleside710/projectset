@extends('backend.layouts.master')
@section('title','Messages')
@section('content')
<script type="text/javascript">
    var APP_URL = {!! json_encode(url('/')) !!}
</script>
    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong> {{ session()->get('success') }}.
                    </div>
                @endif

                @if(session()->has('danger'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed!</strong> {{ session()->get('danger') }}.
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="content col-lg-12">

                <form action="{{ route('admin.sms.send') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="sms_token" name="_token" value="{{ Session::token() }}">

                    <!-- Create new products -->
                    <div class="card card--has-table" id="smsCard">
                        <div class="card__header card__header--has-btn">
                            <h4>Send Messages</h4>
                        </div>
                        <div class="card__content" style="padding: 20px;">
                            <div class="row">
                                <div class="col-md-8 form-group">
                                    <label for="user_id">Select Phone numbers</label>
                                    <select id="selectnumbers" class="selectpicker" multiple>
                                        <option value="All">Select All</option>
                                        @foreach($smsData as $sms)
                                            <option value="{{ $sms->phone }}">{{ $sms->phone }}</option>
                                        @endforeach
                                    </select>
                                </div>
                              <!--   <div class="col-md-4">
                                    <button type="button" id="selectAll"
                                            class="btn btn-primary-turquoise btn-sm float-right">Select All
                                    </button>
                                    <button type="button" id="deselectAll" class="btn btn-danger btn-sm float-right">
                                        Deselect All
                                    </button>
                                </div> -->
                            </div>
                           <!--  <div class="row" id="append_phone_numbers">
                                <div class="col-md-12 form-check" style="margin-left:15px;margin-bottom: 10px;">
                                    <input type="checkbox" class="form-check-input" id="select_phone_numbers" name="select_all">
                                    <label class="form-check-label" for="exampleCheck1">Select All Phone numbers</label>
                                </div>
                            </div> -->
                            <div class="row" id="phone_numbers">
                                <div class="col-md-12 form-group">
                                    <label for="phone">Mobile #</label>
                                    <textarea required id="phone" rows="12" name="phone" class="form-control" placeholder="Enter phone number with comma separator e.g +902125552222, +902123341232"></textarea>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="content">Message</label>
                                    <textarea name="message" required id="message" rows="5"
                                              class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                     <button rows="8" class="btn btn-info btn-primary-turquoise btn-sm float-right" type="submit">Send SMS</button>
                                </div>
                            </div>
                        </div>


                    </div>                   

                </form>

            </div>

        </div>

    </div>

@endsection

@push('style')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css"/>
    <style type="text/css">
        .dropdown.bootstrap-select.show-tick {
            display: block;
        }

        .dropdown.bootstrap-select.show-tick.show {
            width: 100%;
        }

        .dropdown-menu.show {
            width: 100%;
        }

        .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 100%;
        }
    </style>
@endpush
@push('script')

    <script src="{{ asset('bootstrap-select.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
            $("#deselectAll").hide();
            $("#selectAll").on('click', function () {
                $(this).hide();
                $(".selectpicker").selectpicker('selectAll');
                $("#deselectAll").show();
            });
            $("#deselectAll").on('click', function () {
                $(this).hide();
                $(".selectpicker").selectpicker('deselectAll');
                 console.log('axt');
                $("#selectAll").show();
            });

            $('#selectnumbers').on('changed.bs.select', function (e) {

                var txt = $('.filter-option-inner-inner').text();
                if(txt == 'Nothing selected') {
                    $('#phone').val('');
                } else {
                    $('#phone').val(txt.replace('Select All, ', '')); 
                }
                
            });

        });

        $('#selectnumbers').on('change', function(){
            var thisObj = $(this);
            var isAllSelected = thisObj.find('option[value="All"]').prop('selected');
            var lastAllSelected = $(this).data('all');
            var selectedOptions = (thisObj.val())?thisObj.val():[];
                var allOptionsLength = thisObj.find('option[value!="All"]').length;
             
             console.log(selectedOptions);
              var selectedOptionsLength = selectedOptions.length;
             
            if(isAllSelected == lastAllSelected){
            
            if($.inArray("All", selectedOptions) >= 0){
                selectedOptionsLength -= 1;      
            }
                    
              if(allOptionsLength <= selectedOptionsLength){
              
              thisObj.find('option[value="All"]').prop('selected', true).parent().selectpicker('refresh');
              isAllSelected = false;
              }else{       
                thisObj.find('option[value="All"]').prop('selected', false).parent().selectpicker('refresh');
                 isAllSelected = false;
              }
              
            }else{          
                thisObj.find('option').prop('selected', isAllSelected).parent().selectpicker('refresh');
            }
           
                $(this).data('all', isAllSelected);
        }).trigger('change');




        // $(document).mouseup(function(e) 
        // {
        //     var container = $(".dropdown-menu");

        //     // if the target of the click isn't the container nor a descendant of the container
        //     if (!container.is(e.target) && container.has(e.target).length === 0) 
        //     {
        //         container.addClass('hide').removeClass('show');
        //     }
        // });

    </script>
@endpush