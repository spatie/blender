<?php

if (! file_exists(base_path('.env')))
{
    putenv('APP_ENV=local');
}
