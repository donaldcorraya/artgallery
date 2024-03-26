@extends('admin.layout')
@section('title', 'Rating | Art Gallery')
@section('content')


<style>
    .message{
        background: #198754;
        color: #fff;
        padding: 10px 35px;
        width: max-content;
        border-radius: 10px;
        position: fixed;
        right: 15px;
        display: none;
    }
</style>

<main id="main" class="main">
<div class="message">Data saved</div>
    <div class="pagetitle">
        <h1>Pending Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/ratingAll')}}">Rating</a></li>
                <li class="breadcrumb-item active">view</li>
            </ol>
        </nav>
    </div>
    
    <section class="section">
        <div class="row">            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Status</h5>

                        <table class="table table-borderless">

                            <tr>
                                <th>Status</th>
                                <td>                                    
                                    <select id="status" class="form-select">
                                        <option value="0" {{ ($ratingPendingDetails->status == 0)? 'selected' : '' }}>Pending</option>
                                        <option value="1" {{ ($ratingPendingDetails->status == 1)? 'selected' : '' }}>Published</option>
                                        <option value="2" {{ ($ratingPendingDetails->status == 2)? 'selected' : '' }}>Hidden</option>
                                    </select>
                                </td>
                            </tr>

                            

                        </table>
                    </div>
                </div>
            </div>

            
        </div>
    </section>
</main>

<script>

$('#status').on('change', function() {
        var status = $('#status').val();

        $('.spinner-border').show();
        $.ajax({
            type: 'POST',
            url: "{{ route('rating.status.update')}}",
            data: {
                "_token": "{{ csrf_token() }}",
                'status': status,
                'id': "{{ $ratingPendingDetails->id }}",
            },
            dataType: 'json',
            success: function(data) {
                if(data) {
                    $('.message').show();
                    setTimeout(function() { $(".message").hide(); }, 2000);
                }
            },
            error: function(req, status, error) {
                var err = req.responseJSON.value;
                console.log(err);
            }

        });
    });

</script>


@endsection