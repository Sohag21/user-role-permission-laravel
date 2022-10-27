<x-admin-layout>
    <div class="card mx-3 p-2">
        <div class="d-flex align-items-center">
            <div class="mr-auto p-2">
                <h3 class="card-title">All Roles</h3>
            </div>
            <div class="p-2">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i>
                    Create New Role</a>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card mx-2">
                <div class="card-header d-flex pt-4">
                    <form method="POST" action="">
                        <div class="d-flex align-items-center">
                            <input type="text" class="d-inline-block form-control" id="name" name="name" placeholder="Search">
                            <button type="submit" class="btn ml-1 btn-outline-primary d-inline-block">Search</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body px-3 py-4">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th style="width: 100px">#</th>
                                <th>Title</th>
                                <th>Permission</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td class="text-capitalize">{{ $role->name }}</td>
                                    <td class="text-capitalize">{{ $role->permission }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                            class="btn badge-pill btn-xs btn-outline-primary"><i
                                                class="fa fa-pen mr-1"></i>Edit</a>
                                        <form class="d-inline-block" method="POST"
                                            action="{{ route('admin.roles.destroy', $role->id) }}"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn badge-pill btn-xs btn-outline-danger mx-2">
                                                <i class="fa fa-trash mr-1"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
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
