<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the image file
    $imageFile = $_FILES['image']['tmp_name'];

    // Set the target width and height for the cropped image
    $targetWidth = 300;
    $targetHeight = 200;

    // Load the image using GD library
    $image = imagecreatefromjpeg($imageFile);

    // Get the current width and height of the image
    $originalWidth = imagesx($image);
    $originalHeight = imagesy($image);

    // Calculate the crop coordinates
    $x = $_POST['x'];
    $y = $_POST['y'];
    $width = $_POST['width'];
    $height = $_POST['height'];

    // Create a new image with the target dimensions
    $croppedImage = imagecreatetruecolor($targetWidth, $targetHeight);

    // Perform the cropping
    imagecopyresampled($croppedImage, $image, 0, 0, $x, $y, $targetWidth, $targetHeight, $width, $height);

    // Save the cropped image to a file
    $outputFile = 'cropped.jpg';
    imagejpeg($croppedImage, $outputFile, 90);

    // Free up memory
    imagedestroy($image);
    imagedestroy($croppedImage);

    // Display a message with the cropped image
    echo 'Image cropped successfully! <br>';
    echo 'Cropped Image: <br>';
    echo '<img src="' . $outputFile . '" alt="Cropped Image">';
}
?>
