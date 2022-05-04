@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách thành viên</h5>
                <div class="form-search form-inline">
                    <form action="" method="post">
                        @csrf
                        <input type="text" class="form-control form-search mb-1" placeholder="Tìm kiếm" name='keyword'
                            value="{{ request()->keyword }}">
                        <input type="submit" name="btn-search" value="search" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('errors'))
                    <div class="alert alert-danger">
                        {{ session('errors') }}
                    </div>
                @endif
                <div class="analytic">
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Kích
                        hoạt<span class="text-muted">({{ $count[0] }})</span></a>
                    <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Vô hiệu
                        hóa<span class="text-muted">({{ $count[1] }})</span></a>
                </div>
                <form action="{{ route('admin.user.action') }}" method="post">
                    @csrf
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" name='act'>
                            <option value="">Chọn</option>
                            @foreach ($list_act as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Họ tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Quyền</th>
                                <th scope="col">Ngày tạo</th>
                                @if (request()->status != 'trash')
                                <th scope="col">Tác vụ</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->total() > 0)
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($users as $user)
                                    @php
                                        $t++;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="checkbox" name='list_check[]' value="{{ $user->id }}">
                                        </td>
                                        <td scope="row">
                                            {{ $t }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ optional($user->role)->name }}
                                        </td>
                                        <td>
                                            {{ date('d/m/Y', strtotime($user->created_at)) }}
                                        </td>
                                        <td>
                                            @if (request()->status != 'trash')
                                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                            @endif
                                            @if (Auth::id() != $user->id)
                                                @if (request()->status != 'trash')
                                                    <a href="{{ route('admin.user.delete', $user->id) }}"
                                                        onclick="return confirm('Bạn chắc chắn xóa bản ghi này')"
                                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                            class="fa fa-trash"></i></a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
                                        <p class="text-center">
                                            Không tìm thấy bản ghi này !
                                        </p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $users->appends(request()->input())->links() }}
                </form>

            </div>
        </div>
    </div>
@endsection
