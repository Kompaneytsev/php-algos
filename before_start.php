<?php

require 'helper.php';

write_file(__DIR__ . '/logs/small.txt', 30000);
write_file(__DIR__ . '/logs/large.txt', 100000);