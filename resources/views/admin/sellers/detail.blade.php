@extends('admin.master')
@section('title')
    Seller Detail | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right" style="display: block!important;">
                    <a href="javascript:void(0);"
                       class="btn btn-dark ms-1 @if($seller->status == 2 || is_null($seller->verification_info)) disabled-link @endif"
                       onclick="showConfirmationModal({{ $seller->id }}, 'reject');">
                        Reject
                    </a>

                    <a href="javascript:void(0);"
                       class="btn btn-danger ms-1 @if($seller->status == 2 || $seller->is_verified == 1 || is_null($seller->verification_info)) disabled-link @endif"
                       onclick="showConfirmationModal({{ $seller->id }}, 'approve');">
                        Accept
                    </a>
                </div>

                <!-- Confirmation Modal -->
                <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="confirmationMessage">
                                <!-- Confirmation message will be dynamically set here -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form id="actionForm" method="POST">
                                    @csrf
                                    <input type="hidden" name="button" id="actionType">
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .disabled-link {
                        pointer-events: none;
                        opacity: 0.6;
                        cursor: not-allowed;
                    }
                </style>

                <script>
                    function showConfirmationModal(sellerId, action) {
                        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                        const confirmationMessage = document.getElementById('confirmationMessage');
                        const actionType = document.getElementById('actionType');
                        const form = document.getElementById('actionForm');

                        if (action === 'approve') {
                            confirmationMessage.textContent = 'Are you sure you want to approve this seller?';
                            actionType.value = 1; // For approve
                        } else {
                            confirmationMessage.textContent = 'Are you sure you want to reject this seller?';
                            actionType.value = 2; // For reject
                        }

                        // Dynamically set the form action using Laravel's route helper
                        form.action = `{{ url('seller/approval') }}/${sellerId}`;
                        modal.show();
                    }
                </script>
                <h4 class="page-title">Seller Detail</h4>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="margin-bottom: -7%;">
                    <h3>User Info</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                        <tbody>
                        <tr>
                            <th class="text-muted">Seller Name</th>
                            <td>{{$seller->name}}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Seller Email</th>
                            <td>{{$seller->email}}</td>
                        </tr>
                        <tr>
                            <th class="text-muted">Seller Mobile</th>
                            <td>{{$seller->mobile}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="margin-bottom: -7%;">
                    <h3>Verification Info</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                        <tbody>
                        @php
                            $verificationInfo = $seller ? json_decode($seller->verification_info) : [];
                        @endphp

                        @if (!empty($verificationInfo))
                            @foreach ($verificationInfo as $info)
                                <tr>
                                    <th class="text-muted">{{ $info->label }}</th>
                                    @if (isset($info->type) && ($info->type == 'text' || $info->type == 'select' || $info->type == 'radio'))
                                        <td>{{ $info->value }}</td>
                                    @elseif (isset($info->type) && $info->type == 'multi_select')
                                        <td>
                                            {{ is_array(json_decode($info->value)) ? implode(', ', json_decode($info->value)) : $info->value }}
                                        </td>
                                    @elseif (isset($info->type) && $info->type == 'file')
                                        <td>
                                            <a href="{{ asset($info->value) }}" target="_blank" class="btn btn-info">{{ translate('Click here') }}</a>
                                        </td>
                                    @else
                                        <td>{{ $info->value }}</td> <!-- Fallback for undefined types -->
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="text-center text-muted">{{ translate('No verification information available.') }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

@endsection



