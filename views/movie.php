<h1><?= $movies["movie_name"] ?></h1>
<table class="table table-striped table-hover table-bordered">
    <tr>
        <th>Id</th>
        <th>Movie name</th>
        <th>Release date</th>
    </tr>
    <tr>
        <td><?= $movies["movie_id"] ?></td>
        <td><?= $movies["movie_name"] ?></td>
        <td><?= $movies["movie_release_date"] ?></td>
    </tr>
</table>
<h2>Actors</h2>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Actor</th>
        <th>Date of birth</th>
    </tr>
    <?php foreach ($movies["actors"] as $actor): ?>
        <tr>
            <td><?= $actor["actor_id"] ?></td>
            <td><?= $actor["actor_name"] ?></td>
            <td><?= $actor["actor_dob"] ?></td>
        </tr>
    <?php endforeach ?>
</table>