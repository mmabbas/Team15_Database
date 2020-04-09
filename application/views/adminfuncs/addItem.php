<?php echo validation_errors(); ?>

<?php echo form_open('adminportal/addItem'); ?>
<div class="row">
    <div class="col-md-12">
        <br>
        <h2 class="text-center"><?= $title; ?></h2>
        <div class="form-group">
            <Label>Title</Label>
            <input type="text" class="form-control" name="title" placeholder="Title">
        </div>

        <div class="form-group">
            <select name = "type">
                <option value = 1>Book</option>
                <option value = 2>Audio Book</option>
                <option value = 3>Film</option>
            </select>
        </div>

        <div class="form-group">
            <Label>ISBN</Label>
            <input type="number" class="form-control" name="isbn" placeholder="ISBN">
        </div>

        <div class="form-group">
            <select name = "genre">
                <option value = "sciencefiction">Science Fiction</option>
                <option value = "mystery">Mystery</option>
                <option value = "fantasy">Fantasy</option>
                <option value = "nonfiction">Non-Fiction</option>
                <option value = "romance">Romance</option>
            </select>
        </div>

        <div class="form-group">
            <Label>Year</Label>
            <input type="number" class="form-control" name="year" placeholder="Year">
        </div>

        <div class="form-group">
            <Label>Author</Label>
            <input type="text" class="form-control" name="author" placeholder="Author">
        </div>
        
        <div class="form-group">
            <Label>Distributor</Label>
            <input type="text" class="form-control" name="distributor" placeholder="Distributor">
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary btn-block">Submit</button>
<?php echo form_close(); ?>