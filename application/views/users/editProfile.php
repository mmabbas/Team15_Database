<?php echo validation_errors(); ?>

<?php echo form_open('users/updateUser'); ?>
<div class="row">
    <div class="col-md-12">
        <br>
        <h2 class="text-center"></h2>
        <div class="form-group">
            <Label>Name</Label>
            <input type="text" class="form-control" name="firstName" value=<?php echo $this->session->userdata['first_name']; ?>>
        </div>

        <div class="form-group">
            <Label>Name</Label>
            <input type="text" class="form-control" name="lastName" value=<?php echo $this->session->userdata['last_name']; ?>>
        </div>

        <div class="form-group">
            <Label>Age</Label>
            <input type="number" class="form-control" name="age" value=<?php echo $this->session->userdata['age']; ?>>
        </div>

        <div class="form-group">
            <Label>Email</Label>
            <input type="email" class="form-control" name="email" value=<?php echo $this->session->userdata['email']; ?>>
        </div>
        
        <div class="form-group">
            <Label>Username</Label>
            <input type="text" class="form-control" name="username" value=<?php echo $this->session->userdata['username']; ?>>
        </div>

        <div class="form-group">
            <Label>Password</Label>
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>

        <div class="form-group">
            <Label>Confirm Password</Label>
            <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
        </div>
        <div><Label>User Type</Label></div>
    </div>
</div>

<button type="submit" class="btn btn-primary btn-block">Submit</button>
<?php echo form_close(); ?>