<div>
    @section('title')
    All-Roles
    @endsection
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">All Roles</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item ">All Roles</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      {{-- content-header end --}}


      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header clearfix">
                    <div class="float-left">
                      <select class="form-control form-control-sm" style="width: 100%;">
                          <option selected="selected" disabled="">Per Page</option>
                              <option value="5" class="text-uppercase">5</option>
                              <option value="10" class="text-uppercase">10</option>
                              <option value="20" class="text-uppercase">20</option>
                              <option value="50" class="text-uppercase">50</option>
                              <option value="100" class="text-uppercase">100</option>
                              <option value="500" class="text-uppercase">500</option>
                      </select>
                    </div>
                    <div class="search-form float-right">
                      <div class="input-group">
                          <input type="text"  name="feedback" class="form-control form-control-sm" placeholder="Search User">
                      </div>

                      <!-- /.input-group -->
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-hover table-striped">
                      <thead class="bg-dark">
                          <tr>
                              <th scope="col">SL</th>
                              <th scope="col">User Name</th>
                              <th scope="col">User Role</th>
                              <th scope="col">Permission</th>
                              <th scope="col">Action</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <th scope="row">1</th>
                              <td>Khan </td>
                              <td>Admin</td>
                              <td>Read,Write</td>
                              <td>
                                  <button class="btn btn-outline-info">Edit</button>
                                  <button class="btn btn-outline-danger">Delete</button>
                              </td>
                          </tr>
                          </tbody>
                      <tfoot>
                          <tr>

                          </tr>
                      </tfoot>
                  </table>
              </div>
              <div class="card-footer">

              </div>
            </div>
        </div>
    </div>
</div>
