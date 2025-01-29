@extends('admin.master')
@section('title')
    Seller Pending | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
{{--                <div class="page-title-right" style="display: block!important;">--}}
{{--                    <a href="{{route('category.add')}}" class="btn btn-primary ms-1">--}}
{{--                        Add Category--}}
{{--                    </a>--}}
{{--                </div>--}}
                <h4 class="page-title">Seller Pending</h4>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Seller Name</th>
                            <th>Shop Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Verification Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sellers as $seller)
                            @php
                                // Check if verification_info exists and is a valid JSON string
                                $verificationInfo = json_decode($seller->verification_info, true); // Decode as array
                                $shopName = null;

                                // Only proceed if verification_info is not null and is a valid array
                                if ($verificationInfo && is_array($verificationInfo)) {
                                    foreach ($verificationInfo as $info) {
                                        if ($info['label'] == 'Shop Name') {
                                            $shopName = $info['value'];
                                            break; // Exit the loop once the shop name is found
                                        }
                                    }
                                }
                            @endphp

                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$seller->name}}</td>
                                <td>{{ $shopName ?? 'N/A' }}</td> <!-- Show 'N/A' if shop name is not found -->
                                <td>{{$seller->email}}</td>
                                <td>{{$seller->mobile}}</td>
                                <td>
                                    @if($seller->is_verified == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('seller.detail', ['id' => $seller->id])}}" style="background-color: #07ffea!important; border-color: #07ffea!important;" class="btn btn-primary btn-sm" title="Seller Verification Info">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                @if ($seller->status == 1) <!-- Current status is Unbanned -->
                                    <button
                                        type="button"
                                        onclick="changeSellerStatus({{ $seller->id }}, 2);"
                                        class="btn btn-danger btn-sm"
                                        style="background-color: #ff0000!important; border-color: #ff0000!important;"
                                        title="Ban Seller">
                                        <i class="fa fa-ban"></i>
                                    </button>
                                @elseif ($seller->status == 2) <!-- Current status is Banned -->
                                    <button
                                        type="button"
                                        onclick="changeSellerStatus({{ $seller->id }}, 1);"
                                        class="btn btn-success btn-sm"
                                        style="background-color: #54ff0d!important; border-color: #54ff0d!important;"
                                        title="Unban Seller">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    @endif

                                    <form
                                        action="{{ route('seller.status-change', ['id' => $seller->id]) }}"
                                        method="POST"
                                        id="sellerStatusForm{{ $seller->id }}">
                                        @csrf
                                        <input type="hidden" name="status" id="status{{ $seller->id }}">
                                    </form>

                                    <script>
                                        function changeSellerStatus(sellerId, status) {
                                            const confirmationMessage = status === 1
                                                ? 'Are you sure you want to ban this seller?'
                                                : 'Are you sure you want to unban this seller?';

                                            if (confirm(confirmationMessage)) {
                                                document.getElementById('status' + sellerId).value = status;
                                                document.getElementById('sellerStatusForm' + sellerId).submit();
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

@endsection



