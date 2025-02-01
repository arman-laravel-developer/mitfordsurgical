@extends('admin.master')
@section('title')
    Subscriber manage | {{env('APP_NAME')}}
@endsection

@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Subscriber Manage</h4>
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
                            <th>Email</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subscribers as $subscriber)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$subscriber->email}}</td>
                            <td>
                                {{$subscriber->created_at->format('d-m-Y')}}
                            </td>
                            <td>
                                <a href="javascript:void(0)" onclick="confirmDelete({{$subscriber->id}});" style="background-color: #fb160a!important; border-color: #fb160a!important;" class="btn btn-danger btn-sm" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </a>

                                <form action="{{route('subscriber.delete', ['id' => $subscriber->id])}}" method="POST" id="subscriberDeleteForm{{$subscriber->id}}">
                                    @csrf
                                </form>
                                <script>
                                    function confirmDelete(subscriberId) {
                                        var confirmDelete = confirm('Are you sure you want to delete this?');
                                        if (confirmDelete) {
                                            document.getElementById('subscriberDeleteForm' + subscriberId).submit();
                                        } else {
                                            return false;
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



