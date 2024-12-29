@extends('admin.master')
@section('title')
    Language manage | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right" style="display: block!important;">
                    <a href="{{route('language.add')}}" class="btn btn-primary ms-1">
                        Add Language
                    </a>
                </div>
                <h4 class="page-title">Language Manage</h4>
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
                            <th>{{translate('Name')}}</th>
                            <th>{{translate('Code')}}</th>
                            <th>{{translate('Flutter App Lang Code')}}</th>
                            <th >{{translate('RTL')}}</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($languages as $key => $language)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $language->name }}</td>
                                <td>{{ $language->code }}</td>
                                <td>{{ $language->app_lang_code }}</td>
                                <td>
                                    <input type="checkbox" id="switch{{$language->id}}_featured" data-switch="none"
                                           {{ $language->rtl == 1 ? 'checked' : '' }}
                                           onchange="updateRTL({{$language->id}}, this.checked ? 1 : 0)">
                                    <label for="switch{{$language->id}}_featured" data-on-label="on" data-off-label="off"></label>
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{route('language.show', ['id' => $language->id])}}" title="{{ translate('Translation') }}">
                                        <i class="fa fa-language"></i>
                                    </a>
                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('language.edit', ['id' => $language->id])}}" title="{{ translate('Edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @if($language->code != 'en')
                                        <a href="javascript:void(0)" onclick="confirmDelete({{$language->id}});" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" title="{{ translate('Delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <form action="{{route('language.delete', ['id' => $language->id])}}" method="POST" id="languageDeleteForm{{$language->id}}">
                                            @csrf
                                        </form>
                                        <script>
                                            function confirmDelete(languageId) {
                                                var confirmDelete = confirm('Are you sure you want to delete this?');
                                                if (confirmDelete) {
                                                    document.getElementById('languageDeleteForm' + languageId).submit();
                                                } else {
                                                    return false;
                                                }
                                            }
                                        </script>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <script>
        function updateRTL(languageId, rtl) {
            $.ajax({
                url: '{{ route("language.updateRTL") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    language_id: languageId,
                    rtl: rtl
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.success);
                    } else if (response.error) {
                        toastr.error(response.error);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred while updating the product status.');
                }
            });
        }
    </script>

@endsection



