 
<div class="content-wrapper">
 
    <section class="content-header">
      <h1>
        Add User Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Add User Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add User</h3>
            </div>
            <form action="add" method="post" role="form">
              <div class="box-body">
                  <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
                  <input type="text" name="first_name" class="form-control"  placeholder="Enter First Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name</label>
                  <input type="text" name="last_name" class="form-control"  placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" name="username" class="form-control"  placeholder="Enter Username">
                </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Mobile Number</label>
                  <input type="text" name="phone_no" class="form-control"  placeholder="Enter Mobile Number">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </div>
        </div>
     
    </section>
</div>