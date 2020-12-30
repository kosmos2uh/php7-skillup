<?php
include "include/template/header.php";

logoutUser();

header("Location: /", true, 301);