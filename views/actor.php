<h1><?= $actor["actor_name"] ?></h1>
<table class="table table-striped table-hover table-bordered">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Dob</th>
    </tr>
        <tr>
            <td><?= $actor["actor_id"] ?></td>
            <td><?= $actor["actor_name"] ?></td>
            <td><?= $actor["actor_dob"] ?></td>
        </tr>
</table>
<h2>Movies</h2>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Movie name</th>
        <th>Release date</th>
    </tr>
    <?php foreach ($actor["movies"] as $movie): ?>
        <tr>
            <td><?= $movie["movie_id"] ?></td>
            <td><?= $movie["movie_name"] ?></td>
            <td><?= $movie["movie_release_date"] ?></td>
        </tr>
    <?php endforeach ?>
</table>