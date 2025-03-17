<?php

namespace App\Services;

use Intervention\Image\Geometry\Factories\RectangleFactory;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Typography\FontFactory;

class WatermarkService
{
    public function applyWatermark(string $path, string $text)
    {
        $image = Image::read($path);

        $imageHeight = $image->height();
        $imageWidth = $image->width();

        $rectangleHeight = max(20, round($imageHeight * 0.05)); // 5% of height, minimum 20px
        $rectangleY = $imageHeight - $rectangleHeight;

        $image->drawRectangle(0, $rectangleY, function (RectangleFactory $rectangle) use ($imageWidth, $rectangleHeight) {
            $rectangle->width($imageWidth);
            $rectangle->height($rectangleHeight);
            $rectangle->background('rgba(128, 128, 128, 0.2)'); // TODO: Config or calculated based on background?
        });

        $fontSize = max(12, round($imageWidth * 0.02)); // 2% of width, minimum 12px

        $margin = 10; // TODO: Config
        $wrapWidth = $imageWidth - (2 * $margin);

        $textY = $rectangleY + ($rectangleHeight / 2);

        $image->text($text, $imageWidth - $margin, $textY, function (FontFactory $font) use ($fontSize, $wrapWidth) {
            $font->file('/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf'); // TODO: Config
            $font->size($fontSize);
            $font->color('fff');
            $font->lineHeight(1.0);
            $font->wrap($wrapWidth);
            $font->align('right');
            $font->valign('middle');
        });

        return $image;
    }
}
