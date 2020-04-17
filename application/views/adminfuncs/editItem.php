<?php echo validation_errors(); ?>

<?php echo form_open('adminportal/update'); ?>
<div class="row">
    <div class="col-md-12">
        <br>
        <h2 class="text-center"><?= $title; ?></h2>

        <input type = "hidden" name ="id" value="<?php echo $item->itemID; ?>">

        <div class="form-group">
            <Label>Title</Label>
            <input type="text" class="form-control" name="title" value="<?php echo $item->title; ?>" >
        </div>

        <div class="form-group">
            <label>Item Type</label>
            <br>
            <select name="type">
                <option value=1>Book</option>
                <option value=2>Audio Book</option>
                <option value=3>Film</option>
            </select>
        </div>

        <div class="form-group">
            <Label>Genre</Label>
            <br>
            <select name="genre">
                <option value="sciencefiction">Science Fiction</option>
                <option value="mystery">Mystery</option>
                <option value="fantasy">Fantasy</option>
                <option value="nonfiction">Non-Fiction</option>
                <option value="romance">Romance</option>
            </select>
        </div>

        <div class="form-group">
            <Label>Year</Label>
            <input type="number" class="form-control" name="year" value="<?php echo $item->year; ?>">
        </div>

        <div class="form-group">
            <Label>Author</Label>
            <input type="text" class="form-control" name="author" value="<?php echo $item->author; ?>">
        </div>

        <div class="form-group">
            <Label>Distributor</Label>
            <input type="text" class="form-control" name="distributor" value="<?php echo $item->distributor; ?>">
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary btn-block">Submit</button>
<?php echo form_close(); ?>