<?php

function action_index() {
    session_unset();
    session_destroy();
    header("location: /");
}
