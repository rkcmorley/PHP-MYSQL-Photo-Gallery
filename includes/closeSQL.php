<?php

// This closes the connection to the database
mysqli_free_result($result);
mysqli_close($link);