<?php

require __DIR__ . '/../bootstrap.php';

[$filename, $variabels] = dispatch_routes(request_method(), request_path());
controller($filename, $variabels);