@extends('layouts.admin')
@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Sửa thành viên
            </div>
            <div class="card-body">
                <form action='{{ route('admin.user.update',$user->id) }}' method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
                        @error('name')
                            <small class='text-danger'>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input class="form-control" type="password" name="password" id="password">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Xác nhận mật khẩu</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password-confirm">
                    </div>
                    <div class="form-group">
                        <label for="role_id">Nhóm quyền</label>
                        <select class="form-control" id="role_id" name='role_id'>
                            <option value="">Chọn quyền</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <small class='text-danger'>{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" name='btn-edit' value="Sửa">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
