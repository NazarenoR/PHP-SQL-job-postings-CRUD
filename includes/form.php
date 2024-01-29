<main>

    <section>
        <a href="index.php">
            <button class="btn btn-success">Back</button>
        </a>
    </section>

    <h2><?=TITLE?></h2>

    <form method="post">

        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" value="<?=$obListing->title?>">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description" rows="5"><?=$obListing->description?></textarea>
        </div>

        <div class="form-group">
            <label>Status</label>
            
            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="active" value="y" checked> Active
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="active" value="n" <?=$obListing->active == 'n' ? 'checked' : ''?>> Inactive
                    </label>
                </div>

            </div>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Post</button>
        </div>

    </form>

</main>