<?php

namespace App\Enums;

enum ProductImageDisk: string
{
    case PUBLIC = 'public';

    case LOCAL = 'local';

    case S3 = 's3';

    case FTP = 'ftp';

}