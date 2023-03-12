<?php

/*
 * This file is part of the LocoForm software.
 *
 * (c) Koen Caerels
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\locoform\Infrastructure;

class Config
{
    public const LOCOFORM_PUBLIC_FOLDER = 'locoform';

    public const APP_RELATIVE_DIR = '../../';

    public const APP_ENV = 'dev';   // dev / test / prod

    public const ADMIN_URL = 'admin';
    public const ADMIN_HASH_CODE = 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'; // test (SHA1)
    public const DATA_FOLDER = '_data';

    //-- database credentials ------------------------------------------------------------------------------------------
    public const DB_SERVER = 'db';
    public const DB_SERVER_PORT = '3306';
    public const DB_NAME = 'locoform';
    public const DB_USER = 'locoform_user';
    public const DB_PWD = 'locoform_pwd';
    public const DB_PREFIX = 'locoform';

}