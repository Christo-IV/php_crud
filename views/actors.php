<style>
    tr:hover {
        cursor: pointer;
    }

    .row-btn {
        width: 1rem;
    }
</style>

<button class="btn btn-primary mt-4 mb-2" onClick="createActor()">Create</button>

<table class="table table-striped table-hover table-bordered">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Dob</th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($actors as $actor): ?>
        <tr>
            <td onClick="getActor(<?= $actor["actor_id"] ?>)"><?= $actor["actor_id"] ?></td>
            <td onClick="getActor(<?= $actor["actor_id"] ?>)"><?= $actor["actor_name"] ?></td>
            <td onClick="getActor(<?= $actor["actor_id"] ?>)"><?= $actor["actor_dob"] ?></td>
            <td class="row-btn">
                <button onClick="editActor(<?= $actor["actor_id"] ?>)" class="btn btn-warning">Edit</button>
            </td>
            <td class="row-btn">
                <button onClick="deleteActor(<?= $actor["actor_id"] ?>)" class="btn btn-danger">X</button>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<script>
    function createActor() {
        location.href = "actors/new";
    }

    function getActor(actorId) {
        location.href = "actors/" + actorId;
    }

    function deleteActor(actorId) {
        location.href = "actors/delete/" + actorId;
    }

    function editActor(actorId) {
        location.href = "actors/edit/" + actorId;
    }
</script>