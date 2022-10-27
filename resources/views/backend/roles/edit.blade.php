<x-admin-layout>
    <div class="card mx-3 p-2">
        <div class="d-flex align-items-center">
            <div class="mr-auto p-2">
                <h3 class="card-title">Update Role</h3>
            </div>
            <div class="p-2">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-danger">
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
                            <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Role Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        aria-describedby="emailHelp" placeholder="Title" value="{{ $role->name }}">
                                    @error('name')
                                        <span class="mb-1 text-sm text-red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn mt-1 btn-primary d-block">Update</button>
                            </form>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-body px-3 pt-2">
                            <h4 class="">Permissions for this Role</h4>
                            <div class="mb-3">
                                @if ($role->permissions)
                                    <ul>
                                        @foreach ($role->permissions as $role_permission)
                                            <li>
                                                <span>{{$role_permission->name}} - </span>
                                                <form class="d-inline-block" method="POST" action="{{route('admin.roles.permissions.remove', [$role->id, $role_permission->id])}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs d-inline-block text-danger">Remove</button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span>No permission</span>
                                @endif
                            </div>
                            <form method="POST" action="{{ route('admin.roles.permissions', $role->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="permission">Permission</label>
                                    <select name="permission" id="permission" class="form-control form-control-sm">
                                        @foreach ($permissions as $permission)
                                            <option value="{{$permission->name}}">{{$permission->name}}</option>
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
    @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
  		toastr.info("{{ session('info') }}");
    @endif
    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif
</script>
