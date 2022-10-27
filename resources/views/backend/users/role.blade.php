<x-admin-layout>
    <div class="card mx-3 p-2">
        <div class="d-flex align-items-center">
            <div class="mr-auto p-2">
                <h3 class="card-title">Users Role</h3>
            </div>
            <div class="p-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-danger">
                    <i class="fa fa-arrow-left"></i>
                    Back</a>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card mx-2">
                        <div class="card-body px-3 pt-4">
                            <div><span class="font-weight-bold">User Name: </span>{{ $user->name }}</div>
                            <div><span class="font-weight-bold">Email: </span>{{ $user->email }}</div>
                        </div>
                        <!-- /.card-body -->
                        {{-- user permission --}}
                        <div class="card-body px-3 pt-2">
                            <h4 class="">Roles</h4>
                            <div class="mb-3">
                                @if ($user->roles)
                                    <ul>
                                        @foreach ($user->roles as $user_role)
                                            <li>
                                                <span>{{ $user_role->name }} - </span>
                                                <form class="d-inline-block" method="POST"
                                                    action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-xs d-inline-block text-danger">Remove</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>No Roles</span>
                                @endif
                            </div>
                            <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control form-control-sm">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn mt-1 btn-outline-primary d-block">Assign</button>
                            </form>
                        </div>

                        {{-- role  --}}
                        <div class="card-body px-3 pt-2">
                            <h4 class="">Permissions</h4>
                            <div class="mb-3">
                                @if ($user->permissions)
                                    <ul>
                                        @foreach ($user->permissions as $user_permission)
                                            <li>
                                                <span>{{ $user_permission->name }} - </span>
                                                <form class="d-inline-block" method="POST"
                                                    action="{{ route('admin.users.permissions.remove', [$user->id, $user_permission->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-xs d-inline-block text-danger">Remove</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>No permission</span>
                                @endif
                            </div>
                            <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="permission">Permission</label>
                                    <select name="permission" id="permission" class="form-control form-control-sm">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn mt-1 btn-outline-primary d-block">Assign</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</x-admin-layout>
<script>
    @if (Session::has('message'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('message') }}");
    @endif
    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif
    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif
</script>
