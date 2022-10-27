<x-admin-layout>
    <div class="card mx-3 p-2">
        <div class="d-flex align-items-center">
            <div class="mr-auto p-2">
                <h3 class="card-title">Update Permission</h3>
            </div>
            <div class="p-2">
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-sm btn-danger">
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
                            <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Permission Title</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        aria-describedby="emailHelp" placeholder="Name" value="{{$permission->name}}">
                                    @error('name')
                                        <span class="mb-1 text-sm text-red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn mt-1 btn-primary d-block">Update</button>
                            </form>
                        </div>
                        <div class="card-body px-3 pt-2">
                            <h4 class="">Permission Role</h4>
                            <div class="mb-3">
                                @if ($permission->roles)
                                    <ul>
                                        @foreach ($permission->roles as $permission_role)
                                            <li>
                                                <span>{{$permission_role->name}} - </span>
                                                <form class="d-inline-block" method="POST" action="{{route('admin.permissions.roles.remove', [$permission->id, $permission_role->id])}}">
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
                            <form method="POST" action="{{ route('admin.permissions.roles', $permission->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control form-control-sm">
                                        @foreach ($roles as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
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
