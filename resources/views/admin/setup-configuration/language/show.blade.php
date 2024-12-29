@extends('admin.master')
@section('title')
    Language View | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Language View</h4>
            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form class="form-horizontal" action="{{ route('language.key_value_store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $language->id }}">
                    <div class="card-body">
                        <table class="table table-striped table-bordered demo-dt-basic" id="tranlation-table" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th width="45%">{{translate('Key')}}</th>
                                <th width="45%">{{translate('Value')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($lang_keys as $key => $translation)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td class="key">{{ $translation->lang_value }}</td>
                                    <td>
                                        <input type="text" class="form-control value" style="width:100%" name="values[{{ $translation->lang_key }}]" @if (($traslate_lang = \App\Models\Translation::where('lang', $language->code)->where('lang_key', $translation->lang_key)->latest()->first()) != null)
                                        value="{{ $traslate_lang->lang_value }}"
                                            @endif>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="form-group mb-0 text-end">
                            <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

@endsection



