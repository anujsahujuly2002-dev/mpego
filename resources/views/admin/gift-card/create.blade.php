@extends('admin.layouts.master')
@push('title')
    Gift Card Create
@endpush
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Create Gift Card</h4>
                </div>
                <div class="card-body">
                    <form id="giftCardForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gift-code" class="form-label">Gift Code</label>
                                <input type="text" class="form-control" id="group" placeholder="Enter Gift Code" name="gift-code">
                                <div class="invalid-feedback gift-code-error"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gift-image" class="form-label">Gift Image</label>
                                <input type="file" class="form-control" id="group" placeholder="Enter Gift Code" name="gift-image">
                                <div class="invalid-feedback gift-image-error"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gift-expire" class="form-label">Gift Expire</label>
                                <input type="text" class="form-control" id="gift-expire" placeholder="Enter Gift Code" name="gift-expire"  data-provider="flatpickr" data-date-format="M,d,Y">
                                <div class="invalid-feedback gift-expire-error"></div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    <!-- end col -->
    </div>
</div>
@endsection
@push('script')
<script>
    giftCardForm.onsubmit = async (e)=>{
        e.preventDefault();
        makePostRequest("{{route('admin.gift.card.store')}}",giftCardForm,'giftCardForm');
    }
</script>
@endpush
