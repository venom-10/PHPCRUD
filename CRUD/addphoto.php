<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update profile photo</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/js/jquery.Jcrop.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.15/css/jquery.Jcrop.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            },

        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
          .content-auto {
            content-visibility: auto;
          }
        }
      </style>
</head>

<body>
    <?php
        if (!isset($_COOKIE['name'])) {
            setcookie('notlogin', 'OK', time() + 2, '/');
            header('location:index.php');
            exit();
        }

        setcookie('photoid', $_GET['id'], time() + 300, '/');

        $accessToken;
        $match=false;
        if(!$_COOKIE['name']){
            
        }
        else{
            $accessToken = $_COOKIE['accessToken'];
            $match = ($accessToken === hash('sha256', $_COOKIE['name'].'dfa'));
        }

    ?>
    <nav>
        <div class="realtive w-full h-12 bg-slate-500">
            <span class='absolute left-5 top-2 text-white text-2xl'>CRUD</span>
            <div class="flex justify-end items-center h-full pr-4">
                <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName" class="flex items-center text-sm font-medium text-gray-900 rounded-full hover:text-blue-600 dark:hover:text-blue-500 md:mr-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white" type="button">
                    <span class="sr-only">Open user menu</span>
                    <?php
                    if (isset($_COOKIE['name']) && isset($_COOKIE['email']) && $match) {
                        include('conn.php');
                        $name = $_COOKIE['name'];
                        $sql = "select * from $dbname.users where name='$name'";

                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $imagepath = $row['imagepath'];
                        echo '<img class="w-10 h-10 mr-2 rounded-full" src="./uploads/' . $imagepath . '" alt="user photo">';
                    } else {
                        echo '<img class="w-10 h-10 mr-2 rounded-full" src="./images/27470334_7309681.jpg" alt="user photo">';
                    }

                    ?>

                    <svg class="w-4 h-4 mx-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <div id="dropdownAvatarName" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <div class="font-medium ">
                            <?php
                            if (isset($_COOKIE['name']) && $match) {
                                echo $_COOKIE['name'];
                            } else {
                                echo 'Please Log in';
                            }

                            ?>
                        </div>
                        <div class="truncate">
                            <?php
                            if (isset($_COOKIE['email'])) {
                                echo $_COOKIE['email'];
                            }


                            ?>
                        </div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInformdropdownAvatarNameButtonationButton">
                        <li>
                            <a href="index.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li>
                            <a href="../Imagecropper/uploadpage.php" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">change photo</a>
                        </li>
                        <li>
                            <form class='w-full' action="logout.php" method='POST'>
                                <?php
                                if (isset($_COOKIE['name']) && $match) {
                                    echo '<button class="block flex justify-start w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">logout</button>';
                                } else {
                                    echo '<a href="signedin.php" class="block flex justify-start w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">login</a>';
                                }

                                ?>
                            </form>
                        </li>
                    </ul>
                </div>
                <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
            </div>
        </div>
    </nav>
    <div class="flex justify-center items-start pt-10 ">
        <div class='main w-full py-2'>
            <div id='upload_section' class=' w-full flex flex-col items-center gap-4'>
                <h1 class='upload_header text-2xl'>Upload</h1>
                <input class="w-1/2 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="uploaded_img" name='files' type="file">

            </div>

            <div class='img_body w-full h-full flex justify-center'>
                <div id='main_container' class='relative gap-4 flex flex-col items-center w-full'>
                    <div class="header">
                        <h1 class='text-2xl'>Crop Your Image</h1>
                    </div>
                    <div id='img_container' class='relative border border-4 border-gray-300 p-2 w-1/2'>
                        <img src="" id='target' class="w-[90%] h-[90%]" alt="">
                        <button id='close' class='close bg-gray-100 shadow-lg drop-shadow-lg rounded p-1  absolute top-2 right-2'>&#10006;</button>

                    </div>
                    <div id='footer' class='flex justify-end'>
                        <button id='crop' class='text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800'>Crop</button>
                    </div>

                </div>
                <div id="preview">
                    <img src="" id='croppedImage' name='image' alt="">
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#main_container').hide();
        $('#preview').hide();
        $(document).ready(function() {
            const img = document.getElementById('target');

            $('#uploaded_img').change(function(e) {
                var newDataURL;
                $('#upload_section').hide();
                const file = e.target.files;
                const reader = new FileReader();
                reader.readAsDataURL(file[0]);
                reader.onload = function() {
                    img.src = reader.result;
                    $('#main_container').show();
                    if ($("img").is(":visible") == true) {
                        $('#target').Jcrop({
                            aspectRatio:1,
                            onSelect: function(croppedArea) {
                                const {
                                    x,
                                    y,
                                    w: width
                                } = croppedArea;
                                $('#crop').click(function() {
                                    $('#main_container').hide();
                                    $('#preview').show();
                                    const dataURL = reader.result;
                                    var imgElement = document.getElementById("croppedImage");
                                    var coordinates = {
                                        x: x,
                                        y: y,
                                        width: width,
                                        height: width
                                    }
                                    cropImageDataURL(dataURL, coordinates);

                                    function cropImageDataURL(dataURL, coordinates) {
                                        var canvas = document.createElement("canvas");
                                        var ctx = canvas.getContext("2d");
                                        var img1 = new Image();
                                        img1.onload = function() {
                                            canvas.width = coordinates.width;
                                            canvas.height = coordinates.height;

                                            ctx.drawImage(
                                                img1,
                                                coordinates.x,
                                                coordinates.y,
                                                coordinates.width,
                                                coordinates.height,
                                                0,
                                                0,
                                                coordinates.width,
                                                coordinates.height
                                            );
                                            newDataURL = canvas.toDataURL();
                                            $.ajax({
                                                url:'addingphoto.php',
                                                method: 'POST',
                                                data: {
                                                    image: newDataURL
                                                },
                                                success: function(data) {
                                                    imgElement.src = newDataURL;
                                                    window.location.href = '/CRUD/index.php';
                                                }
                                            });
                                        };

                                        img1.src = dataURL;
                                    }

                                })
                            }
                        });

                    }
                };


            })

            $('#close').click(function() {
                $('#main_container').hide();
                $('#upload_section').show();
            })


        });
    </script>
</body>

</html>