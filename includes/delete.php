<main>

    <h2>Delete job ad</h2>

    <form method="post">


        <div class="form-group">
            <p>Are you sure you want to delete the <strong><?=$obListing->title?></strong> posting?</p>
        </div>

        <div class="form-group">
        <a href="index.php">
            <button type="button" class="btn btn-success">Cancel</button>
        </a>
            <button type="submit" name="removeListing" class="btn btn-danger">Delete</button>
        </div>

    </form>

</main>