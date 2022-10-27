<x-admin-layout>
    <div class="card mx-3 p-2">
        <div class="d-flex align-items-center">
            <div class="mr-auto p-2">
                <h3 class="card-title">Create Role</h3>
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
                <div class="col-6">
                    <div class="card mx-2">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('admin.roles.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                aria-describedby="emailHelp" placeholder="Title">
                            @error('name')
                                <span class="mb-1 text-sm text-red">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn mt-1 btn-primary d-block">Submit</button>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
                </div>
            </div>

        </div>
        </div>
    </section>
</x-admin-layout>
