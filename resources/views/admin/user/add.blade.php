@extends('layouts.admin')
@section('content')
    <style>
        div.bootstrap-tagsinput {
            width: 100%;
        }

        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: black !important;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm thành viên
            </div>
            <div class="card-body">
                <form action='{{ route('admin.user.store') }}' method='POST'>
                    @csrf
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                            <small class='text-danger'>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email" value="{{ old('email') }}">
                        @error('email')
                            <small class='text-danger'>{{ $message }}</small>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <input type="text" class="form-control" value="" data-role="tagsinput" name='role[]'/>
                    </div>
                    <div class="form-group" role="textbox">
                        <div class="row">
                            <div class='col-4'>
                                <h5>Tỉnh/thành phố <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="province_id" class="form-control">
                                        <option value="" selected="" disabled="">Chọn tỉnh/thành phố </option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class='col-4'>
                                <h5>Quận/huyện <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="district_id" class="form-control">
                                        <option value="" selected="" disabled="">Chọn quận/huyện </option>
                                    </select>
                                </div>
                            </div>
                            <div class='col-4'>
                                <h5>Phường/xã <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="ward_id" class="form-control">
                                        <option value="" selected="" disabled="">Chọn phường/xã </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
                        <label for="role_id">Vai trò</label>
                        <select class="form-control" id="role_id" name='role_id'>
                            <option value="">Chọn vai trò</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                            {{-- <option value="2" @if (old('role_id') == 2) selected @endif>User</option> --}}
                        </select>
                        @error('role_id')
                            <small class='text-danger'>{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" name='btn-add' value="Thêm mới">Thêm mới</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {

            $('select[name="province_id"]').on('change', function() {
                var province_id = $(this).val();
                if (province_id) {
                    $.ajax({
                        url: "{{ url('admin/user/districts/ajax/') }}/" + province_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var d = $('select[name="district_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="district_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });

            $('select[name="district_id"]').on('change', function() {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: "{{ url('admin/user/wards/ajax/') }}/" + district_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="ward_id"]').html('');
                            var d = $('select[name="ward_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="ward_id"]').append('<option value="' +
                                    value.id +
                                    '">' + value.name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });

        });
    </script>
@endsection
