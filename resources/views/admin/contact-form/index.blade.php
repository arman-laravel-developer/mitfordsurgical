@extends('admin.master')
@section('title')
    Customer Queries manage | {{env('APP_NAME')}}
@endsection

@section('body')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Customer Queries</li>
                    </ol>
                </div>
                <h4 class="page-title">Inbox</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- end page email-title -->

    <div class="row">
        <!-- Right Sidebar -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('contactForm.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="btn-group">
                            <button type="submit" class="btn btn-danger"><i class="mdi mdi-delete-variant font-16"></i> Delete Selected</button>
                        </div>
                        <ul class="email-list mt-3">
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="selectAll">
                                <label class="form-check-label" for="selectAll">Select All</label>
                            </div>
                            @foreach($contactForms as $contactForm)
                                <li class="@if($contactForm->read_status == 2) unread @endif">
                                    <div class="email-sender-info">
                                        <div class="checkbox-wrapper-mail">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="contact_form_ids[]" value="{{$contactForm->id}}" id="mail1">
                                                <label class="form-check-label" for="mail1"></label>
                                            </div>
                                        </div>
                                        <a href="{{route('contactForm.detail', ['id' => $contactForm->id])}}" class="email-title">{{$contactForm->name}}</a>
                                    </div>
                                    <div class="email-content">
                                        <a href="{{route('contactForm.detail', ['id' => $contactForm->id])}}" class="email-subject">{{$contactForm->subject}}</a>
                                        <div class="float-end">{{$contactForm->created_at->format('Y-m-d h:m:i A')}}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                    <div class="row">
                        <div class="col-7 mt-1">
                            Showing {{ $contactForms->firstItem() }} - {{ $contactForms->lastItem() }} of {{ $contactForms->total() }}
                        </div> <!-- end col-->
                        <div class="col-5">
                            <div class="btn-group float-end">
                                @if($contactForms->onFirstPage())
                                    <button type="button" class="btn btn-light btn-sm" disabled><i class="mdi mdi-chevron-left"></i></button>
                                @else
                                    <a href="{{ $contactForms->previousPageUrl() }}" class="btn btn-light btn-sm"><i class="mdi mdi-chevron-left"></i></a>
                                @endif

                                @if($contactForms->hasMorePages())
                                    <a href="{{ $contactForms->nextPageUrl() }}" class="btn btn-info btn-sm"><i class="mdi mdi-chevron-right"></i></a>
                                @else
                                    <button type="button" class="btn btn-info btn-sm" disabled><i class="mdi mdi-chevron-right"></i></button>
                                @endif
                            </div>
                        </div> <!-- end col-->
                    </div>
                </div>
                <!-- end card-body -->
                <div class="clearfix"></div>
            </div> <!-- end card-box -->

        </div> <!-- end Col -->
    </div><!-- End row -->

    <script>
        document.getElementById('selectAll').addEventListener('change', function (e) {
            const checkboxes = document.querySelectorAll('input[name="contact_form_ids[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
        });
    </script>
@endsection
