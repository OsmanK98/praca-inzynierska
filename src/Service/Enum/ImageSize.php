<?php


namespace App\Service\Enum;


class ImageSize
{
    const SMALL_SIZE_WIDTH=400;
    const SMALL_SIZE_HEIGHT=400;
    const MEDIUM_SIZE_WIDTH=1200;
    const MEDIUM_SIZE_HEIGHT=1200;
    const BIG_SIZE_WIDTH=4000;
    const BIG_SIZE_HEIGHT=4000;
    const ALLOWED_IMAGE_EXTENSION=['.png','.jpg','.jpeg','.gif','.svg','.raw'];
}
