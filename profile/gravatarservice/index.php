<?php

require('gravatar.php');

gravatar::process(gravatar::getPathInfo())->render();
?>