<?php use SlownLS\Auth\User; ?>

<div class="text-center">
    <hr>
    <h5 class="mb-3">Your information :</h5>

    <p>
        Username : <?= User::GetLocalInfo("username") ?> <br>
        E-Mail : <?= User::GetLocalInfo("email") ?> <br>
        Register at : <?= date("m/d/y : H:i", strtotime(User::GetLocalInfo("register_at"))) ?>
    </p>

    <a href="?p=logout" class="btn btn-danger">Logout</a>
</div>