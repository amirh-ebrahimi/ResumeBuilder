<?php
## Making a random string ##
function randomString($chars, $length)
{
    $charLength = strlen($chars);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomChar = $chars[mt_rand(0, $charLength - 1)]; //Select a random char from array.
        $randomString .= $randomChar;
    }
    return $randomString;
}

## Render the CAPTCHA Background ##
function renderBackground()
{

    $image = imagecreatetruecolor(200, 50); //creating image.

    imageantialias($image, true); // showing image by anti-alias technique.

    $colors = [];

    ## Making random colors with the help of RGB ##
    $red = rand(125, 175);
    $green = rand(125, 175);
    $blue = rand(125, 175);

    /*
     * Make a random color array in a way that the lightest color
     * be the first element and the darkest color be the last element
     * of this array.
     */
    for ($i = 0; $i < 5; $i++) {
        $colors[] = imagecolorallocate($image, $red - 20 * $i, $green - 20 * $i, $blue - 20 * $i);
    }

    imagefill($image, 0, 0, $colors[0]); //the lightest color is the background.

    ## Adding different rectangles to image ##
    for ($i = 0; $i < 10; $i++) {
        imagesetthickness($image, rand(2, 10));
        $rectColor = $colors[rand(1, 4)];
        imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $rectColor);
    }
    return $image;
}
## Render the CAPTCHA String ##
function renderString($image, $captchaString, $captchaLength)
{

    ## generating black and white colors ##
    $black = imagecolorallocate($image, 0, 0, 0);
    $white = imagecolorallocate($image, 255, 255, 255);
    $textColors = [$black, $white];

    $fonts = __DIR__ . '\Fonts\Acme.ttf';


    for ($i = 0; $i < $captchaLength; $i++) {
        $initial = 15; // the padding of left and right.
        $letterSpace = 170 / $captchaLength; // the leftover space after padding (200 - 2 * 15) is divided equally for all CAPTCHA letters.
        imagettftext($image, 20, rand(-15, 15), $initial + $i * $letterSpace, rand(20, 40), $textColors[rand(0, 1)], $fonts, $captchaString[$i]);
    }

    imagepng($image, "captcha.png"); // making image
    imagedestroy($image); // freeing memory
}

## Making CAPTCHA ##
function makingCaptcha( $captchaLength = 5)
{
    $permittedChar = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";// All the characters for our CAPTCHA.
    $image = renderBackground();
    $captchaString = randomString($permittedChar, $captchaLength);
    renderString($image, $captchaString, $captchaLength);
    return $captchaString;
}

function checkingCaptcha(){

    global $errors;

    if($_POST["captcha"] === $_SESSION["captcha"]){

        return true;
    }

    $errors[] = "Your CAPTCHA is not valid";
    return false;
}